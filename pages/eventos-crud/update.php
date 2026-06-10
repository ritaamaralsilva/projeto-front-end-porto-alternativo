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

$id = $_POST['id'] ?? null;

if (!$id) {
    header("Location: ../eventos.php");
    exit;
}

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
    (int)$id
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
