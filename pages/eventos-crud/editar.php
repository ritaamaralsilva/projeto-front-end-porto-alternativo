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

// Busca evento
$stmt = $pdo->prepare("SELECT * FROM eventos WHERE id = ?");
$stmt->execute([$id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    header("Location: ../eventos.php");
    exit;
}

// Busca locais
$stmtLocais = $pdo->query("SELECT id, nome FROM locais ORDER BY nome");
$locais = $stmtLocais->fetchAll(PDO::FETCH_ASSOC);

// Busca todas as categorias
$stmtCategorias = $pdo->query("SELECT id, nome FROM categorias ORDER BY nome");
$categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);

// Busca categorias já associadas ao evento
$stmtCatsEvento = $pdo->prepare("SELECT categoria_id FROM evento_categoria WHERE evento_id = ?");
$stmtCatsEvento->execute([$id]);
$catsDoEvento = $stmtCatsEvento->fetchAll(PDO::FETCH_COLUMN);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pdo->beginTransaction();

    // 1. Atualiza evento
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

    // 2. Remove categorias antigas
    $pdo->prepare("DELETE FROM evento_categoria WHERE evento_id = ?")->execute([$id]);

    // 3. Categorias selecionadas
    $categoriasPost = $_POST['categorias'] ?? [];

    // 4. Nova categoria (se existir)
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

    // 5. Insere novas categorias na pivot
    $stmtPivot = $pdo->prepare("INSERT INTO evento_categoria (evento_id, categoria_id) VALUES (?, ?)");
    foreach ($categoriasPost as $cat_id) {
        $stmtPivot->execute([$id, $cat_id]);
    }

    $pdo->commit();

    header("Location: ../eventos.php?updated=1");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">

    <div class="container py-5">

        <h2 class="text-warning mb-4">Editar Evento</h2>

        <form method="POST" class="card bg-secondary p-4">

            <input class="form-control mb-2" name="nome"
                placeholder="Nome"
                value="<?= htmlspecialchars($evento['nome']) ?>" required>

            <input type="date" class="form-control mb-2" name="data"
                value="<?= htmlspecialchars($evento['data']) ?>">

            <input type="time" class="form-control mb-2" name="hora"
                value="<?= htmlspecialchars($evento['hora']) ?>">

            <textarea class="form-control mb-2" name="descricao"
                placeholder="Descrição"><?= htmlspecialchars($evento['descricao']) ?></textarea>

            <input class="form-control mb-2" name="imagem"
                placeholder="URL imagem"
                value="<?= htmlspecialchars($evento['imagem']) ?>">

            <input class="form-control mb-2" name="bilheteira"
                placeholder="Bilheteira"
                value="<?= htmlspecialchars($evento['bilheteira']) ?>">

            <select class="form-control mb-3" name="local_id">
                <?php foreach ($locais as $l): ?>
                    <option value="<?= $l['id'] ?>"
                        <?= $l['id'] == $evento['local_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($l['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <h5 class="mt-2 mb-2">Categorias</h5>

            <?php foreach ($categorias as $c): ?>
                <label class="d-block mb-1">
                    <input type="checkbox" name="categorias[]" value="<?= $c['id'] ?>"
                        <?= in_array($c['id'], $catsDoEvento) ? 'checked' : '' ?>>
                    <?= htmlspecialchars($c['nome']) ?>
                </label>
            <?php endforeach; ?>

            <hr>

            <input class="form-control mb-3" name="nova_categoria"
                placeholder="Nova categoria (opcional)">

            <button class="btn btn-warning">Atualizar</button>

        </form>

    </div>

</body>

</html>