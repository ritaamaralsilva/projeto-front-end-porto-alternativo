// Lógica específica da Página de Locais
document.addEventListener("DOMContentLoaded", () => {
    let todosLocais = [];

    // 1. Fetch dos dados
    fetch('../assets/base-dados/locais.json')
        .then(res => {
            if (!res.ok) throw new Error("Erro ao carregar locais.json");
            return res.json();
        })
        .then(data => {
            todosLocais = data;
            renderizarLocais(todosLocais);
        })
        .catch(err => console.error(err));

    // 2. Função de Renderização (Injeção no DOM)
    function renderizarLocais(lista) {
        const container = document.getElementById('lista-locais');
        if (!container) return; // Segurança caso o script corra na página errada
        
        container.innerHTML = ""; 

        lista.forEach(local => {
            // Tratamento de categorias híbridas (Array vs String)
            const catDisplay = Array.isArray(local.categoria) ? local.categoria.join(" | ") : local.categoria;

            container.innerHTML += `
                <div class="col">
                    <div class="card h-100 bg-secondary border-0 shadow text-white">
                        <img src="${local.imagem}" class="card-img-top" alt="${local.nome}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-warning">${local.nome}</h5>
                            <p class="card-text small">${catDisplay}</p>
                            <button onclick="verDetalhes(${local.id})" class="btn btn-dark mt-auto border-warning">Ver Local</button>
                        </div>
                    </div>
                </div>
            `;
        });
    }

    // 3. Lógica dos Filtros
    const botoesFiltro = document.querySelectorAll('.filter-btn');
    botoesFiltro.forEach(btn => {
        btn.addEventListener('click', (e) => {
            botoesFiltro.forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');

            const filtro = e.target.getAttribute('data-filter');
            
            const filtrados = filtro === "todos" 
                ? todosLocais 
                : todosLocais.filter(l => 
                    Array.isArray(l.categoria) ? l.categoria.includes(filtro) : l.categoria === filtro
                );
            
            renderizarLocais(filtrados);
        });
    });

    // 4. Função para o Modal de Detalhes
    window.verDetalhes = (id) => {
        const local = todosLocais.find(l => l.id === id);
        if (!local) return;

        document.getElementById('modalNome').innerText = local.nome;
        document.getElementById('modalImagem').src = local.imagem;
        document.getElementById('modalCategoria').innerText = Array.isArray(local.categoria) ? local.categoria.join(", ") : local.categoria;
        document.getElementById('modalMorada').innerText = local.morada;
        document.getElementById('modalDescricao').innerText = local.descricao || "Espaço cultural focado na cena musical do Porto.";
        document.getElementById('modalSite').href = local.site;
        document.getElementById('modalMapa').src = local.coordenadas;

        const myModal = new bootstrap.Modal(document.getElementById('localModal'));
        myModal.show();
    };
});