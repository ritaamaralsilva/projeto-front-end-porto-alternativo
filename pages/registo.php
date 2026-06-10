<?php
session_start();

require_once '../db/Database.php';
require_once '../includes/config.php';

$pageTitle = 'Registo | Porto Alternativo';
$currentPage = '';

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($nome) || empty($email) || empty($password)) {

        $erro = "Preenche todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $erro = "Email inválido.";
    } else {

        $stmt = $pdo->prepare("
            SELECT id
            FROM users
            WHERE email = ?
        ");

        $stmt->execute([$email]);

        if ($stmt->fetch()) {

            $erro = "Já existe uma conta com este email.";
        } else {

            $passwordHash = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $stmt = $pdo->prepare("
                INSERT INTO users
                (nome, email, password)
                VALUES (?, ?, ?)
            ");

            $stmt->execute([
                $nome,
                $email,
                $passwordHash
            ]);

            $sucesso = "Conta criada com sucesso.";
        }
    }
}

require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<main class="container my-5" style="max-width:700px;">

    
    <h1 class="text-warning text-center mb-4">
        Criar Conta
    </h1>

    <?php if ($erro): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($erro) ?>
        </div>
    <?php endif; ?>

    <?php if ($sucesso): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($sucesso) ?>
            <br><br>
            <a href="login.php" class="btn btn-success">
                Fazer Login
            </a>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Nome</label>

            <input
                type="text"
                name="nome"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>

            <input
                type="password"
                name="password"
                class="form-control"
                required>
        </div>

        <button
            type="submit"
            class="btn btn-warning w-100">
            Registar
        </button>

    </form>
    

</main>

<?php require_once '../includes/footer.php'; ?>