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

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM locais WHERE id = ?");
    $stmt->execute([(int)$id]);
}

header("Location: ../locais.php?deleted=1");
exit;
