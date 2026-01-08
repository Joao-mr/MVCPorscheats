document.addEventListener('DOMContentLoaded', () => {
    // Botón principal para confirmar el pedido; si no existe, no hacemos nada.
    const btnConfirmar = document.getElementById('btnConfirmarPedido');
    if (!btnConfirmar) return;

    // Al confirmar: validamos carrito, construimos payload y lo enviamos vía fetch.
    btnConfirmar.addEventListener('click', () => {
        const carrito = obtenerCarrito();
        if (!carrito.length) {
            alert('No hay productos en el carrito.');
            return;
        }

        const payload = construirPayload(carrito);
        enviarPedido(payload)
            .then(texto => gestionarRespuesta(texto, carrito))
            .catch(error => {
                console.error(error);
                alert('No se pudo confirmar el pedido. Inténtalo de nuevo.');
            });
    });

    // Lee el carrito del localStorage; si hay error devolvemos array vacío.
    function obtenerCarrito() {
        try {
            return JSON.parse(localStorage.getItem('carrito')) || [];
        } catch {
            return [];
        }
    }

    // Calcula el subtotal multiplicando precio por cantidad de cada ítem.
    function calcularSubtotal(carrito) {
        return carrito.reduce((total, item) => {
            return total + Number(item.precio) * Number(item.cantidad);
        }, 0);
    }

    // Crea el objeto que se envía al backend con carrito y subtotal.
    function construirPayload(carrito) {
        return {
            carrito,
            subtotal: calcularSubtotal(carrito)
        };
    }

    // Envía el pedido al endpoint MVC usando fetch con JSON.
    function enviarPedido(payload) {
        return fetch('index.php?controller=Pedido&action=confirmar', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            credentials: 'same-origin',
            body: JSON.stringify(payload)
        }).then(response => response.text());
    }

    // Intenta parsear la respuesta y actúa según el estado devuelto.
    function gestionarRespuesta(texto) {
        let data;
        try {
            data = JSON.parse(texto);
        } catch {
            console.log('RESPUESTA RAW:', texto);
            throw new Error('Respuesta no es JSON válido');
        }

        if (data.status === 'ok') {
            localStorage.removeItem('carrito');
            window.location.href = `index.php?controller=Pedido&action=exito&id=${data.idPedido}`;
            return;
        }

        if (data.status === 'login_required') {
            alert('Debes iniciar sesión');
            window.location.href = 'index.php?controller=Usuario&action=login';
            return;
        }

        alert(data.message || 'Error al confirmar pedido');
    }
});