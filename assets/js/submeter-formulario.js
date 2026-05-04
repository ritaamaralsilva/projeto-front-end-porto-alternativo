document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById('form-submissao');
    const selectLocal = document.getElementById('local');
    const inputData = document.getElementById('data');
    // Mensagem de sucesso
    const alertaSucesso = document.getElementById('alerta-sucesso');

   // configuração de Mensagens de Erro/Sugestão
    const mensagens = {
        'titulo': 'Diz-nos o nome do evento para que todos o identifiquem.',
        'data': 'Escolhe uma data válida (hoje ou futura).',
        'hora': 'Indica a hora a que o evento começa.',
        'local': 'Seleciona um local da lista ou escolhe "Outro".',
        'bilheteira': 'Introduz o link para a compra de bilhetes (ex: http://...)',
        'descricao': 'Explica brevemente o que vai acontecer no teu evento.'
    };

    // loop para criar as divs de feedback automaticamente
    Object.keys(mensagens).forEach(id => {
        const campo = document.getElementById(id);
        if (campo) {
            const feedback = `<div class="invalid-feedback text-warning fw-bold">${mensagens[id]}</div>`;
            campo.insertAdjacentHTML('afterend', feedback);
        }
    });

    // erro caso se preencha uma data anterior à atual
    const hoje = new Date().toISOString().split('T')[0];
    inputData.setAttribute('min', hoje);

    // fetch dos locais
    fetch('../assets/base-dados/locais.json')
        .then(res => res.json())
        .then(locais => {
            selectLocal.innerHTML = '<option value="" selected disabled>Escolhe um local...</option>';
            locais.forEach(local => {
                const option = document.createElement('option');
                option.value = local.nome;
                option.textContent = local.nome;
                selectLocal.appendChild(option);
            });
            const outro = document.createElement('option');
            outro.value = "Outro";
            outro.textContent = "Outro (especificar na descrição)";
            selectLocal.appendChild(outro);
        })
        .catch(err => {
            console.error("Erro ao carregar locais:", err);
            selectLocal.innerHTML = '<option disabled>Erro ao carregar locais</option>';
        });

    // valida ao submeter pedido de evento 
    form.addEventListener('submit', (event) => {
        const dataSelecionada = inputData.value;
        let formularioValido = true;
        
        // limpar validade p o Bootstrap validar corretamente
        inputData.setCustomValidity("");

        if (dataSelecionada < hoje) {
            formularioValido = false;
            // marcar como inválido para o Bootstrap mostrar a div que criámos
            inputData.setCustomValidity("Data inválida");
        }

        if (!form.checkValidity() || !formularioValido) {
            event.preventDefault();
            event.stopPropagation();
            // tiramos o alert() porque as divs aparecem sozinhas
        } else {
            event.preventDefault();
            
            // lógica de sucesso igual ao formulário de contacto
            console.log("Evento válido! Pronto para submeter.");
            form.style.display = 'none'; // Esconde o form
            alertaSucesso.classList.remove('d-none'); // Mostra o sucesso
            alertaSucesso.scrollIntoView({ behavior: 'smooth' }); // Faz scroll
        }

        form.classList.add('was-validated');
    }, false);
});