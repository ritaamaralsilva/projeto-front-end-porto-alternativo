<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';

requireLogin();
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once '../../db/Database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: ../eventos.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM eventos WHERE id = ?");
$stmt->execute([$id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    header("Location: ../eventos.php");
    exit;
}

$stmtLocais = $pdo->query("SELECT id, nome FROM locais ORDER BY nome");
$locais = $stmtLocais->fetchAll(PDO::FETCH_ASSOC);

$stmtCategorias = $pdo->query("SELECT id, nome FROM categorias ORDER BY nome");
$categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);

$stmtCatsEvento = $pdo->prepare("SELECT categoria_id FROM evento_categoria WHERE evento_id = ?");
$stmtCatsEvento->execute([$id]);
$catsDoEvento = $stmtCatsEvento->fetchAll(PDO::FETCH_COLUMN);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pdo->beginTransaction();

    $stmt = $pdo->prepare("
        UPDATE eventos
        SET nome=?, data=?, hora=?, descricao=?, imagem=?, bilheteira=?, local_id=?
        WHERE id=?
    ");
    $stmt->execute([
        $_POST['nome'],
        $_POST['data'],
        $_POST['hora'],
        $_POST['descricao'],
        $_POST['imagem'],
        $_POST['bilheteira'],
        (int)$_POST['local_id'],
        $id
    ]);

    $pdo->prepare("DELETE FROM evento_categoria WHERE evento_id = ?")->execute([$id]);

    $categoriasPost = $_POST['categorias'] ?? [];

    if (!empty($_POST['nova_categoria'])) {
        $stmtNova = $pdo->prepare("INSERT INTO categorias (nome) VALUES (?)");
        try {
            $stmtNova->execute([trim($_POST['nova_categoria'])]);
            $categoriasPost[] = $pdo->lastInsertId();
        } catch (Exception $e) {
            $stmtNova = $pdo->prepare("SELECT id FROM categorias WHERE nome = ?");
            $stmtNova->execute([trim($_POST['nova_categoria'])]);
            $categoriasPost[] = $stmtNova->fetchColumn();
        }
    }

    $stmtPivot = $pdo->prepare("INSERT INTO evento_categoria (evento_id, categoria_id) VALUES (?, ?)");
    foreach ($categoriasPost as $cat_id) {
        $stmtPivot->execute([$id, $cat_id]);
    }

    $pdo->commit();

    header("Location: ../eventos.php?updated=1");
    exit;
}
?>

<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>

<main class="container my-5 flex-grow-1">

    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card bg-secondary text-white shadow border-0">
                <div class="card-body p-4">

                    <h2 class="text-warning mb-4">Editar Evento</h2>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Nome *</label>
                            <input type="text" name="nome"
                                class="form-control bg-dark text-white border-0"
                                value="<?= htmlspecialchars($evento['nome']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Data</label>
                            <input type="date" name="data"
                                class="form-control bg-dark text-white border-0"
                                value="<?= htmlspecialchars($evento['data']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hora</label>
                            <input type="time" name="hora"
                                class="form-control bg-dark text-white border-0"
                                value="<?= htmlspecialchars($evento['hora']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Imagem (URL)</label>
                            <input type="text" name="imagem"
                                class="form-control bg-dark text-white border-0"
                                value="<?= htmlspecialchars($evento['imagem']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bilheteira (URL)</label>
                            <input type="text" name="bilheteira"
                                class="form-control bg-dark text-white border-0"
                                value="<?= htmlspecialchars($evento['bilheteira']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Local *</label>
                            <select name="local_id"
                                class="form-select bg-dark text-white border-0"
                                required>
                                <?php foreach ($locais as $l): ?>
                                    <option value="<?= $l['id'] ?>"
                                        <?= $l['id'] == $evento['local_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($l['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea name="descricao" rows="4"
                                class="form-control bg-dark text-white border-0"><?= htmlspecialchars($evento['descricao']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Categorias</label>
                            <div class="d-flex flex-wrap gap-3">
                                <?php foreach ($categorias as $c): ?>
                                    <label class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="categorias[]"
                                            value="<?= $c['id'] ?>"
                                            <?= in_array($c['id'], $catsDoEvento) ? 'checked' : '' ?>>
                                        <?= htmlspecialchars($c['nome']) ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nova Categoria (opcional)</label>
                            <input type="text" name="nova_categoria"
                                class="form-control bg-dark text-white border-0"
                                placeholder="Ex: Jazz">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning fw-bold w-100">
                                Atualizar Evento
                            </button>
                            <a href="../eventos.php" class="btn btn-outline-light w-100">
                                Cancelar
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</main>

<?php include '../../includes/footer.php'; ?>