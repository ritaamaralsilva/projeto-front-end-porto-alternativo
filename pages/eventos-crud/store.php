<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';

requireLogin();

$nome = $_POST['nome'];
$data = $_POST['data'];
$hora = $_POST['hora'];
$descricao = $_POST['descricao'];
$imagem = $_POST['imagem'];
$bilheteira = $_POST['bilheteira'];
$local_id = $_POST['local_id'];

$pdo->beginTransaction();

// 1. inserir evento
$stmt = $pdo->prepare("
    INSERT INTO eventos (nome, data, hora, descricao, imagem, bilheteira, local_id)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([$nome, $data, $hora, $descricao, $imagem, $bilheteira, $local_id]);

$evento_id = $pdo->lastInsertId();

// 2. categorias existentes
$categorias = $_POST['categorias'] ?? [];

// 3. nova categoria (se existir)
if (!empty($_POST['nova_categoria'])) {
    $stmt = $pdo->prepare("INSERT INTO categorias (nome) VALUES (?)");
    try {
        $stmt->execute([trim($_POST['nova_categoria'])]);
        $categorias[] = $pdo->lastInsertId();
    } catch (Exception $e) {
        // já existe
        $stmt = $pdo->prepare("SELECT id FROM categorias WHERE nome = ?");
        $stmt->execute([trim($_POST['nova_categoria'])]);
        $categorias[] = $stmt->fetchColumn();
    }
}

// 4. pivot table evento_categoria
$stmtPivot = $pdo->prepare("
    INSERT INTO evento_categoria (evento_id, categoria_id)
    VALUES (?, ?)
");

foreach ($categorias as $cat_id) {
    $stmtPivot->execute([$evento_id, $cat_id]);
}

$pdo->commit();

header("Location: ../eventos.php");
exit;
