<?php
require_once '../../includes/config.php';
require_once '../../db/Database.php';

session_start();

/* =========================
   PROTEÇÃO (LOGIN OBRIGATÓRIO)
========================= */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

/* =========================
   GET CATEGORIAS
========================= */
$stmt = $pdo->prepare("SELECT id, nome FROM categorias ORDER BY nome ASC");
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* =========================
   CREATE LOCAL
========================= */
$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // validação mínima (defensável na oral)
    if (
        empty($_POST['nome']) ||
        empty($_POST['morada']) ||
        empty($_POST['category_id'])
    ) {
        $erro = "Preenche os campos obrigatórios.";
    } else {

        // evitar duplicados (NOME + MORADA)
        $check = $pdo->prepare("
            SELECT id FROM locais 
            WHERE nome = ? AND morada = ?
        ");
        $check->execute([
            $_POST['nome'],
            $_POST['morada']
        ]);

        if ($check->fetch()) {
            $erro = "Este local já existe.";
        } else {

            $stmt = $pdo->prepare("
                INSERT INTO locais 
                (nome, morada, imagem, descricao, site, coordenadas, category_id, user_id)
                VALUES 
                (:nome, :morada, :imagem, :descricao, :site, :coordenadas, :category_id, :user_id)
            ");

            $stmt->execute([
                'nome' => $_POST['nome'],
                'morada' => $_POST['morada'],
                'imagem' => $_POST['imagem'],
                'descricao' => $_POST['descricao'],
                'site' => $_POST['site'],
                'coordenadas' => $_POST['coordenadas'],
                'category_id' => $_POST['category_id'],
                'user_id' => $_SESSION['user_id']
            ]);

            header("Location: ../locais.php");
            exit;
        }
    }
}
?>

<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/nav.php'; ?>

<main class="container my-5 flex-grow-1">

    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card bg-secondary text-white shadow border-0">
                <div class="card-body p-4">

                    <h2 class="text-warning mb-4">Criar Local</h2>

                    <?php if ($erro): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($erro) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">

                        <!-- Nome -->
                        <div class="mb-3">
                            <label class="form-label">Nome *</label>
                            <input type="text" name="nome"
                                class="form-control bg-dark text-white border-0"
                                required>
                        </div>

                        <!-- Morada -->
                        <div class="mb-3">
                            <label class="form-label">Morada *</label>
                            <input type="text" name="morada"
                                class="form-control bg-dark text-white border-0"
                                required>
                        </div>

                        <!-- Categoria -->
                        <div class="mb-3">
                            <label class="form-label">Categoria *</label>
                            <select name="category_id"
                                class="form-select bg-dark text-white border-0"
                                required>
                                <option value="">Seleciona uma categoria</option>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= $cat['id'] ?>">
                                        <?= htmlspecialchars($cat['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Imagem -->
                        <div class="mb-3">
                            <label class="form-label">Imagem (URL)</label>
                            <input type="text" name="imagem"
                                class="form-control bg-dark text-white border-0">
                        </div>

                        <!-- Site -->
                        <div class="mb-3">
                            <label class="form-label">Website</label>
                            <input type="text" name="site"
                                class="form-control bg-dark text-white border-0">
                        </div>

                        <!-- Coordenadas -->
                        <div class="mb-3">
                            <label class="form-label">Google Maps Embed URL</label>
                            <input type="text" name="coordenadas"
                                class="form-control bg-dark text-white border-0">
                        </div>

                        <!-- Descrição -->
                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea name="descricao" rows="4"
                                class="form-control bg-dark text-white border-0"></textarea>
                        </div>

                        <!-- Botões -->
                        <div class="d-flex gap-2">
                            <button type="submit"
                                class="btn btn-warning fw-bold w-100">
                                Criar Local
                            </button>

                            <a href="../locais.php"
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

<?php require_once '../../includes/footer.php'; ?>