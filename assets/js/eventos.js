window.verEvento = (id) => {
    const evento = eventos.find(e => e.id == id);
    if (!evento) return;

    document.getElementById('modalNome').innerText       = evento.nome        ?? '';
    document.getElementById('modalImagem').src           = evento.imagem       ?? '';
    document.getElementById('modalData').innerText       = evento.data         ?? '';
    document.getElementById('modalHora').innerText       = evento.hora         ?? '';
    document.getElementById('modalLocal').innerText      = evento.local_nome   ?? '';
    document.getElementById('modalCategorias').innerText = (evento.categorias ?? []).join(' | ');
    document.getElementById('modalDescricao').innerText  = evento.descricao    ?? '';

    const modalEl = document.getElementById('eventoModal');
    if (!modalEl) return;

    new bootstrap.Modal(modalEl).show();
};