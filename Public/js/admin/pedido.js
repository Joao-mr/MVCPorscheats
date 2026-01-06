class PedidoService {
    constructor(apiUrl, tableSelector, summarySelector) {
        this.apiUrl = apiUrl;
        this.tableSelector = tableSelector;
        this.summarySelector = summarySelector;
        this.pedidos = [];
        this.estadosPermitidos = ['pendiente', 'pagado','entregado', 'cancelado'];
    }

    init() {
        this.cacheElements();
        this.bindEvents();
        this.loadPedidos();
    }

    cacheElements() {
        this.table = document.querySelector(this.tableSelector);
        this.tbody = this.table ? this.table.querySelector('tbody') : null;
        this.summary = document.querySelector(this.summarySelector);
        this.filterUsuario = document.getElementById('filterUsuario');
        this.filterFecha = document.getElementById('filterFecha');
        this.filterMinimo = document.getElementById('filterMinimo');
    }

    bindEvents() {
        this.filterUsuario?.addEventListener('input', () => this.applyFilters());
        this.filterFecha?.addEventListener('change', () => this.applyFilters());
        this.filterMinimo?.addEventListener('input', () => this.applyFilters());

        // Delegar cambios de estado en la tabla
        this.table?.addEventListener('change', (event) => {
            const select = event.target.closest('.pedido-estado');
            if (!select) return;

            const pedidoId = select.dataset.id;
            const nuevoEstado = select.value;
            const estadoAnterior = select.dataset.prev || nuevoEstado;

            this.updateEstado(pedidoId, nuevoEstado, estadoAnterior, select);
        });
    }

    async loadPedidos() {
        this.pedidos = await this.fetchPedidos();
        this.applyFilters();
    }

    async fetchPedidos() {
        try {
            const response = await fetch(this.apiUrl, { method: 'GET' });
            if (!response.ok) throw new Error(`Error ${response.status}`);
            const json = await response.json();
            return Array.isArray(json.data) ? json.data : [];
        } catch (error) {
            console.error('No se pudieron cargar los pedidos:', error.message);
            return [];
        }
    }

    applyFilters() {
        const usuarioFiltro = (this.filterUsuario?.value || '').trim().toLowerCase();
        const fechaFiltro = this.filterFecha?.value || '';
        const minimoFiltro = Number(this.filterMinimo?.value) || 0;

        const pedidosFiltrados = this.pedidos.filter(pedido => {
            const usuario = String(pedido.id_usuario ?? '').toLowerCase();
            const fecha = pedido.fecha_pedido ?? '';
            const total = Number(pedido.importe_total) || 0;

            const coincideUsuario = usuarioFiltro === '' || usuario.includes(usuarioFiltro);
            const coincideFecha = fechaFiltro === '' || fecha.startsWith(fechaFiltro);
            const coincideImporte = total >= minimoFiltro;

            return coincideUsuario && coincideFecha && coincideImporte;
        });

        this.renderPedidos(pedidosFiltrados);
    }

    renderPedidos(pedidos) {
        if (!this.tbody) return;

        const rows = pedidos.map(pedido => {
            const id = pedido.id_pedido ?? '';
            const usuario = pedido.id_usuario ?? '';
            const fecha = pedido.fecha_pedido ?? '';
            const estado = (pedido.estado ?? '').toLowerCase();
            const total = (Number(pedido.importe_total) || 0).toFixed(2);

            const opciones = this.estadosPermitidos
                .map(est => `<option value="${est}" ${est === estado ? 'selected' : ''}>${est}</option>`)
                .join('');

            return `
                <tr>
                    <td>${id}</td>
                    <td>${usuario}</td>
                    <td>${fecha}</td>
                    <td>
                        <select class="pedido-estado" data-id="${id}" data-prev="${estado}">
                            ${opciones}
                        </select>
                    </td>
                    <td>${total} €</td>
                </tr>`;
        }).join('');

        this.tbody.innerHTML = rows || '<tr><td colspan="5">No hay pedidos disponibles.</td></tr>';

        const totalVisible = pedidos.reduce((acc, pedido) => acc + (Number(pedido.importe_total) || 0), 0);
        if (this.summary) {
            this.summary.textContent = `Total visible: ${totalVisible.toFixed(2)} €`;
        }
    }

    async updateEstado(id, estado, estadoAnterior, select) {
        try {
            const response = await fetch(this.apiUrl, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, estado })
            });

            const json = await response.json();
            if (!response.ok || json.status !== 'ok') {
                throw new Error(json.message || 'No se pudo actualizar el estado');
            }

            select.dataset.prev = estado;
            alert('Estado actualizado correctamente.');
        } catch (error) {
            alert(error.message);
            select.value = estadoAnterior;
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const servicioPedidos = new PedidoService(
        'index.php?controller=APIPedido&action=index',
        '#tablaPedidos',
        '#pedidoTotal'
    );
    servicioPedidos.init();
});