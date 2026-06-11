<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="topbar d-flex justify-content-end align-items-center gap-3 px-3 py-2">

    <!-- SWITCH TEMA -->
    <button id="theme-toggle" class="btn btn-link nav-link p-0">
        <i id="theme-icon" class="bi bi-moon-stars"></i>
    </button>

    <!-- AUTH -->
    <?php if (isset($_SESSION['user_id'])): ?>

        <span class="small">
            Olá, <?= htmlspecialchars($_SESSION['user_nome']) ?>
        </span>

        <a href="<?= BASE_URL ?>/pages/logout.php"
            class="btn btn-outline-danger btn-sm">
            Logout
        </a>

    <?php else: ?>

        <a href="<?= BASE_URL ?>/pages/login.php"
            class="btn btn-outline-light btn-sm">
            Login
        </a>

        <a href="<?= BASE_URL ?>/pages/registo.php"
            class="btn btn-warning btn-sm">
            Criar conta
        </a>

    <?php endif; ?>

</div>