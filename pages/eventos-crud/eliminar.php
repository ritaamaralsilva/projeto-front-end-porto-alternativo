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
    $pdo->prepare("DELETE FROM evento_categoria WHERE evento_id = ?")->execute([(int)$id]);
    $pdo->prepare("DELETE FROM eventos WHERE id = ?")->execute([(int)$id]);
}

header("Location: ../eventos.php?deleted=1");
exit;
