document.addEventListener('DOMContentLoaded', function () {
    // Buscamos el botón de confirmar para vincular el envío del pedido.
    const btnConfirmar = document.getElementById('btnConfirmarPedido');
    if (!btnConfirmar) return;

    btnConfirmar.addEventListener('click', function () {
        // Leemos el carrito almacenado en localStorage; si no hay datos usamos un array vacío.
        const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        if (!carrito.length) {
            alert('No hay productos en el carrito.');
            return;
        }

        //  Calculamos subtotal y total para enviar un resumen al backend.
        const subtotal = carrito.reduce(function (total, item) {
            return total + Number(item.precio) * Number(item.cantidad);
        }, 0);

        // Construimos el payload que recibirá el backend (puedes añadir más campos si lo necesitas).
        const payload = {
            carrito: carrito,
            subtotal: subtotal
        };

        // Usamos fetch POST con JSON para enviar la información a la ruta que procese el pedido.
       fetch('index.php?controller=Pedido&action=confirmar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin', 
            body: JSON.stringify(payload)
        })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Error al confirmar el pedido.');
                }
                return response.json();
            })
            .then(function (data) {
                //  Si el servidor responde correctamente, limpiamos el carrito y redirigimos.
                localStorage.removeItem('carrito'); // eliminamos todos los productos guardados
                // Enviamos al usuario a la página de éxito (ajusta la URL si es necesario).
                window.location.href = 'index.php?controller=Pedido&action=exito&id=' + data.idPedido;
            })
            .catch(function (error) {
                // Ante cualquier fallo mostramos un mensaje simple al usuario.
                console.error(error);
                alert('No se pudo confirmar el pedido. Inténtalo de nuevo.');
            });
    });
});