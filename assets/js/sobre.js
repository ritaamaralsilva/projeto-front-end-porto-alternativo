// Espera que o DOM esteja pronto
document.addEventListener('DOMContentLoaded', function() {
    console.log("Página Sobre carregada com sucesso!");

    // Quando passamos o rato na imagem, ela ganha um brilho - fica mais clara
    const molduraFoto = document.querySelector('.bg-secondary');

    if (molduraFoto) {
        molduraFoto.addEventListener('mouseover', function() {
            molduraFoto.style.transition = "all 0.3s"; // usei no JS e nao no CSS pq só queria aplicar este efeito nesta imagem específica desta página
            molduraFoto.style.filter = "brightness(1.2)";
        });

        molduraFoto.addEventListener('mouseout', function() {
            molduraFoto.style.filter = "brightness(1)";
        });
    }
});