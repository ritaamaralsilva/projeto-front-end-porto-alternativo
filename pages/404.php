<?php
$pageTitle = '404 | Porto Alternativo';
$currentPage = '';
require_once '../includes/config.php';
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<main class="container my-5 flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="text-center">
        <h1 class="display-1 text-warning fw-bold">404</h1>
        <h2 class="mb-3">Página não encontrada</h2>
        <p class="text-muted mb-4"></p>
        <a href="<?= BASE_URL ?>/" class="btn btn-warning btn-lg fw-bold px-5">
            Voltar ao Início
        </a>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>