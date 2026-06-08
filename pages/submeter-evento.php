<?php
require_once '../includes/config.php';
$pageTitle = 'Submeter Evento | Porto Alternativo';
$currentPage = 'submeter';
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

    <!-- ... (Header igual ao index.html) ... -->

    <main class="container my-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-md-8 bg-secondary p-4 rounded shadow">
                <h1 class="text-warning mb-4">Submeter Evento</h1>
                <p class="text-light small">Partilha o teu evento com a comunidade underground do Porto. Todos os campos
                    são
                    obrigatórios.</p>
                <hr class="border-secondary">

                <form id="form-submissao" class="needs-validation" novalidate>
                    <!-- Nome do Evento -->
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Evento</label>
                        <input type="text" class="form-control bg-dark text-white border-0" id="nome" required>
                    </div>

                    <div class="row">
                        <!-- Data -->
                        <div class="col-md-6 mb-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" class="form-control bg-dark text-white border-0" id="data" required>
                        </div>
                        <!-- Hora -->
                        <div class="col-md-6 mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" class="form-control bg-dark text-white border-0" id="hora" required>
                        </div>
                    </div>

                    <!-- Local -->
                    <div class="mb-3">
                        <label for="local" class="form-label">Local</label>
                        <select class="form-select bg-dark text-white border-0" id="local" required>
                            <option value="" selected disabled>A carregar locais...</option>
                            <!-- Opções injetadas pelo JS -->
                        </select>
                    </div>

                    <!-- Link de Bilheteira -->
                    <div class="mb-3">
                        <label for="bilheteira" class="form-label">Link para Bilheteira</label>
                        <input type="url" class="form-control bg-dark text-white border-0" id="bilheteira"
                            placeholder="https://..." required>
                    </div>

                    <!-- Descrição -->
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição / Line-up</label>
                        <textarea class="form-control bg-dark text-white border-0" id="descricao" rows="4"
                            required></textarea>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 fw-bold py-2">SUBMETER PARA APROVAÇÃO</button>
                </form>

                <!-- Alerta de Sucesso (escondido inicialmente) -->
                <div id="alerta-sucesso" class="alert alert-success mt-4 d-none" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> Evento submetido com sucesso! Será revisto pela nossa
                    equipa.
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once '../includes/footer.php'; ?>

    