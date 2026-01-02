
/**
 * Añade un producto al carrito almacenado en localStorage.
 * @param {Object} producto Datos mínimos del producto (id, nombre, precio, imagen, categoria).
 */
function agregarAlCarrito(producto) {
    // Paso 1: Intentamos leer el carrito actual; si no existe, usamos un array vacío.
    const carritoActual = JSON.parse(localStorage.getItem('carrito')) || [];

    // Paso 2: Buscamos si el producto ya está en el carrito comparando por su id.
    const indice = carritoActual.findIndex(item => item.id === producto.id);

    if (indice >= 0) {
        // Paso 3A: Si existe, aumentamos la cantidad en 1.
        carritoActual[indice].cantidad += 1;
    } else {
        // Paso 3B: Si no existe, lo añadimos con cantidad inicial 1.
        carritoActual.push({
            id: producto.id,
            nombre: producto.nombre,
            precio: producto.precio,
            imagen: producto.imagen,
            categoria: producto.categoria,
            cantidad: 1
        });
    }

    // Paso 4: Guardamos de nuevo el carrito actualizado en localStorage.
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

