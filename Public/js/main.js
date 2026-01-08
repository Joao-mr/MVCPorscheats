/**
 * Añade un producto al carrito almacenado en localStorage.
 * @param {Object} producto Datos mínimos del producto (id, nombre, precio, imagen, categoria).
 */
function agregarAlCarrito(producto) {
    const carritoActual = JSON.parse(localStorage.getItem('carrito')) || [];
    const indice = carritoActual.findIndex(item => item.id === producto.id);

    if (indice >= 0) {
        carritoActual[indice].cantidad += 1;
    } else {
        carritoActual.push({
            id: producto.id,
            nombre: producto.nombre,
            precio: producto.precio,
            imagen: producto.imagen,
            categoria: producto.categoria,
            cantidad: 1
        });
    }

    localStorage.setItem('carrito', JSON.stringify(carritoActual));
}

// Los data-attributes son atributos personalizados en HTML (por ejemplo data-id, data-nombre).
    // Permiten guardar información directamente en el botón sin necesidad de PHP.
    // En JS se leen a través de la propiedad dataset (por ejemplo button.dataset.id).
    document.addEventListener('DOMContentLoaded', () => {
    console.log("DOM listo");

    const botonesComprar = document.querySelectorAll('.js-btn-comprar');
    console.log("Botones comprar encontrados:", botonesComprar.length);

    botonesComprar.forEach(boton => {
        boton.addEventListener('click', () => {
            console.log("CLICK en comprar");

            const producto = {
                id: boton.dataset.id,
                nombre: boton.dataset.nombre,
                precio: Number(boton.dataset.precio),
                imagen: boton.dataset.imagen,
                categoria: boton.dataset.categoria
            };

            console.log("Producto a guardar:", producto);
            agregarAlCarrito(producto);
        });
    });
});

