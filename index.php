<?php
require_once 'includes/config.php';
$pageTitle = 'Início | Porto Alternativo';
$currentPage = 'inicio';
require_once 'includes/header.php';
require_once 'includes/nav.php';
?>

<main class="container p-3 mb-5 rounded flex-grow-1">
    <h1 class="text-center text-warning mb-4">Destaques da Semana</h1>

    <!-- Carrossel de Eventos (Adaptado da Worten) -->
    <div id="carouselExampleCaptions" class="carousel slide mx-auto shadow-lg" data-bs-ride="carousel"
        style="max-width: 900px;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner rounded">
            <div class="carousel-item active">
                <div class="carousel-img-container">
                    <img src="../assets/images/destaques-semana-planob.avif" class="d-block w-100"
                        alt="Travo (Concerto) Plano B ">
                </div>
                <div class="carousel-caption d-none d-md-block bg-opacity-75 rounded">
                    <h5>TRAVO (Concerto)</h5>
                    <p>Plano B - 30/04/2026 | 22:30</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img-container">
                    <img src="../assets/images/destaques-semana-casadamusica.webp" class="d-block w-100"
                        alt="Rival Consoles Casa da Música">
                </div>
                <div class="carousel-caption d-none d-md-block bg-opacity-75 rounded">
                    <h5>Rival Consoles (Concerto) </h5>
                    <p>Casa da Música - 01/05/2026 | 21:00</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img-container">
                    <img src="../assets/images/destaques-semana-sonoscopia.png" class="d-block w-100"
                        alt="Microvolumes Sonoscopia">
                </div>
                <div class="carousel-caption d-none d-md-block bg-opacity-75 rounded">
                    <h5>Microvolumes 4.82 | Abattoir & Borghi | Nicoleta Chatzopoulou</h5>
                    <p>Sonoscopia - 02/05/2026 | 18:30</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>

    <!-- Secção Extra: Chamada para Ação -->
    <div class="row mt-5 text-center">
        <div class="col-md-12">
            <a href="<?= BASE_URL ?>/pages/eventos.php" class="btn btn-warning btn-lg px-5 fw-bold">VER TODA A AGENDA</a>
        </div>
    </div>
</main>

<!-- Footer -->
<?php require_once 'includes/footer.php'; ?>