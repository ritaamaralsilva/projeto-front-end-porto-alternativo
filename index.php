<?php
require_once 'includes/config.php';
require_once 'db/Database.php';

// Busca eventos futuros primeiro (até 5), se não houver busca os mais recentes passados
$hoje = date('Y-m-d');

$stmt = $pdo->prepare("
    SELECT e.*, l.nome AS local_nome
    FROM eventos e
    LEFT JOIN locais l ON l.id = e.local_id
    WHERE e.data >= ?
    ORDER BY e.data ASC
    LIMIT 5
");
$stmt->execute([$hoje]);
$eventosCarrossel = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Se não houver eventos futuros, vai buscar os mais recentes passados
if (empty($eventosCarrossel)) {
    $stmt = $pdo->prepare("
        SELECT e.*, l.nome AS local_nome
        FROM eventos e
        LEFT JOIN locais l ON l.id = e.local_id
        WHERE e.data < ?
        ORDER BY e.data DESC
        LIMIT 5
    ");
    $stmt->execute([$hoje]);
    $eventosCarrossel = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

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
            <?php foreach ($eventosCarrossel as $i => $ev): ?>
                <button type="button"
                    data-bs-target="#carouselExampleCaptions"
                    data-bs-slide-to="<?= $i ?>"
                    <?= $i === 0 ? 'class="active" aria-current="true"' : '' ?>
                    aria-label="Slide <?= $i + 1 ?>">
                </button>
            <?php endforeach; ?>
        </div>

        <div class="carousel-inner rounded">
            <?php foreach ($eventosCarrossel as $i => $ev): ?>
                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                    <div class="carousel-img-container">
                        <img src="<?= BASE_URL ?>/<?= htmlspecialchars($ev['imagem']) ?>"
                            class="d-block w-100"
                            alt="<?= htmlspecialchars($ev['nome']) ?>"
                            style="height:450px; object-fit:cover;">
                    </div>
                    <div class="carousel-caption d-none d-md-block bg-opacity-75 rounded">
                        <h5><?= htmlspecialchars($ev['nome']) ?></h5>
                        <p>
                            <?= htmlspecialchars($ev['local_nome']) ?> —
                            <?= date('d/m/Y', strtotime($ev['data'])) ?> |
                            <?= substr($ev['hora'], 0, 5) ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
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