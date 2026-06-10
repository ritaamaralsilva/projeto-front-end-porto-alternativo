<?php
require_once '../includes/config.php';
require_once '../db/Database.php';

session_start();

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($password, $user['password'])) {
        $error = "Credenciais inválidas.";
    } else {

        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nome'] = $user['nome'];

        header("Location: ../index.php");
        exit;
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<div class="container py-5">

    <h2 class="text-warning mb-4">Login</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="card p-4 bg-dark text-light">

        <input name="email" type="email" class="form-control mb-3" placeholder="Email">

        <input name="password" type="password" class="form-control mb-3" placeholder="Password">

        <button class="btn btn-warning">Entrar</button>

    </form>
</div>

<?php include '../includes/footer.php'; ?>