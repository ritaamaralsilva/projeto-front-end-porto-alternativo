// --- TEMA (fora do DOMContentLoaded para correr antes do CSS) ---
const html = document.documentElement;

function applyTheme(theme) {
    html.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);
    const icon = document.getElementById("theme-icon");
    if (!icon) return;
    icon.classList.remove("bi-moon-stars", "bi-sun-fill");
    icon.classList.add(theme === "light" ? "bi-sun-fill" : "bi-moon-stars");
}

const saved = localStorage.getItem("theme") || "dark";
applyTheme(saved);

// --- RESTO DO CÓDIGO ---
document.addEventListener("DOMContentLoaded", () => {

    // toggle de tema
    const toggle = document.getElementById("theme-toggle");
    if (toggle) {
        toggle.addEventListener("click", (e) => {
            e.preventDefault();
            const current = html.getAttribute("data-theme");
            applyTheme(current === "dark" ? "light" : "dark");
        });
    }

    // --- ANIMAÇÃO DAS LETRAS ---
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

});