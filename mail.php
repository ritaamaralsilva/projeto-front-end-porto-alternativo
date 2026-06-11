<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Acesso inválido.');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Dotenv\Dotenv;

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $_ENV['MAIL_USERNAME'];                    //username no .env (de forma a nao partilhar info sensivel no github)
    $mail->Password   = $_ENV['MAIL_PASSWORD'];                    //pw no .env (de forma a nao partilhar info sensivel no github)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('oportoalternativo@gmail.com', 'Porto Alternativo');
    $mail->addAddress('oportoalternativo@gmail.com');     //Add a recipient
    
    // email do user
    $mail->addReplyTo($_POST['email'], $_POST['nome']); // Adiciona o email do user como reply-to para que possa responder diretamente a ele
    

    //Conteudo do email de acordo com os dados do formulário (Usei htmlspecialchars para evitar ataques de XSS, convertendo caracteres especiais em entidades HTML) contacto.php é a página do form de contacto, onde o user preenche os dados e depois, quando submete, é redirecionado para este mail.php que processa os dados e envia o email
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Contacto: ' . $_POST['assunto'];
    $mail->Body    = '
    <p><strong>Nome:</strong> ' . htmlspecialchars($_POST['nome']) . '</p> 
    <p><strong>Email:</strong> ' . htmlspecialchars($_POST['email']) . '</p>
    <p><strong>Assunto:</strong> ' . htmlspecialchars($_POST['assunto']) . '</p>
    <p><strong>Mensagem:</strong><br>' . nl2br(htmlspecialchars($_POST['mensagem'])) . '</p>
    ';

    $mail->send();
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?sent=1');
    exit;
} catch (Exception $e) {
    // Em caso de erro, redireciona para a página de contacto com um parâmetro de erro
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?contact_error=1');
    exit;
}
