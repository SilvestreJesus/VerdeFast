document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contenedor-modal');
    const modalBody = document.getElementById('cuerpo-modal');
    const closeBtn = document.querySelector('.boton-cerrar');

    // Función para abrir modal y cargar contenido
    function openModalWithContent(url) {
        fetch(url)
            .then(response => response.text())
            .then(html => {
                modalBody.innerHTML = html;
                modal.classList.remove('oculto');
            })
            .catch(error => {
                modalBody.innerHTML = `<p>Error al cargar contenido.</p>`;
                modal.classList.remove('oculto');
                console.error(error);
            });
    }

    // Cerrar modal
    closeBtn.addEventListener('click', () => {
        modal.classList.add('oculto');
        modalBody.innerHTML = '';
    });

    // Botón que abre el modal
    const launchBtn = document.getElementById('open-selec-planta');
    if (launchBtn) {
        launchBtn.addEventListener('click', () => {
            openModalWithContent('/view/form/selec_planta.php');
        });
    }

    // Abrir el modal cada que se carga la página
    openModalWithContent('/view/form/selec_planta.php')
});