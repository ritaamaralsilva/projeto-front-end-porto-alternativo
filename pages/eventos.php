<?php
require_once '../includes/auth.php';
require_once '../includes/config.php';
require_once __DIR__ . '/../db/Database.php';

/* =========================
   GET ID (MODAL DETALHE)
========================= */
$eventoSelecionado = null;

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("
        SELECT e.*, l.nome AS local_nome, l.coordenadas AS local_coordenadas
        FROM eventos e
        LEFT JOIN locais l ON l.id = e.local_id
        WHERE e.id = ?
    ");
    $stmt->execute([(int)$_GET['id']]);
    $eventoSelecionado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($eventoSelecionado) {
        $stmtCat = $pdo->prepare("
            SELECT c.nome
            FROM categorias c
            JOIN evento_categoria ec ON c.id = ec.categoria_id
            WHERE ec.evento_id = ?
        ");
        $stmtCat->execute([$eventoSelecionado['id']]);
        $eventoSelecionado['categorias'] = $stmtCat->fetchAll(PDO::FETCH_COLUMN);
    }
}

/* =========================
   LISTAR TODOS OS EVENTOS
========================= */
$stmt = $pdo->query("
    SELECT e.*, l.nome AS local_nome
    FROM eventos e
    LEFT JOIN locais l ON l.id = e.local_id
    ORDER BY e.data ASC
");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmtCats = $pdo->query("
    SELECT ec.evento_id, c.nome
    FROM categorias c
    JOIN evento_categoria ec ON c.id = ec.categoria_id
");
$todasCats = $stmtCats->fetchAll(PDO::FETCH_ASSOC);

$catsPorEvento = [];
foreach ($todasCats as $row) {
    $catsPorEvento[$row['evento_id']][] = $row['nome'];
}

foreach ($eventos as &$ev) {
    $ev['categorias'] = $catsPorEvento[$ev['id']] ?? [];
}
unset($ev);

$pageTitle = 'Eventos | Porto Alternativo';
$currentPage = 'eventos';

require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<main class="container my-5 flex-grow-1">

    <h1 class="text-center mb-4 text-warning">Agenda de Eventos</h1>

    <?php if (isLoggedIn()): ?>
        <a href="<?= BASE_URL ?>/pages/eventos-crud/criar.php" class="btn btn-warning mb-4">
            Criar Evento
        </a>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <?php foreach ($eventos as $evento): ?>
            <div class="col">
                <div class="card h-100 shadow">

                    <img src="<?= htmlspecialchars($evento['imagem']) ?>" class="card-img-top"
                        style="height:200px;object-fit:cover;">

                    <div class="card-body d-flex flex-column">

                        <div class="mb-2">
                            <span class="badge"><?= htmlspecialchars($evento['data']) ?></span>
                            <span class="badge border border-secondary"><?= htmlspecialchars($evento['hora']) ?></span>
                        </div>

                        <h5 class="card-title text-warning">
                            <?= htmlspecialchars($evento['nome']) ?>
                        </h5>

                        <p class="mb-1">
                            <i class="bi bi-geo-alt-fill text-warning"></i>
                            <?= htmlspecialchars($evento['local_nome']) ?>
                        </p>

                        <p class="small text-muted">
                            <?= implode(" | ", array_map('htmlspecialchars', $evento['categorias'])) ?>
                        </p>

                        <a href="eventos.php?id=<?= $evento['id'] ?>"
                            class="btn btn-dark border-warning mt-auto">
                            Ver Detalhes
                        </a>

                        <?php if (isLoggedIn()): ?>
                            <div class="mt-2 d-flex gap-2">
                                <a href="eventos-crud/editar.php?id=<?= $evento['id'] ?>"
                                    class="btn btn-sm btn-primary">Editar</a>

                                <button class="btn btn-sm btn-danger"
                                    onclick="setDeleteId(<?= $evento['id'] ?>)"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    Eliminar
                                </button>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</main>

<!-- =========================
     MODAL DETALHE (PHP)
========================= -->
<?php if ($eventoSelecionado): ?>
    <div class="modal show d-block" tabindex="-1" style="background: rgba(0,0,0,0.7);">

        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light border-secondary">

                <div class="modal-header border-secondary">
                    <h5 class="text-warning">
                        <?= htmlspecialchars($eventoSelecionado['nome']) ?>
                    </h5>
                    <a href="eventos.php" class="btn-close btn-close-white"></a>
                </div>

                <div class="modal-body row">

                    <div class="col-md-6">
                        <img src="<?= htmlspecialchars($eventoSelecionado['imagem']) ?>"
                            class="img-fluid rounded mb-3">

                        <p><strong>Data:</strong>
                            <?= htmlspecialchars($eventoSelecionado['data']) ?>
                        </p>

                        <p><strong>Hora:</strong>
                            <?= htmlspecialchars($eventoSelecionado['hora']) ?>
                        </p>

                        <p><strong>Local:</strong>
                            <?= htmlspecialchars($eventoSelecionado['local_nome']) ?>
                        </p>

                        <p><strong>Categorias:</strong>
                            <?= implode(" | ", array_map('htmlspecialchars', $eventoSelecionado['categorias'])) ?>
                        </p>

                        <p><?= htmlspecialchars($eventoSelecionado['descricao'] ?? '') ?></p>

                        <?php if (!empty($eventoSelecionado['bilheteira'])): ?>
                            <a href="<?= htmlspecialchars($eventoSelecionado['bilheteira']) ?>"
                                target="_blank"
                                class="btn btn-warning w-100 mt-2">
                                Comprar Bilhete
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <?php if (!empty($eventoSelecionado['local_coordenadas'])): ?>
                            <h6>Localização</h6>
                            <div class="ratio ratio-4x3">
                                <iframe src="<?= $eventoSelecionado['local_coordenadas'] ?>"
                                    style="border:0;" loading="lazy"></iframe>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php endif; ?>

<!-- =========================
     MODAL ELIMINAR
========================= -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light border-secondary">

            <div class="modal-header border-secondary">
                <h5 class="text-warning">Confirmar eliminação</h5>
                <button type="button" class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Tens a certeza que queres eliminar este evento?
                Esta ação não pode ser revertida.
            </div>

            <div class="modal-footer border-secondary">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Eliminar</a>
            </div>

        </div>
    </div>
</div>

<script>
    function setDeleteId(id) {
        document.getElementById('confirmDeleteBtn').href =
            'eventos-crud/eliminar.php?id=' + id;
    }
</script>

<?php require_once '../includes/footer.php'; ?>