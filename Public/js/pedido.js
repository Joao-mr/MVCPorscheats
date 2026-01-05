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
            headers: { 'Content-Type': 'application/json' },
            credentials: 'same-origin',
            body: JSON.stringify(payload)
        })
            // 1) Leemos la respuesta como texto para inspeccionarla si llega HTML o warnings.
            .then(response => response.text())
            .then(text => {
                console.log('RESPUESTA RAW:', text); // ayuda a depurar lo que realmente devuelve PHP

                let data;
                try {
                    data = JSON.parse(text); // 2) Intentamos convertirlo a JSON.
                } catch (e) {
                    throw new Error('Respuesta no es JSON válido'); // si falla, forzamos el catch principal.
                }

                if (data.status === 'ok') {
                    localStorage.removeItem('carrito'); // pedido correcto → vaciamos carrito
                    window.location.href = 'index.php?controller=Pedido&action=exito&id=' + data.idPedido;
                } else if (data.status === 'login_required') {
                    alert('Debes iniciar sesión');
                    window.location.href = 'index.php?controller=Usuario&action=login';
                } else {
                    alert(data.message || 'Error al confirmar pedido');
                }
            })
            .catch(err => {
                console.error(err);
                alert('No se pudo confirmar el pedido. Inténtalo de nuevo.');
            });
    });
});