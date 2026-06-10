<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../db/Database.php';

requireLogin();

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$pageTitle = "Criar Evento";
$currentPage = "eventos";

$stmtLocais = $pdo->query("SELECT id, nome FROM locais ORDER BY nome");
$locais = $stmtLocais->fetchAll(PDO::FETCH_ASSOC);

$stmtCategorias = $pdo->query("SELECT id, nome FROM categorias ORDER BY nome");
$categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>

<main class="container my-5 flex-grow-1">

    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card bg-secondary text-white shadow border-0">
                <div class="card-body p-4">

                    <h2 class="text-warning mb-4">Criar Evento</h2>

                    <form method="POST" action="store.php">

                        <div class="mb-3">
                            <label class="form-label">Nome *</label>
                            <input type="text" name="nome"
                                class="form-control bg-dark text-white border-0"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Data</label>
                            <input type="date" name="data"
                                class="form-control bg-dark text-white border-0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hora</label>
                            <input type="time" name="hora"
                                class="form-control bg-dark text-white border-0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Imagem (URL)</label>
                            <input type="text" name="imagem"
                                class="form-control bg-dark text-white border-0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bilheteira (URL)</label>
                            <input type="text" name="bilheteira"
                                class="form-control bg-dark text-white border-0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Local *</label>
                            <select name="local_id"
                                class="form-select bg-dark text-white border-0"
                                required>
                                <option value="">Seleciona um local</option>
                                <?php foreach ($locais as $l): ?>
                                    <option value="<?= $l['id'] ?>">
                                        <?= htmlspecialchars($l['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea name="descricao" rows="4"
                                class="form-control bg-dark text-white border-0"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Categorias</label>
                            <div class="d-flex flex-wrap gap-3">
                                <?php foreach ($categorias as $c): ?>
                                    <label class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="categorias[]"
                                            value="<?= $c['id'] ?>">
                                        <?= htmlspecialchars($c['nome']) ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nova Categoria (opcional)</label>
                            <input type="text" name="nova_categoria"
                                class="form-control bg-dark text-white border-0"
                                placeholder="Ex: Jazz">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit"
                                class="btn btn-warning fw-bold w-100">
                                Criar Evento
                            </button>

                            <a href="../eventos.php"
                                class="btn btn-outline-light w-100">
                                Cancelar
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</main>

<?php include '../../includes/footer.php'; ?>