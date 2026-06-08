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
                    <div class="navbar-nav mb-2 mb-lg-0">
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
                </div>
        </nav>
    </header>

    <!-- ... (Header igual ao index.html) ... -->

    <main class="container my-5 flex-grow-1">
        <h1 class="text-center mb-4 text-warning">Explorar Locais</h1>

        <!-- SUB-MENU DE FILTROS -->
        <div class="d-flex justify-content-center gap-2 mb-5 flex-wrap">
            <button class="btn btn-outline-warning filter-btn active" data-filter="todos">Todos</button>
            <button class="btn btn-outline-warning filter-btn" data-filter="Salas de Concertos">Salas de
                Concertos</button>
            <button class="btn btn-outline-warning filter-btn" data-filter="Clubbing">Clubbing</button>
            <button class="btn btn-outline-warning filter-btn" data-filter="Associações Culturais">Associações
                Culturais</button>
        </div>

        <!-- CONTENTOR PARA OS CARDS (Injetado via JS) -->
        <div id="lista-locais" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Os cards vão aparecer aqui -->
        </div>
    </main>

    <!-- MODAL PARA DETALHES DO LOCAL (Página dinâmica sem sair da mesma janela) -->
    <div class="modal fade" id="localModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title text-warning" id="modalNome">Nome do Local</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="modalImagem" src="" class="img-fluid rounded mb-3" alt="">
                            <p><strong>Categoria:</strong> <span id="modalCategoria"></span></p>
                            <p><strong>Morada:</strong> <span id="modalMorada"></span></p>
                            <p id="modalDescricao"></p>
                            <a id="modalSite" href="#" target="_blank" class="btn btn-warning w-100 mt-2">Visitar
                                Site</a>
                        </div>
                        <div class="col-md-6">
                            <h6>Localização:</h6>
                            <div class="ratio ratio-4x3">
                                <iframe id="modalMapa" src="" style="border:0;" allowfullscreen=""
                                    loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ... (Footer e Scripts igual ao index.html) ... -->

    <!-- Footer estilo Worten adaptado -->
    <footer class="container-fluid text-center p-4 border-top border-secondary">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-start">
                <p class="mb-0">© 2026 PORTO ALTERNATIVO - A Agenda Cultural da Música Underground </p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="#" class="text-warning"><i class="bi bi-facebook mx-2 fs-4"></i></a>
                <a href="#" class="text-warning"><i class="bi bi-instagram mx-2 fs-4"></i></a>
                <a href="#" class="text-warning"><i class="bi bi-spotify mx-2 fs-4"></i></a>
                <a href="#" class="text-warning"><i class="bi bi-youtube mx-2 fs-4"></i></a>
            </div>
        </div>
    </footer>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- MEU JS -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/locais.js"></script>


</body>

</html>