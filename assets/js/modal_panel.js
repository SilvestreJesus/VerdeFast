document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contenedor-modal');
    const cuerpoModal = document.getElementById('cuerpo-modal');
    const btnCerrar = document.querySelector('.boton-cerrar');

    // Función para abrir un modal y cargar contenido de otra página
    function abrirModal(url) {
        fetch(url)
            .then(response => response.text())
            .then(html => {
                cuerpoModal.innerHTML = html;
                modal.classList.remove('oculto');
            })
            .catch(error => {
                cuerpoModal.innerHTML = `<p>Error al cargar contenido.</p>`;
                modal.classList.remove('oculto');
                console.error(error);
            });
    }

    // Cerrar modal
    btnCerrar.addEventListener('click', () => {
        modal.classList.add('oculto');
        cuerpoModal.innerHTML = '';
    });

    // Botón que abre el modal
    const launchBtn = document.getElementById('modal-selec-planta');
    if (launchBtn) {
        launchBtn.addEventListener('click', () => {
            abrirModal('/view/form/selec_planta.php');
        });
    }

    // Abrir el modal cada que se carga la página
    abrirModal('/view/form/selec_planta.php')
});