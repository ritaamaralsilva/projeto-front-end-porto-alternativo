<?php
require_once '../includes/config.php';
$pageTitle = 'Contacto | Porto Alternativo';
$currentPage = 'contacto';
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<!--usei o justify-content-center para centrar a coluna no meio da pagina, para nao ficar encostada à esquerda || no caso do flex-grow-1, tive que usar no corpo da página main para ele empurrar o footer sempre para o fim, caso contrario subia e nao ocupava a pagina toda-->
<main class="container my-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-secondary p-4 rounded shadow">
            <h1 class="text-warning mb-3">Fala connosco</h1>
            <p class="text-light">Tens alguma dúvida, sugestão ou queres colaborar connosco? Envia-nos uma mensagem.
            </p>
            <hr class="border-secondary mb-4">

            <!--o novalidate serve para desativar aqueles balões cinzentos padrao. Usei a classe needs-validation do Bootstrap para depois, com o JavaScript, mostrar os avisos de erro personalizados com as cores do site-->
            <form id="form-contacto" class="needs-validation" novalidate>
                <!-- Nome -->
                <div class="mb-3">
                    <label for="nome" class="form-label">O teu nome</label>
                    <input type="text" class="form-control bg-dark text-white border-0" id="nome" placeholder="nome"
                        required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control bg-dark text-white border-0" id="email"
                        placeholder="@email.com" required>
                </div>

                <!-- Assunto -->
                <div class="mb-3">
                    <label for="assunto" class="form-label">Assunto</label>
                    <select class="form-select bg-dark text-white border-0" id="assunto" required>
                        <option value="" selected disabled>Sobre o que queres falar?</option>
                        <option value="duvida">Dúvida Geral</option>
                        <option value="parceria">Parcerias/Publicidade</option>
                        <option value="erro">Reportar Erro no Site</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>

                <!-- Mensagem -->
                <div class="mb-3">
                    <label for="mensagem" class="form-label">A tua mensagem</label>
                    <textarea class="form-control bg-dark text-white border-0" id="mensagem" rows="5"
                        placeholder="Escreve aqui" required></textarea>
                </div>

                <button type="submit" class="btn btn-warning w-100 fw-bold py-2 mt-2">ENVIAR MENSAGEM</button>
            </form>

            <div id="msg-sucesso" class="alert alert-warning mt-4 d-none" role="alert">
                <i class="bi bi-send-check-fill me-2"></i> Recebido! Respondemos-te assim que possível.
            </div>
        </div>
    </div>
</main>

<!--footer-->
<?php require_once '../includes/footer.php'; ?>

