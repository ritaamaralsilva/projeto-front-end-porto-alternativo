document.addEventListener("DOMContentLoaded", () => {
    let todosLocais = [];

    // 1. Carregar Dados
    fetch('../assets/data/locais.json')
        .then(res => res.json())
        .then(data => {
            todosLocais = data;
            renderizarLocais(todosLocais);
        });

    // 2. Função para criar os Cards
    function renderizarLocais(lista) {
        const container = document.getElementById('lista-locais');
        container.innerHTML = ""; // Limpa o contentor

        lista.forEach(local => {
            // Lógica para lidar com categorias (String ou Array)
            const categoriasStr = Array.isArray(local.categoria) 
                ? local.categoria.join(" | ") 
                : local.categoria;

            container.innerHTML += `
                <div class="col">
                    <div class="card h-100 bg-secondary border-0 shadow text-white">
                        <img src="${local.imagem}" class="card-img-top" alt="${local.nome}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-warning">${local.nome}</h5>
                            <p class="card-text small">${categoriasStr}</p>
                            <button onclick="verDetalhes(${local.id})" class="btn btn-dark mt-auto border-warning">Ver Local</button>
                        </div>
                    </div>
                </div>
            `;
        });
    }

    // 3. Sistema de Filtros
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            // Estética dos botões
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');

            const filtro = e.target.getAttribute('data-filter');
            
            if (filtro === "todos") {
                renderizarLocais(todosLocais);
            } else {
                // Filtra verificando se o valor está presente no array ou string
                const filtrados = todosLocais.filter(l => 
                    Array.isArray(l.categoria) ? l.categoria.includes(filtro) : l.categoria === filtro
                );
                renderizarLocais(filtrados);
            }
        });
    });

    // 4. Função Global para o Modal (precisa ser global para o onclick funcionar)
    window.verDetalhes = (id) => {
        const local = todosLocais.find(l => l.id === id);
        if (!local) return;

        document.getElementById('modalNome').innerText = local.nome;
        document.getElementById('modalImagem').src = local.imagem;
        document.getElementById('modalCategoria').innerText = Array.isArray(local.categoria) ? local.categoria.join(", ") : local.categoria;
        document.getElementById('modalMorada').innerText = local.morada;
        document.getElementById('modalDescricao').innerText = local.descricao || "Sem descrição disponível.";
        document.getElementById('modalSite').href = local.site;
        document.getElementById('modalMapa').src = local.coordenadas;

        const myModal = new bootstrap.Modal(document.getElementById('localModal'));
        myModal.show();
    };
});