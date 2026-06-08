<?php
require_once '../includes/config.php';
$pageTitle = 'Locais | Porto Alternativo';
$currentPage = 'locais';
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

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

    <!-- ... (Footer e Scripts igual ao index.php) ... -->
    <?php require_once '../includes/footer.php'; ?>
    