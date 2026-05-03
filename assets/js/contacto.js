document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-contacto');
    const alertaSucesso = document.getElementById('msg-sucesso');

    form.addEventListener('submit', function (event) {
        // isto serve para o caso do formulário nao ser valido para o envio
        if (!form.checkValidity()) {
            event.preventDefault(); // sem isto, o utilizador nunca chegaria a ver a mensagem de sucesso nem os erros de validação
            event.stopPropagation();
        } else {
            // Se estiver tudo bem, simulamos o envio
            event.preventDefault(); // Impede o recarregamento da página
            
            // Esconde o formulário e mostra o sucesso
            form.classList.add('d-none');
            alertaSucesso.classList.remove('d-none');
        }

        // Adiciona a classe do Bootstrap para mostrar onde estão os erros
        form.classList.add('was-validated');
    }, false);
});