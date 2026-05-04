document.addEventListener("DOMContentLoaded", () => {
    
    // --- 1. LÓGICA DE DARK/LIGHT MODE (Prioridade Máxima) ---
    const themeToggle = document.getElementById("theme-toggle");
    const themeIcon = document.getElementById("theme-icon");
    const htmlElement = document.documentElement;

    // Aplica o tema guardado imediatamente ao carregar
    const savedTheme = localStorage.getItem("theme") || "dark";
    htmlElement.setAttribute("data-theme", savedTheme);
    
    if (themeIcon) {
        if (savedTheme === "light") {
            themeIcon.classList.replace("bi-moon-stars", "bi-sun-fill");
        } else {
            themeIcon.classList.replace("bi-sun-fill", "bi-moon-stars");
        }
    }

    // Listener para o clique no switch
    if (themeToggle) {
        themeToggle.addEventListener("click", (e) => {
            e.preventDefault();
            const currentTheme = htmlElement.getAttribute("data-theme");
            const newTheme = currentTheme === "dark" ? "light" : "dark";
            
            htmlElement.setAttribute("data-theme", newTheme);
            localStorage.setItem("theme", newTheme);
            
            if (themeIcon) {
                if (newTheme === "light") {
                    themeIcon.classList.replace("bi-moon-stars", "bi-sun-fill");
                } else {
                    themeIcon.classList.replace("bi-sun-fill", "bi-moon-stars");
                }
            }
        });
    }

    // --- 2. ANIMAÇÃO DAS LETRAS ---
    const titulo = document.querySelector(".animar-letras");
    if (titulo) {
        const textoOriginal = titulo.textContent.trim();
        titulo.innerHTML = ""; 

        [...textoOriginal].forEach(letra => {
            const span = document.createElement("span");
            span.innerHTML = letra === " " ? "&nbsp;" : letra;
            titulo.appendChild(span);
        });
    }

    // --- 3. LÓGICA DE LOCAIS (Fetch e Render) ---
    let todosLocais = [];
    const listaLocaisContainer = document.getElementById('lista-locais');
    
    if (listaLocaisContainer) {
        fetch('../assets/base-dados/locais.json')
            .then(res => res.json())
            .then(data => {
                todosLocais = data;
                renderizarLocais(todosLocais);
            })
            .catch(err => console.error("Erro ao carregar locais:", err));
    }

    function renderizarLocais(lista) {
        if (!listaLocaisContainer) return;
        listaLocaisContainer.innerHTML = ""; 

        lista.forEach(local => {
            const categoriasStr = Array.isArray(local.categoria) 
                ? local.categoria.join(" | ") 
                : local.categoria;

            listaLocaisContainer.innerHTML += `
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="${local.imagem}" class="card-img-top" alt="${local.nome}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-warning">${local.nome}</h5>
                            <p class="card-text small text-muted">${categoriasStr}</p>
                            <button onclick="verDetalhes(${local.id})" class="btn btn-dark mt-auto border-warning">Ver Local</button>
                        </div>
                    </div>
                </div>
            `;
        });
    }

    // --- 4. SISTEMA DE FILTROS ---
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');

            const filtro = e.target.getAttribute('data-filter');
            
            if (filtro === "todos") {
                renderizarLocais(todosLocais);
            } else {
                const filtrados = todosLocais.filter(l => {
                    const cat = l.categoria;
                    if (Array.isArray(cat)) {
                        return cat.some(c => c.toLowerCase().includes(filtro.toLowerCase()));
                    }
                    return cat.toLowerCase().includes(filtro.toLowerCase());
                });
                renderizarLocais(filtrados);
            }
        });
    });

    // --- 5. FUNÇÃO GLOBAL PARA O MODAL ---
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

        const modalElement = document.getElementById('localModal');
        if (modalElement) {
            const myModal = new bootstrap.Modal(modalElement);
            myModal.show();
        }
    };
});