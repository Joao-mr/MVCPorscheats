<section class="container py-5">

    <!-- Título -->
    <h1 class="mb-4">Carrito</h1>

    <div class="row g-4">

        <!-- Columna izquierda -->
        <div class="col-lg-8">

            <!-- Código promocional -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Código promocional</h5>

                    <div class="input-group">
                        <input type="text" id="promoCode" class="form-control" placeholder="Introduce tu código">
                        <button class="btn btn-dark" id="applyPromo">Aplicar</button>
                    </div>

                    <small id="promoMessage" class="text-muted mt-2 d-block"></small>
                </div>
            </div>

            <!-- Lista de productos --> 
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Productos</h5>

                    <ul class="list-group list-group-flush" id="cartItems">
                        <!-- JS inyecta los productos aquí -->
                    </ul>
                </div>
            </div>

        </div>

        <!-- Columna derecha -->
        <div class="col-lg-4">

            <div class="card sticky-top" style="top:120px">
                <div class="card-body">
                    <h5 class="card-title mb-3">Resumen</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span id="subtotal">0.00 €</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Descuento</span>
                        <span id="discount">0.00 €</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                        <span>Total</span>
                        <span id="total">0.00 €</span>
                    </div>

                    <a href="index.php?controller=Pedido&action=confirmarVista" class="btn btn-dark w-100">
                        Finalizar compra
                    </a>
                </div>
            </div>

        </div>

    </div>

</section>
