// Esperamos a que el DOM esté listo para asegurar que #cartItems existe.
document.addEventListener('DOMContentLoaded', () => {
    /**
     * --- VARIABLES GLOBALES DEL MÓDULO ---
     * CLAVE_CARRITO: nombre con el que guardamos el array en localStorage.
     * Referencias a nodos del DOM que usamos muchas veces para evitar buscarlos de nuevo.
     */
    const CLAVE_CARRITO = 'carrito';
    const listaProductos = document.getElementById('cartItems');
    const subtotalEl     = document.getElementById('subtotal');
    const descuentoEl    = document.getElementById('discount');
    const totalEl        = document.getElementById('total');
    const promoInput     = document.getElementById('promoCode');
    const promoBtn       = document.getElementById('applyPromo');
    const promoMsg       = document.getElementById('promoMessage');
    const btnFinalizar   = document.getElementById('finalizarPedido');
    const btnVaciar      = document.getElementById('vaciarCarrito');

    let tasaDescuento = 0; // Guardará el porcentaje de descuento activo (0 = sin promo).

    iniciar();

    /**
     * Función principal que arranca toda la lógica del archivo.
     * 1. Pinta los productos del carrito.
     * 2. Calcula los totales actuales.
     * 3. Registra los eventos necesarios (botones, promo, etc.).
     */
    function iniciar() {
        renderizarCarrito();
        actualizarTotales();
        configurarEventos();
    }

    /**
     * Agrupa todas las suscripciones de eventos para mantener el código ordenado.
     */
    function configurarEventos() {
        listaProductos?.addEventListener('click', manejarClickLista);
        promoBtn?.addEventListener('click', aplicarCodigoPromocional);
        btnFinalizar?.addEventListener('click', finalizarPedido);
        btnVaciar?.addEventListener('click', vaciarCarrito);
    }

    // ==========================
    //   LOCALSTORAGE UTILITIES
    // ==========================

    /**
     * Obtiene el carrito guardado. Si no existe o hay error,
     * devolvemos un array vacío para no romper el flujo.
     */
    function obtenerCarrito() {
        try {
            return JSON.parse(localStorage.getItem(CLAVE_CARRITO)) || [];
        } catch {
            return [];
        }
    }

    /**
     * Guarda un carrito (array de productos) en localStorage.
     */
    function guardarCarrito(carrito) {
        localStorage.setItem(CLAVE_CARRITO, JSON.stringify(carrito));
    }

    // ==========================
    //   RENDERIZAR PRODUCTOS
    // ==========================

    /**
     * Decide qué mostrar en el <ul>: lista de productos o mensaje de vacío.
     */
    function renderizarCarrito() {
        const carrito = obtenerCarrito();
        if (!listaProductos) return;

        if (!carrito.length) {
            mostrarCarritoVacio();
            return;
        }

        listaProductos.innerHTML = '';
        carrito.forEach(producto => {
            listaProductos.appendChild(crearItemProducto(producto));
        });
    }

    /**
     * Muestra un único <li> indicando que no hay productos.
     */
    function mostrarCarritoVacio() {
        listaProductos.innerHTML = `
            <li class="list-group-item text-center text-muted py-4">
                El carrito está vacío
            </li>`;
    }

    /**
     * Construye un <li> con la información del producto y el botón eliminar.
     */
    function crearItemProducto(producto) {
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex gap-3 align-items-center py-3';
        li.dataset.idProducto = producto.id;

        li.innerHTML = `
            <img src="${producto.imagen}" alt="${producto.nombre}"
                 class="rounded" style="width:80px;height:80px;object-fit:cover">
            <div class="flex-grow-1">
                <h6 class="mb-1">${producto.nombre}</h6>
                <p class="text-muted mb-1">${producto.categoria}</p>
                <p class="mb-0">Precio: ${Number(producto.precio).toFixed(2)} €</p>
                <p class="mb-0">Cantidad: ${producto.cantidad}</p>
            </div>
            <button class="btn btn-outline-danger btn-sm" data-accion="eliminar">
                Eliminar
            </button>`;
        return li;
    }

    // ==========================
    //   ACCIONES DE LA LISTA
    // ==========================

    /**
     * Delegamos los clicks dentro del <ul> para identificar si se pulsó “Eliminar”.

     */
    function manejarClickLista(evento) {
        if (evento.target.dataset.accion === 'eliminar') {
            const id = evento.target.closest('li')?.dataset.idProducto;
            eliminarProductoPorId(id);
        }
    }

    /**
     * Elimina un producto concreto filtrando el array por su id.
     */
    function eliminarProductoPorId(idProducto) {
        const carritoActual = obtenerCarrito();
        const carritoFiltrado = carritoActual.filter(item => item.id !== idProducto);

        guardarCarrito(carritoFiltrado); // guardamos la nueva versión del carrito
        renderizarCarrito();             // actualizamos la lista visual
        actualizarTotales();             // recalculamos subtotal, descuento y total
    }

    /**
     * Borra todos los productos del carrito y reinicia la UI.
     */
    function vaciarCarrito() {
        localStorage.removeItem(CLAVE_CARRITO); // deja de existir en storage
        tasaDescuento = 0;                      // cualquier promo queda anulada
        mostrarCarritoVacio();                  // pintamos el mensaje vacío
        actualizarTotales();                    // totales a 0
    }

    // ==========================
    //   TOTALES Y PROMOS
    // ==========================

    /**
     * Calcula subtotal, descuento y total basándose en el carrito actual
     * y en la tasa de descuento aplicada.
     */
    function actualizarTotales() {
        const carrito = obtenerCarrito();

        // Subtotal: suma de precio*cantidad de cada producto.
        const subtotal = carrito.reduce(
            (total, item) => total + Number(item.precio) * Number(item.cantidad),
            0
        );

        const descuento = subtotal * tasaDescuento; // Desc = subtotal * porcentaje
        const total = subtotal - descuento;         // Total = subtotal - descuento

        subtotalEl.textContent  = subtotal.toFixed(2)  + ' €';
        descuentoEl.textContent = `-${descuento.toFixed(2)} €`;
        totalEl.textContent     = total.toFixed(2)     + ' €';
    }

    /**
     * Comprueba el código introducido: si es PORSCHE10 aplica 10%.
     * Si no, muestra un error y deja el descuento a 0.
     */
    function aplicarCodigoPromocional() {
        const codigo = (promoInput?.value || '').trim().toUpperCase();

        if (codigo === 'PORSCHE10') {
            tasaDescuento = 0.10;
            promoMsg.textContent = 'Código aplicado: 10% de descuento.';
        } else {
            tasaDescuento = 0;
            promoMsg.textContent = 'Código inválido.';
        }

        actualizarTotales();
    }

    // ==========================
    //   FINALIZAR PEDIDO
    // ==========================

    /**
     * Antes de redirigir verificamos si el carrito tiene productos.
     * Esta validación debe ser en JS porque el carrito sólo existe
     * en localStorage hasta que confirmes el pedido.
     */
    function finalizarPedido() {
        const carrito = obtenerCarrito();

        if (!carrito.length) {
            alert('El carrito está vacío. Agrega productos antes de continuar.');
            return;
        }

        window.location.href = 'index.php?controller=Pedido&action=confirmar';
    }
});