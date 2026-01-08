// Gestiona el cambio entre secciones del panel admin (dashboard / productos, etc.)
document.querySelectorAll('.menu-btn').forEach(botonMenu => {
    botonMenu.addEventListener('click', () => {
        // Oculta todas las secciones antes de activar la seleccionada
        document.querySelectorAll('.admin-section')
            .forEach(seccion => seccion.classList.remove('visible'));

        // Quita el estado activo de todos los botones antes de marcar el actual
        document.querySelectorAll('.menu-btn')
            .forEach(boton => boton.classList.remove('active'));

        // Activa la sección asociada al botón pulsado
        const idSeccionObjetivo = botonMenu.dataset.section;
        document.getElementById(idSeccionObjetivo)?.classList.add('visible');

        // Marca el botón actual como activo
        botonMenu.classList.add('active');
    });
});
