document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-contacto');
    const alertaSucesso = document.getElementById('msg-sucesso');

    // Introduzi as mensagens de erro atraves do JS
    // Centralizei as mensagens num objeto JavaScript e nao no HTML, porque facilita a alteração dos textos no futuro (basta mudar num sítio)
    const mensagens = {
        'nome': 'Diz-nos o teu nome para sabermos com quem falamos.',
        'email': 'Introduz um email válido (ex: nome@email.com).',
        'assunto': 'Escolhe um assunto da lista.',
        'mensagem': 'Escreve um pequeno texto com a tua dúvida ou sugestão.'
    };

    // Loop para criar as divs de feedback automaticamente
    // usei insertAdjacentHTML pq permite gerar as divs de erro automaticamente para cada campo, para nao repetir codigo em HTML
    Object.keys(mensagens).forEach(id => {
        const campo = document.getElementById(id);
        if (campo) {
            const feedback = `<div class="invalid-feedback text-warning fw-bold">${mensagens[id]}</div>`;
            campo.insertAdjacentHTML('afterend', feedback);
        }
    });

    // Validação do formulário
    form.addEventListener('submit', function (event) {
        
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation(); 
        } else {
            // Sucesso!
            event.preventDefault();
            
            // Esconde o formulário
            form.style.display = 'none';
            alertaSucesso.classList.remove('d-none');
            
            // Faz scroll para a mensagem de sucesso
            alertaSucesso.scrollIntoView({ behavior: 'smooth' });
        }

        // Ativa as cores de validação do Bootstrap
        form.classList.add('was-validated');
        
    }, false);
});