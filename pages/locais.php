<?php

require_once '../includes/auth.php';

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

    <?php if (isset($_GET['created'])): ?>
        <div class="alert alert-success">
            Local criado com sucesso.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['updated'])): ?>
        <div class="alert alert-success">
            Local atualizado com sucesso.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success">
            Local eliminado com sucesso.
        </div>
    <?php endif; ?>

    <?php if (isLoggedIn()): ?>
        <div class="text-end mb-3">
            <a href="<?= BASE_URL ?>/pages/locais-crud/criar.php"
                class="btn btn-warning">
                + Criar Local
            </a>
        </div>
    <?php endif; ?>

    <!-- LISTA -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <?php foreach ($locais as $local): ?>

            <div class="col">
                <div class="card h-100 shadow">

                    <img src="<?= BASE_URL ?>/<?= htmlspecialchars($local['imagem']) ?>"
                        class="card-img-top"
                        style="height:200px; object-fit:cover;">

                    <div class="card-body d-flex flex-column">

                        <h5 class="text-warning">
                            <?= htmlspecialchars($local['nome']) ?>
                        </h5>

                        <p class="small">
                            <?= htmlspecialchars($local['categoria_nome']) ?>
                        </p>

                        <p class="small">
                            <?= htmlspecialchars($local['morada']) ?>
                        </p>

                        <div class="mt-auto d-grid gap-2">

                            <a href="<?= BASE_URL ?>/locais?id=<?= $local['id'] ?>"
                                class="btn border-warning">
                                Ver Local
                            </a>

                            <?php if (isLoggedIn()): ?>
                                <div class="d-flex gap-2 mt-3">

                                    <a href="<?= BASE_URL ?>/pages/locais-crud/editar?id=<?= $local['id'] ?>"
                                        class="btn btn-outline-warning btn-sm">
                                        Editar
                                    </a>

                                    <button class="btn btn-outline-danger btn-sm"
                                        onclick="setDeleteId(<?= $local['id'] ?>)"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                        Eliminar
                                    </button>

                                </div>
                            <?php endif; ?>

                        </div>

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
            <div class="modal-content border-secondary">

                <div class="modal-header border-secondary">
                    <h5 class="text-warning">
                        <?= htmlspecialchars($localSelecionado['nome']) ?>
                    </h5>

                    <a href="<?= BASE_URL ?>/locais" class="btn-close"></a>
                </div>

                <div class="modal-body row">

                    <div class="col-md-6">
                        <img src="<?= BASE_URL ?>/<?= htmlspecialchars($localSelecionado['imagem']) ?>"
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

<!-- MODAL para apagar local -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-secondary">

            <div class="modal-header border-secondary">
                <h5 class="text-warning">Confirmar eliminação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Tens a certeza que queres eliminar este local?
                Esta ação não pode ser revertida.</p>
            </div>

            <div class="modal-footer border-secondary">
                <button class="btn" data-bs-dismiss="modal">
                    Cancelar
                </button>

                <a id="confirmDeleteBtn" href="#" class="btn btn-danger">
                    Eliminar
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    function setDeleteId(id) {
        document.getElementById('confirmDeleteBtn').href =
            '<?= BASE_URL ?>/pages/locais-crud/eliminar?id=' + id;
    }
</script>

<?php require_once '../includes/footer.php'; ?>