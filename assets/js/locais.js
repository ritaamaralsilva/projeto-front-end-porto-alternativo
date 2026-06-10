document.addEventListener("DOMContentLoaded", () => {
    let todosLocais = locais; // vem do PHP

    renderizarLocais(todosLocais);

    function renderizarLocais(lista) {
        const container = document.getElementById('lista-locais');
        if (!container) return;

        container.innerHTML = "";

        lista.forEach(local => {

            const catDisplay = Array.isArray(local.categoria_nome)
                ? local.categoria_nome.join(" | ")
                : local.categoria_nome;

            container.innerHTML += `
                <div class="col">
                    <div class="card h-100 bg-secondary border-0 shadow text-white">
                        <img src="${local.imagem}" class="card-img-top" style="height:200px; object-fit:cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="text-warning">${local.nome}</h5>
                            <p class="small">${local.categoria_nome}</p>

                            <button onclick="verDetalhes(${local.id})"
                                class="btn btn-dark mt-auto border-warning">
                                Ver Local
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });
    }

    // FILTROS
    const botoesFiltro = document.querySelectorAll('.filter-btn');

    botoesFiltro.forEach(btn => {
        btn.addEventListener('click', (e) => {

            botoesFiltro.forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');

            const filtro = e.target.getAttribute('data-filter');

            const filtrados = filtro === "todos"
                ? todosLocais
                : todosLocais.filter(l => l.categoria_nome === filtro);

            renderizarLocais(filtrados);
        });
    });

    // MODAL
    window.verDetalhes = (id) => {
        const local = todosLocais.find(l => l.id == id);
        if (!local) return;

        document.getElementById('modalNome').innerText = local.nome;
        document.getElementById('modalImagem').src = local.imagem;
        document.getElementById('modalCategoria').innerText = local.categoria_nome;
        document.getElementById('modalMorada').innerText = local.morada;
        document.getElementById('modalDescricao').innerText = local.descricao ?? "";
        document.getElementById('modalSite').href = local.site;
        document.getElementById('modalMapa').src = local.coordenadas;

        new bootstrap.Modal(document.getElementById('localModal')).show();
    };
});