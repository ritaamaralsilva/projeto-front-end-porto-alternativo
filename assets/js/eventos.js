// Lógica da Agenda de Eventos - Porto Alternativo
document.addEventListener("DOMContentLoaded", () => {
    let todosEventos = [];

    // Carregar os dados do ficheiro JSON
    fetch('../assets/base-dados/eventos.json')
        .then(res => {
            if (!res.ok) throw new Error("Erro ao carregar o ficheiro de eventos.");
            return res.json();
        })
        .then(data => {
            todosEventos = data;
            renderizarEventos(todosEventos);
        })
        .catch(err => console.error("Erro:", err));

    // Função para desenhar os cards na página
    function renderizarEventos(lista) {
        const container = document.getElementById('lista-eventos');
        if (!container) return; 
        
        container.innerHTML = ""; 

        lista.forEach(evento => {
            const catDisplay = Array.isArray(evento.categoria) ? evento.categoria.join(" | ") : evento.categoria;

            container.innerHTML += `
                <div class="col">
                    <div class="card h-100 bg-secondary border-0 shadow text-white">
                        <img src="${evento.imagem}" class="card-img-top" alt="${evento.nome}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge bg-warning text-dark">${evento.data}</span>
                                <span class="badge bg-dark border border-secondary">${evento.hora}</span>
                            </div>
                            <h5 class="card-title text-warning">${evento.nome}</h5>
                            <p class="card-text mb-1"><i class="bi bi-geo-alt-fill text-warning"></i> ${evento.local}</p>
                            <p class="card-text small text-light-50">${catDisplay}</p>
                            <button onclick="verEventoDetalhes(${evento.id})" class="btn btn-dark mt-auto border-warning">Ver Detalhes</button>
                        </div>
                    </div>
                </div>
            `;
        });
    }

    // Lógica dos Filtros de Categoria
    const botoesFiltro = document.querySelectorAll('.filter-btn');
    botoesFiltro.forEach(btn => {
        btn.addEventListener('click', (e) => {
            botoesFiltro.forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');

            const filtro = e.target.getAttribute('data-filter');
            
            const filtrados = filtro === "todos" 
                ? todosEventos 
                : todosEventos.filter(ev => 
                    Array.isArray(ev.categoria) 
                        ? ev.categoria.some(c => c.toLowerCase().includes(filtro.toLowerCase())) 
                        : ev.categoria.toLowerCase().includes(filtro.toLowerCase())
                );
            
            renderizarEventos(filtrados);
        });
    });

    // Função para o Modal de Detalhes com Validação de Bilheteira
    window.verEventoDetalhes = (id) => {
        const evento = todosEventos.find(e => e.id === id);
        if (!evento) return;

        // Preencher dados básicos
        document.getElementById('modalNome').innerText = evento.nome;
        document.getElementById('modalImagem').src = evento.imagem;
        document.getElementById('modalData').innerText = evento.data;
        document.getElementById('modalHora').innerText = evento.hora;
        document.getElementById('modalLocal').innerText = evento.local;
        document.getElementById('modalDescricao').innerText = evento.descricao;
        document.getElementById('modalMapa').src = evento.coordenadas;

        // Lógica do Botão de Bilheteira
        const btnBilheteira = document.getElementById('modalBilheteira');
        
        if (evento.bilheteira.startsWith('http')) {
            // Se for um link real
            btnBilheteira.href = evento.bilheteira;
            btnBilheteira.innerText = "Comprar Bilhete";
            btnBilheteira.classList.remove('disabled', 'btn-secondary');
            btnBilheteira.classList.add('btn-warning');
            btnBilheteira.style.pointerEvents = 'auto';
        } else {
            // Se for texto como "No local" ou "Porta" - sem sitio para comprar online, só à porta
            if (evento.site && evento.site.startsWith('http')) {
                // Redireciona para o site oficial como alternativa
                btnBilheteira.href = evento.site;
                btnBilheteira.innerText = `Bilhetes: ${evento.bilheteira} (Ver Site)`;
                btnBilheteira.classList.remove('disabled', 'btn-secondary');
                btnBilheteira.classList.add('btn-warning');
                btnBilheteira.style.pointerEvents = 'auto';
            } else {
                // Desativa o botão se não houver link nenhum
                btnBilheteira.href = "#";
                btnBilheteira.innerText = `Bilhetes: ${evento.bilheteira}`;
                btnBilheteira.classList.add('disabled', 'btn-secondary');
                btnBilheteira.classList.remove('btn-warning');
                btnBilheteira.style.pointerEvents = 'none';
            }
        }

        // Abrir o Modal
        const myModal = new bootstrap.Modal(document.getElementById('eventoModal'));
        myModal.show();
    };
});