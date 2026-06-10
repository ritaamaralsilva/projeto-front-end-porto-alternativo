<?php
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
    $sql = "UPDATE locais SET
        nome=?, morada=?, imagem=?, descricao=?, site=?, coordenadas=?, category_id=?
        WHERE id=?";

    $stmt = $pdo->prepare($sql);
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

<!DOCTYPE html>
<html>

<head>
    <title>Editar Local</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">

    <div class="container py-5">

        <h2 class="text-warning mb-4">Editar Local</h2>

        <form method="POST" class="card bg-secondary p-4">

            <input class="form-control mb-2" name="nome" value="<?= htmlspecialchars($local['nome']) ?>">
            <input class="form-control mb-2" name="morada" value="<?= htmlspecialchars($local['morada']) ?>">
            <input class="form-control mb-2" name="imagem" value="<?= htmlspecialchars($local['imagem']) ?>">
            <textarea class="form-control mb-2" name="descricao"><?= htmlspecialchars($local['descricao']) ?></textarea>
            <input class="form-control mb-2" name="site" value="<?= htmlspecialchars($local['site']) ?>">
            <input class="form-control mb-2" name="coordenadas" value="<?= htmlspecialchars($local['coordenadas']) ?>">

            <select name="category_id" class="form-control mb-3">
                <?php foreach ($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>"
                        <?= $c['id'] == $local['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button class="btn btn-warning">Atualizar</button>

        </form>

    </div>

</body>

</html>