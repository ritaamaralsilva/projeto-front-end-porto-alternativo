<?php
require_once '../includes/config.php';
require_once '../db/Database.php';

$pageTitle = 'Locais | Porto Alternativo';
$currentPage = 'locais';

require_once '../includes/header.php';
require_once '../includes/nav.php';

/* =========================
   GET ID (MODAL DETALHE)
========================= */
$localSelecionado = null;

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("
        SELECT locais.*, categorias.nome AS categoria_nome
        FROM locais
        LEFT JOIN categorias ON locais.category_id = categorias.id
        WHERE locais.id = ?
    ");
    $stmt->execute([(int)$_GET['id']]);
    $localSelecionado = $stmt->fetch(PDO::FETCH_ASSOC);
}

/* =========================
   LISTAR TODOS OS LOCAIS
========================= */
$stmt = $pdo->prepare("
    SELECT locais.*, categorias.nome AS categoria_nome
    FROM locais
    LEFT JOIN categorias ON locais.category_id = categorias.id
    ORDER BY locais.id DESC
");
$stmt->execute();
$locais = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container my-5 flex-grow-1">

    <h1 class="text-center mb-4 text-warning">Explorar Locais</h1>

    <!-- LISTA -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <?php foreach ($locais as $local): ?>

            <div class="col">
                <div class="card h-100 bg-secondary text-white shadow border-0">

                    <img src="<?= htmlspecialchars($local['imagem']) ?>"
                        class="card-img-top"
                        style="height:200px; object-fit:cover;">

                    <div class="card-body d-flex flex-column">

                        <h5 class="text-warning">
                            <?= htmlspecialchars($local['nome']) ?>
                        </h5>

                        <p class="small">
                            <?= htmlspecialchars($local['categoria_nome']) ?>
                        </p>

                        <p class="small text-light">
                            <?= htmlspecialchars($local['morada']) ?>
                        </p>

                        <a href="locais.php?id=<?= $local['id'] ?>"
                            class="btn btn-dark mt-auto border-warning">
                            Ver Local
                        </a>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>

    <script>
        const locais = <?= json_encode($locais, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
    </script>

</main>

<!-- =========================
     MODAL SIMPLES (PHP)
========================= -->
<?php if ($localSelecionado): ?>
    <div class="modal show d-block" tabindex="-1" style="background: rgba(0,0,0,0.7);">

        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light border-secondary">

                <div class="modal-header border-secondary">
                    <h5 class="text-warning">
                        <?= htmlspecialchars($localSelecionado['nome']) ?>
                    </h5>

                    <a href="locais.php" class="btn-close btn-close-white"></a>
                </div>

                <div class="modal-body row">

                    <div class="col-md-6">
                        <img src="<?= htmlspecialchars($localSelecionado['imagem']) ?>"
                            class="img-fluid rounded mb-3">

                        <p><strong>Categoria:</strong>
                            <?= htmlspecialchars($localSelecionado['categoria_nome']) ?>
                        </p>

                        <p><strong>Morada:</strong>
                            <?= htmlspecialchars($localSelecionado['morada']) ?>
                        </p>

                        <p>
                            <?= htmlspecialchars($localSelecionado['descricao']) ?>
                        </p>

                        <a href="<?= htmlspecialchars($localSelecionado['site']) ?>"
                            target="_blank"
                            class="btn btn-warning w-100 mt-2">
                            Visitar Site
                        </a>
                    </div>

                    <div class="col-md-6">
                        <h6>Localização</h6>

                        <div class="ratio ratio-4x3">
                            <iframe src="<?= $localSelecionado['coordenadas'] ?>"
                                style="border:0;" loading="lazy"></iframe>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php endif; ?>

<?php require_once '../includes/footer.php'; ?>