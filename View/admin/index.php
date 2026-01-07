<div class="admin-layout">
    <nav class="admin-sidebar">
        <h1 class="admin-title">Panel de Administración</h1>
        <ul class="admin-menu">
            <li><button class="menu-btn active" data-section="dashboard">Dashboard (Pedidos)</button></li>
            <li><button class="menu-btn" data-section="productos">Productos</button></li>
        </ul>
    </nav>

    <main class="admin-content">
        <section id="dashboard" class="admin-section visible">
            <header class="section-header">
                <div>
                    <p class="section-kicker">Resumen general</p>
                    <h2>Pedidos</h2>
                </div>
            </header>

            <div class="panel-card">
                <div class="pedido-filtros">
                    <label>
                        Usuario
                        <input type="text" id="filterUsuario" class="filtro-input" placeholder="Buscar por usuario">
                    </label>
                    <label>
                        Fecha
                        <input type="date" id="filterFecha" class="filtro-input">
                    </label>
                    <label>
                        Importe mínimo
                        <input type="number" id="filterMinimo" class="filtro-input" min="0" step="0.01" placeholder="0.00">
                    </label>
                </div>
                <p id="pedidoTotal" class="pedido-total">Total visible: 0.00 €</p>
            </div>

            <div class="panel-card">
                <div class="tabla-wrapper">
                    <table id="tablaPedidos" class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td colspan="5">Cargando pedidos...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="productos" class="admin-section">
            <header class="section-header">
                <div>
                    <p class="section-kicker">Gestión básica</p>
                    <h2>Productos</h2>
                </div>
                <button id="toggleCrearProducto" type="button" class="btn-secondary">+ Nuevo producto</button>
            </header>

            <div id="currencyPanel"
                 class="panel-card currency-panel"
                 data-api-key="<?= htmlspecialchars(getenv('FREECURRENCY_API_KEY') ?: '', ENT_QUOTES, 'UTF-8') ?>">
                <div class="currency-panel__content">
                    <label for="currencySelector">Moneda</label>
                    <select id="currencySelector">
                        <option value="EUR" selected>EUR (€)</option>
                        <option value="USD">USD ($)</option>
                        <option value="GBP">GBP (£)</option>
                        <option value="MXN">MXN ($)</option>
                    </select>
                    <p id="currencyRateInfo" class="currency-rate-info">1 € = 1.000 EUR</p>
                </div>

            </div>

            <div id="productoCrearWrapper" class="panel-card">
                <form id="formProductoCrear" class="form-grid">
                    <label>Nombre
                        <input name="nombre_producto" type="text" required placeholder="Nombre del producto">
                    </label>
                    <label>Precio
                        <input name="precio_producto" type="number" step="0.01" min="0" required placeholder="0.00">
                    </label>
                    <label>Categoría
                        <select class="select-categoria" name="categoria" required>
                            <option value="">Selecciona categoría</option>
                            <option value="primeros">Primeros</option>
                            <option value="segundos">Segundos</option>
                            <option value="postres">Postres</option>
                            <option value="bebidas">Bebidas</option>
                        </select>
                    </label>
                    <label>Descripción
                        <textarea name="descripcion" rows="2" placeholder="Descripción breve"></textarea>
                    </label>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Crear producto</button>
                    </div>
                </form>
            </div>

            <div id="productoEditarWrapper" class="panel-card is-hidden">
                <div class="panel-card-header">
                    <h3>Editar producto</h3>
                    <button type="button" id="cerrarEditarProducto" class="btn-link">Cancelar</button>
                </div>
                <form id="formProductoEditar" class="form-grid">
                    <input type="hidden" name="id">
                    <label>Nombre
                        <input name="nombre_producto" type="text" required placeholder="Nombre del producto">
                    </label>
                    <label>Precio
                        <input name="precio_producto" type="number" step="0.01" min="0" required placeholder="0.00">
                    </label>
                    <label>Categoría
                        <select class="select-categoria" name="categoria" required>
                            <option value="">Selecciona categoría</option>
                            <option value="primeros">Primeros</option>
                            <option value="segundos">Segundos</option>
                            <option value="postres">Postres</option>
                            <option value="bebidas">Bebidas</option>
                        </select>
                    </label>

                    <label>Descripción
                        <textarea name="descripcion" rows="2" placeholder="Descripción breve"></textarea>
                    </label>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>

            <div class="panel-card">
                <div class="tabla-wrapper">
                    <table id="tablaProductos" class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Categoría</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td colspan="5">Cargando productos...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</div>
