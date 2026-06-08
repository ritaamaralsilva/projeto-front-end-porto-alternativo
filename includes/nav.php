<header class="text-center sticky-top border-bottom border-secondary">

    <a href="<?= BASE_URL ?>/index.php" class="text-decoration-none">
        <h2 class="pt-3 fw-bold animar-letras">PORTO ALTERNATIVO</h2>
    </a>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentPage ?? '') === 'inicio' ? 'active' : '' ?>"
                            href="<?= BASE_URL ?>/index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentPage ?? '') === 'locais' ? 'active' : '' ?>"
                            href="<?= BASE_URL ?>/pages/locais.php">Locais</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentPage ?? '') === 'eventos' ? 'active' : '' ?>"
                            href="<?= BASE_URL ?>/pages/eventos.php">Agenda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentPage ?? '') === 'submeter' ? 'active' : '' ?>"
                            href="<?= BASE_URL ?>/pages/submeter-evento.php">Submeter Evento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentPage ?? '') === 'sobre' ? 'active' : '' ?>"
                            href="<?= BASE_URL ?>/pages/sobre.php">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentPage ?? '') === 'contacto' ? 'active' : '' ?>"
                            href="<?= BASE_URL ?>/pages/contacto.php">Contacto</a>
                    </li>

                    <!-- Botão Switch de Tema -->
                    <li class="nav-item ms-lg-auto">
                        <button id="theme-toggle" class="btn btn-link nav-link">
                            <i id="theme-icon" class="bi bi-moon-stars"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>