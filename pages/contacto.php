<?php
require_once '../includes/config.php';
$pageTitle = 'Contacto | Porto Alternativo';
$currentPage = 'contacto';
require_once '../includes/header.php';
require_once '../includes/nav.php';

?>

<!--usei o justify-content-center para centrar a coluna no meio da pagina, para nao ficar encostada à esquerda || no caso do flex-grow-1, tive que usar no corpo da página main para ele empurrar o footer sempre para o fim, caso contrario subia e nao ocupava a pagina toda-->
<main class="container my-5 flex-grow-1">

    <?php if (isset($_GET['sent'])): ?> <!-- Se o parâmetro 'sent' estiver presente na URL, mostra a mensagem de sucesso -->
        <div class="alert alert-success">
            Mensagem enviada com sucesso!
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card shadow">
                <div class="card-body p-4">

                    <h1 class="text-warning mb-3">Fala connosco</h1>
                    <p class="">Tens alguma dúvida, sugestão ou queres colaborar connosco? Envia-nos uma mensagem.</p>
                    <hr class="border-secondary mb-4">

                    <form action="<?= BASE_URL ?>/mail.php" method="POST" id="form-contacto" class="needs-validation" novalidate>

                        <div class="mb-3">
                            <label for="nome" class="form-label">O teu nome</label>
                            <input type="text" class="form-control"
                                id="nome" name="nome" placeholder="nome" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control"
                                id="email" name="email" placeholder="@email.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="assunto" class="form-label">Assunto</label>
                            <select class="form-select"
                                id="assunto" name="assunto" required>
                                <option value="" selected disabled>Sobre o que queres falar?</option>
                                <option value="duvida">Dúvida Geral</option>
                                <option value="parceria">Parcerias/Publicidade</option>
                                <option value="erro">Reportar Erro no Site</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="mensagem" class="form-label">A tua mensagem</label>
                            <textarea class="form-control"
                                id="mensagem" name="mensagem" rows="5"
                                placeholder="Escreve aqui" required></textarea>
                        </div>

                        <button type="submit" id="submitBtn"
                            class="btn btn-warning w-100 fw-bold py-2 mt-2">
                            ENVIAR MENSAGEM
                        </button>

                    </form>

                    <div id="msg-sucesso" class="alert alert-warning mt-4 d-none" role="alert">
                        <i class="bi bi-send-check-fill me-2"></i> Recebido! Respondemos-te assim que possível.
                    </div>

                </div>
            </div>

        </div>
    </div>

</main>

<?php require_once '../includes/footer.php'; ?>