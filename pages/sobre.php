<?php
require_once '../includes/config.php';
$pageTitle = 'Sobre | Porto Alternativo';
$currentPage = 'sobre';
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<main class="container my-5 flex-grow-1">
    <!-- TITULO DA PÁGINA -->
    <h1 class="text-center mb-5 text-warning">O Projecto</h1>

    <div class="row align-items-center g-5">
        <!-- COLUNA DO TEXTO -->
        <div class="col-md-7">
            <h3 class="mb-4">A cultura que não aparece nos guias turísticos.</h3>

            <div class="lh-lg" style="color: #cbd5e0;">
                <p>
                    O <strong>Porto Alternativo</strong> nasceu de uma falha óbvia: a dificuldade em encontrar os
                    eventos mais underground e autênticos da nossa cidade. Enquanto as grandes salas e festivais
                    mainstream dominam a publicidade, a verdadeira cena alternativa do Porto acontece em caves,
                    armazéns e associações culturais que raramente chegam ao grande público.
                </p>
                <p>
                    Aqui não há algoritmos nem interesses comerciais. Esta agenda é alimentada por quem vive a
                    cidade à noite, por quem gosta de techno industrial, punk, metal, ou arte experimental. O nosso
                    objectivo é simples: <strong>dar visibilidade ao invisível.</strong>
                </p>
                <p>
                    Queremos que esta plataforma seja o ponto de partida para descobrires aquele concerto de uma
                    banda nova em Cedofeita ou aquela noite de electrónica num armazém em Campanhã.
                </p>
            </div>

            <!-- BOX DE DESTAQUE || usei classes do bootstrap para dar um ar diferente -->
            <div class="mt-5 p-4 caixa-destaque border-start border-warning border-4 rounded-end">
                <h5 class="text-warning"><i class="bi bi-megaphone-fill me-2"></i> Porquê?</h5>
                <p class="mb-0 italic">
                    Porque o Porto é muito mais do que a Ribeira e os Aliados. É cimento, é ruído, é arte e, acima
                    de tudo, é comunidade.
                </p>
            </div>
        </div>

        <!-- COLUNA DA IMAGEM -->
        <div class="col-md-5 text-center">
            <!-- d-inline-block faz com que a div cinzenta "aperte" a imagem e só ocupe o espaço dela -->
            <div class="p-2 moldura-imagem rounded shadow-lg d-inline-block">
                <img src="<?= BASE_URL ?>/assets/images/sobre-porto.jpg" class="img-fluid rounded shadow"
                    alt="Porto Underground">
            </div>
            <p class="mt-3 legenda-foto small">Cedofeita, Porto — 2024</p>
        </div>
    </div>
</main>

<!-- Footer -->
<?php require_once '../includes/footer.php'; ?>