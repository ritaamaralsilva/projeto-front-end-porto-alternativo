<?php
require_once '../includes/config.php';
$pageTitle = 'Eventos | Porto Alternativo';
$currentPage = 'eventos';
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

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
<?php require_once '../includes/footer.php'; ?>

