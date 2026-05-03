document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById('form-submissao');
    const selectLocal = document.getElementById('local');
    const inputData = document.getElementById('data');

    // --- Erro caso se preencha uma data anterior à atual---
    // Define a data mínima que o utilizador pode selecionar no calendário
    const hoje = new Date().toISOString().split('T')[0];
    inputData.setAttribute('min', hoje);

    // --- fetch dos locais de eventos a partir do json locais.json ---
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
            // Adiciona a opção "Outro" no final
            const outro = document.createElement('option');
            outro.value = "Outro";
            outro.textContent = "Outro (especificar na descrição)";
            selectLocal.appendChild(outro);
        })
        .catch(err => {
            console.error("Erro ao carregar locais:", err);
            selectLocal.innerHTML = '<option disabled>Erro ao carregar locais</option>';
        });

    // --- Valida ao submeter pedido de evento ---
    form.addEventListener('submit', (event) => {
        const dataSelecionada = inputData.value;
        let formularioValido = true;
        let mensagemErro = "";

        // Verificação manual da data (segurança extra)
        if (dataSelecionada < hoje) {
            formularioValido = false;
            mensagemErro = "A data do evento não pode ser anterior a hoje!";
        }

        // Verificação de campos vazios (Bootstrap)
        if (!form.checkValidity() || !formularioValido) {
            event.preventDefault();
            event.stopPropagation();
            
            // Se o erro for da data, mostra o erro específico, senão mostra erro geral
            alert(mensagemErro || "Por favor, preenche todos os campos obrigatórios.");
        } else {
            event.preventDefault();
            
            // Lógica de sucesso (mostrar alerta, console.log, etc.)
            console.log("Evento válido! Pronto para submeter.");
            document.getElementById('alerta-sucesso').classList.remove('d-none');
            form.classList.add('d-none');
        }

        form.classList.add('was-validated');
    }, false);
});