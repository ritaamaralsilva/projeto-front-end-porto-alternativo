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
    header("Location: ../locais.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM locais WHERE id = ?");
$stmt->execute([$id]);
$local = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT id, nome FROM categorias");
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$local) {
    header("Location: ../locais.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        UPDATE locais SET nome=?, morada=?, imagem=?, descricao=?, site=?, coordenadas=?, category_id=?
        WHERE id=?
    ");
    $stmt->execute([
        $_POST['nome'],
        $_POST['morada'],
        $_POST['imagem'],
        $_POST['descricao'],
        $_POST['site'],
        $_POST['coordenadas'],
        (int)$_POST['category_id'],
        $id
    ]);

    header("Location: ../locais.php?updated=1");
    exit;
}
?>

<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/nav.php'; ?>

<main class="container my-5 flex-grow-1">

    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card bg-secondary text-white shadow border-0">
                <div class="card-body p-4">

                    <h2 class="text-warning mb-4">Editar Local</h2>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Nome *</label>
                            <input type="text" name="nome"
                                class="form-control bg-dark text-white border-0"
                                value="<?= htmlspecialchars($local['nome']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Morada *</label>
                            <input type="text" name="morada"
                                class="form-control bg-dark text-white border-0"
                                value="<?= htmlspecialchars($local['morada']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Categoria *</label>
                            <select name="category_id"
                                class="form-select bg-dark text-white border-0"
                                required>
                                <?php foreach ($categorias as $c): ?>
                                    <option value="<?= $c['id'] ?>"
                                        <?= $c['id'] == $local['category_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($c['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Imagem (URL)</label>
                            <input type="text" name="imagem"
                                class="form-control bg-dark text-white border-0"
                                value="<?= htmlspecialchars($local['imagem']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Website</label>
                            <input type="text" name="site"
                                class="form-control bg-dark text-white border-0"
                                value="<?= htmlspecialchars($local['site']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Google Maps Embed URL</label>
                            <input type="text" name="coordenadas"
                                class="form-control bg-dark text-white border-0"
                                value="<?= htmlspecialchars($local['coordenadas']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea name="descricao" rows="4"
                                class="form-control bg-dark text-white border-0"><?= htmlspecialchars($local['descricao']) ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning fw-bold w-100">
                                Atualizar Local
                            </button>
                            <a href="../locais.php" class="btn btn-outline-light w-100">
                                Cancelar
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</main>

<?php require_once '../../includes/footer.php'; ?>