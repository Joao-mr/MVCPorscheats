// Configuración de la API de divisas usada sólo como apoyo visual en el panel.
const FREECURRENCY_API_URL = 'https://api.freecurrencyapi.com/v1/latest';
const FREECURRENCY_DEFAULTS = { EUR: 1, USD: 1.09, GBP: 0.86, MXN: 18.5 };
const DEFAULT_API_KEY = 'fca_live_MJ4Fr0zs3hhXPevkGRZioVd1LghISfz5Bpjmz65J';

// Servicio responsable de todo el CRUD de productos en el panel.
class ProductoService {
    constructor(apiUrl, tableSelector, formCrearSelector, formEditarSelector) {
        this.apiUrl = apiUrl;
        this.tableSelector = tableSelector;
        this.formCrearSelector = formCrearSelector;
        this.formEditarSelector = formEditarSelector;
        this.productos = [];
        this.currencyRates = { ...FREECURRENCY_DEFAULTS };
        this.currentCurrency = 'EUR';
    }

    // Punto de entrada: cachea elementos, enlaza eventos y carga productos iniciales.
    init() {
        this.cacheElements();
        this.bindEvents();
        this.toggleCrearForm(true);
        this.loadProductos();
        this.loadExchangeRates();
    }

    // Referencias del DOM usadas en todo el servicio.
    cacheElements() {
        this.table = document.querySelector(this.tableSelector);
        this.tbody = this.table ? this.table.querySelector('tbody') : null;
        this.formCrear = document.querySelector(this.formCrearSelector);
        this.formEditar = document.querySelector(this.formEditarSelector);
        this.crearWrapper = document.getElementById('productoCrearWrapper');
        this.editarWrapper = document.getElementById('productoEditarWrapper');
        this.btnToggleCrear = document.getElementById('toggleCrearProducto');
        this.btnCerrarEditar = document.getElementById('cerrarEditarProducto');
        this.currencyPanel = document.getElementById('currencyPanel');
        this.currencySelect = document.getElementById('currencySelector');
        this.currencyInfo = document.getElementById('currencyRateInfo');
    }

    // Eventos principales: submit de formularios, clicks en la tabla y selector de moneda.
    bindEvents() {
        this.formCrear?.addEventListener('submit', (event) => {
            event.preventDefault();
            const data = Object.fromEntries(new FormData(this.formCrear));
            this.crearProducto(data);
        });

        this.formEditar?.addEventListener('submit', (event) => {
            event.preventDefault();
            const data = Object.fromEntries(new FormData(this.formEditar));
            this.editarProducto(data);
        });

        this.table?.addEventListener('click', (event) => {
            const editarBtn = event.target.closest('.btn-editar');
            if (editarBtn) {
                this.prepararEdicion(editarBtn.dataset.id);
                return;
            }

            const eliminarBtn = event.target.closest('.btn-eliminar');
            if (eliminarBtn) {
                this.eliminarProducto(eliminarBtn.dataset.id, eliminarBtn);
            }
        });

        this.btnToggleCrear?.addEventListener('click', () => this.toggleCrearForm());
        this.btnCerrarEditar?.addEventListener('click', () => this.hideEditarForm());

        this.currencySelect?.addEventListener('change', () => {
            this.currentCurrency = this.currencySelect.value;
            this.updateCurrencyInfo();
            this.renderProductos();
        });
    }

    // Descarga los productos de la API y refresca la tabla.
    async loadProductos() {
        const datos = await this.fetchProductos();
        this.productos = datos.map((item) => this.normalizeProducto(item));
        this.renderProductos();
    }

    // Fetch sencillo (GET) que devuelve un array o [] en caso de error.
    async fetchProductos() {
        try {
            const response = await fetch(this.apiUrl, { method: 'GET' });
            if (!response.ok) throw new Error(`Error ${response.status}`);
            const json = await response.json();
            return Array.isArray(json.data) ? json.data : [];
        } catch (error) {
            alert('Error al cargar productos');
            console.error('ProductoService.fetchProductos', error);
            return [];
        }
    }

    // Normaliza las distintas claves que puede enviar la API (id_producto, nombre_producto, etc.).
    normalizeProducto(raw) {
        const precioBruto = raw.precio_producto
            ?? raw.precio_unidad
            ?? raw.precio
            ?? raw.precio_unitario
            ?? raw.precio_venta
            ?? 0;

        return {
            id: raw.id_producto ?? raw.id ?? '',
            nombre: raw.nombre_producto ?? raw.nombre ?? raw.titulo ?? '',
            precio: Number(parseFloat(precioBruto) || 0),
            categoria: raw.categoria ?? raw.categoria_producto ?? '',
            descripcion: raw.descripcion ?? raw.descripcion_producto ?? ''
        };
    }

    // Dibuja la tabla usando map() y deja data-id preparado para los botones.
    renderProductos(productos = this.productos) {
        if (!this.tbody) return;

        const currency = this.currentCurrency;
        const rate = this.getSelectedRate();

        const rows = productos.map((producto) => {
            const precioBase = producto.precio.toFixed(2);
            const precioConvertido = (producto.precio * rate).toFixed(2);

            return `
                <tr>
                    <td>${producto.id}</td>
                    <td>${producto.nombre || 'Sin nombre'}</td>
                    <td>
                        ${precioBase} €
                        <br>
                        <small>${precioConvertido} ${currency}</small>
                    </td>
                    <td>${producto.categoria || '—'}</td>
                    <td class="product-actions">
                        <button class="btn-editar" data-id="${producto.id}">Editar</button>
                        <button class="btn-eliminar" data-id="${producto.id}">Eliminar</button>
                    </td>
                </tr>
            `;
        }).join('');

        this.tbody.innerHTML = rows || '<tr><td colspan="5">No hay productos disponibles.</td></tr>';
    }

    // Llena el formulario de edición y lo muestra.
    prepararEdicion(id) {
        if (!this.formEditar) return;
        const producto = this.productos.find((p) => String(p.id) === String(id));
        if (!producto) {
            alert('Producto no encontrado');
            return;
        }

        this.formEditar.querySelector('[name="id"]').value = producto.id;
        this.formEditar.querySelector('[name="nombre_producto"]').value = producto.nombre;
        this.formEditar.querySelector('[name="precio_producto"]').value = producto.precio;
        this.formEditar.querySelector('[name="categoria"]').value = producto.categoria;
        this.formEditar.querySelector('[name="descripcion"]').value = producto.descripcion;
        this.showEditarForm();
    }

    // POST: crea el producto, resetea el formulario y recarga la tabla.
    async crearProducto(data) {
        const payload = this.buildPayload(data);
        delete payload.id;

        try {
            const response = await fetch(this.apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const json = await response.json();
            if (!response.ok || json.status !== 'ok') throw new Error(json.message || 'No se pudo crear');

            this.formCrear.reset();
            await this.loadProductos();
            alert('Producto creado correctamente');
        } catch (error) {
            alert(error.message);
        }
    }

    // PUT: actualiza el producto seleccionado y vuelve a ocultar el formulario.
    async editarProducto(data) {
        if (!data.id) {
            alert('ID obligatorio');
            return;
        }

        const payload = this.buildPayload(data);

        try {
            const response = await fetch(this.apiUrl, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const json = await response.json();
            if (!response.ok || json.status !== 'ok') throw new Error(json.message || 'No se pudo actualizar');

            await this.loadProductos();
            this.hideEditarForm();
            alert('Producto actualizado correctamente');
        } catch (error) {
            alert(error.message);
        }
    }

    // DELETE: confirma, llama a la API y elimina la fila de la tabla.
    async eliminarProducto(id, button) {
        if (!id || !confirm('¿Eliminar este producto?')) return;

        try {
            const response = await fetch(`${this.apiUrl}&id=${encodeURIComponent(id)}`, {
                method: 'DELETE'
            });
            const json = await response.json();
            if (!response.ok || json.status !== 'ok') throw new Error(json.message || 'No se pudo eliminar');

            button.closest('tr')?.remove();
            this.productos = this.productos.filter((p) => String(p.id) !== String(id));
            if (!this.productos.length) {
                await this.loadProductos();
            }
            alert('Producto eliminado correctamente');
        } catch (error) {
            alert(error.message);
        }
    }

    // Construye el payload que entiende la API (enviamos ambas variantes de nombres por compatibilidad).
    buildPayload(data) {
        const nombre = data.nombre_producto ?? data.nombre ?? '';
        const precio = data.precio_producto ?? data.precio_unidad ?? data.precio ?? '';
        const categoria = data.categoria ?? data.categoria_producto ?? '';
        const descripcion = data.descripcion ?? data.descripcion_producto ?? '';

        return {
            id: data.id ?? data.id_producto ?? '',
            nombre,
            nombre_producto: nombre,
            precio,
            precio_producto: precio,
            precio_unidad: precio,
            categoria,
            categoria_producto: categoria,
            descripcion,
            descripcion_producto: descripcion
        };
    }

    // Helpers visuales para mostrar/ocultar formularios.
    toggleCrearForm(forceOpen = null) {
        if (!this.crearWrapper || !this.btnToggleCrear) return;

        const isHidden = this.crearWrapper.classList.contains('is-hidden');
        const shouldOpen = forceOpen !== null ? forceOpen : isHidden;

        this.crearWrapper.classList.toggle('is-hidden', !shouldOpen);
        this.btnToggleCrear.textContent = shouldOpen ? '− Ocultar formulario' : '+ Nuevo producto';
    }

    showEditarForm() {
        this.editarWrapper?.classList.remove('is-hidden');
    }

    hideEditarForm() {
        this.editarWrapper?.classList.add('is-hidden');
        this.formEditar?.reset();
    }

    // Carga las divisas desde la API o usa los valores por defecto.
    async loadExchangeRates() {
        const apiKey = this.currencyPanel?.dataset.apiKey || DEFAULT_API_KEY;

        if (!apiKey) {
            this.updateCurrencyInfo();
            return;
        }

        try {
            const monedas = ['USD', 'GBP', 'MXN'];
            const url = `${FREECURRENCY_API_URL}?apikey=${encodeURIComponent(apiKey)}&base_currency=EUR&currencies=${monedas.join(',')}`;
            const response = await fetch(url);
            if (!response.ok) throw new Error(`API currency ${response.status}`);
            const json = await response.json();
            const data = json?.data || {};
            this.currencyRates = { EUR: 1, ...FREECURRENCY_DEFAULTS, ...data };
        } catch (error) {
            console.warn('No se pudieron cargar divisas, usando valores por defecto.', error);
            this.currencyRates = { ...FREECURRENCY_DEFAULTS };
        } finally {
            this.updateCurrencyInfo();
            this.renderProductos();
        }
    }

    // Devuelve la tasa seleccionada; si no existe, 1.
    getSelectedRate() {
        return this.currencyRates?.[this.currentCurrency] ?? 1;
    }

    // Actualiza el texto informativo debajo del selector de moneda.
    updateCurrencyInfo() {
        if (!this.currencyInfo) return;
        const rate = this.getSelectedRate();
        this.currencyInfo.textContent = `1 € = ${rate.toFixed(3)} ${this.currentCurrency}`;
    }
}

// Instancia del servicio (mantiene el uso de clases, eventos y fetch del enunciado).
document.addEventListener('DOMContentLoaded', () => {
    const servicioProductos = new ProductoService(
        'index.php?controller=APIProducto&action=index',
        '#tablaProductos',
        '#formProductoCrear',
        '#formProductoEditar'
    );
    servicioProductos.init();
});