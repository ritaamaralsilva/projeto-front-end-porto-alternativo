<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../assets/images/favicon.jpg" type="image">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- GOOGLE FONTS - OPEN SANS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- MEU CSS -->
    <link rel="stylesheet" href="../assets/style/style.css">

    <title>Porto Alternativo</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="text-center sticky-top border-bottom border-secondary">

        <a href="./sobre.html" class="text-decoration-none">
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
                            <a class="nav-link active" aria-current="page" href="../index.html">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./locais.html">Locais</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./eventos.html">Agenda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./submeter-evento.html">Submeter Evento</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./sobre.html">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./contacto.html">Contacto</a>
                        </li>

                        <!-- NOVO: Botão Switch de Tema -->
                        <li class="nav-item ms-lg-auto">
                            <button id="theme-toggle" class="btn btn-link nav-link">
                                <i id="theme-icon" class="bi bi-moon-stars"></i>
                            </button>
                        </li>
                    </ul>
                </div>
        </nav>
    </header>

    <main class="container my-5 flex-grow-1">
        <h1 class="text-center mb-4 text-warning">Agenda de Eventos</h1>

        <!-- FILTROS POR CATEGORIA MUSICAL -->
        <div class="d-flex justify-content-center gap-2 mb-5 flex-wrap">
            <button class="btn btn-outline-warning filter-btn active" data-filter="todos">Todos</button>
            <button class="btn btn-outline-warning filter-btn" data-filter="Techno">Techno</button>
            <button class="btn btn-outline-warning filter-btn" data-filter="Rock">Rock/Metal</button>
            <button class="btn btn-outline-warning filter-btn" data-filter="Experimental">Experimental</button>
            <button class="btn btn-outline-warning filter-btn" data-filter="Eletrónica">Eletrónica</button>
        </div>

        <!-- LISTA DE EVENTOS || deixei o contentor vazio de propósito no HTML. O conteúdo é injetado pelo ficheiro eventos.js, os dados estão num array e o script cria os cards automaticamente-->
        <div id="lista-eventos" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Cards injetados via JS -->
        </div>
    </main>

    <!-- MODAL DE DETALHES DO EVENTO || cada card de evento tem um botão "Ver Mais". No JS, quando esse botao é clicado, pego no ID desse evento e preencho os campos do modal-->
    <div class="modal fade" id="eventoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title text-warning" id="modalNome">Nome do Evento</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="modalImagem" src="" class="img-fluid rounded mb-3" alt="">
                            <p><i class="bi bi-calendar-event text-warning"></i> <strong>Data:</strong> <span
                                    id="modalData"></span></p>
                            <p><i class="bi bi-clock text-warning"></i> <strong>Hora:</strong> <span
                                    id="modalHora"></span></p>
                            <p><i class="bi bi-geo-alt text-warning"></i> <strong>Local:</strong> <span
                                    id="modalLocal"></span></p>
                            <p id="modalDescricao"></p>
                            <a id="modalBilheteira" href="#" target="_blank"
                                class="btn btn-warning w-100 mt-2 fw-bold">Bilheteira / Info</a>
                        </div>
                        <div class="col-md-6">
                            <h6>Localização:</h6>

                            <!--a classe do Bootstrap ratio ratio-4x3 serve para manter a proporção do mapa-->
                            <div class="ratio ratio-4x3">
                                <iframe id="modalMapa" src="" style="border: 0;" allowfullscreen=""
                                    loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="container-fluid text-center p-4 border-top border-secondary">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0">© 2026 PORTO ALTERNATIVO - A Agenda Cultural da Música Underground </p>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
                <a href="#" class="text-warning"><i class="bi bi-facebook mx-2 fs-4"></i></a>
                <a href="#" class="text-warning"><i class="bi bi-instagram mx-2 fs-4"></i></a>
                <a href="#" class="text-warning"><i class="bi bi-spotify mx-2 fs-4"></i></a>
                <a href="#" class="text-warning"><i class="bi bi-youtube mx-2 fs-4"></i></a>
            </div>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/eventos.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>