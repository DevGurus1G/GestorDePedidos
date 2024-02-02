<template>
  <div class="row mt-4">
    <div class="col">
      <h1 class="mb-4">Lista de Pedidos</h1>
      <!-- Campo de búsqueda -->
      <div class="mb-3">
        <label for="buscar" class="form-label">Buscar Pedido</label>
        <input v-model="busqueda" @input="filtrarPedidos" type="text" class="form-control" id="buscar">
      </div>
      <!-- Mensaje mientras cargan los datos -->
      <div v-if="cargando" class="alert alert-info">
        <p class="mb-0">Cargando datos de pedidos...</p>
      </div>
      <div v-else>
        <div v-if="pedidosFiltrados.length > 0" class="table-responsive">
          <table class="table table-hover table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
              <tr>
                <th scope="col">ID Pedido</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Productos del pedido</th>
                <th scope="col">Precio Total</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="pedido in pedidosFiltrados" :key="pedido.id_pedido">
                <td>{{ pedido.id_pedido }}</td>
                <td>{{ pedido.fecha }}</td>
                <td>{{ pedido.estado }}</td>
                <td>
                  <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                    :data-bs-target="'#detallesCollapse' + pedido.id_pedido" aria-expanded="false"
                    aria-controls="detallesCollapse">
                    Ver los productos del pedido
                  </button>
                  <div class="collapse" :id="'detallesCollapse' + pedido.id_pedido">
                    <table class="table table-bordered text-center table-striped">
                      <thead class="table-dark">
                        <tr>
                          <th scope="col">Formato</th>
                          <th scope="col">Producto</th>
                          <th scope="col">Categoría</th>
                          <th scope="col">Precio</th>
                          <th scope="col">Cantidad</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="detalle in pedido.detalles" :key="detalle.formato_producto_id">
                          <td>{{ detalle.formato || 'N/A' }}</td>
                          <td>{{ detalle.producto?.nombre || 'N/A' }}</td>
                          <td>{{ detalle.producto?.categoria || 'N/A' }}</td>
                          <td>{{ detalle.precio || 'N/A' }}€</td>
                          <td>{{ detalle.cantidad || 'N/A' }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </td>
                <td>{{ calcularPrecioTotal(pedido) }}€</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-else class="alert alert-warning">
          <p class="mb-0">Este cliente no ha realizado ningún pedido aún.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isAuthenticated: this.autenticacion(),
      pedidos: [],
      pedidosFiltrados: [],
      cargando: true,
      busqueda: '',
    };
  },
  mounted() {
    this.loadPedidos();
  },
  methods: {
    async loadPedidos() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/pedidos/' + sessionStorage.getItem('codigo'));
        const datos = await response.json();

        if (datos.success) {
          this.pedidos = datos.data.map(pedido => {
            pedido.precioTotal = this.calcularPrecioTotal(pedido);
            return pedido;
          });
          this.filtrarPedidos(); // Filtrar pedidos al cargarlos
        } else {
          console.error('Error al obtener pedidos:', datos.message);
        }
      } catch (error) {
        console.error('Error en la solicitud para obtener pedidos:', error);
      } finally {
        this.cargando = false; // Indicamos que la carga ha finalizado
      }
    },
    autenticacion() {
      return sessionStorage.getItem('autenticado');
    },
    calcularPrecioTotal(pedido) {
      let total = 0;
      pedido.detalles.forEach(detalle => {
        total += detalle.precio * detalle.cantidad;
      });
      return parseFloat(total.toFixed(2));
    },
    filtrarPedidos() {
      const busquedaMinusculas = this.busqueda.toLowerCase().trim();

      this.pedidosFiltrados = this.pedidos.filter(pedido => {
        return (
          pedido.id_pedido.toString().includes(busquedaMinusculas) ||
          pedido.fecha.includes(busquedaMinusculas) ||
          pedido.estado.toLowerCase().includes(busquedaMinusculas) ||
          this.productosEnPedido(pedido).toLowerCase().includes(busquedaMinusculas) ||
          pedido.precioTotal.toString().includes(busquedaMinusculas)
        );
      });
    },
    productosEnPedido(pedido) {
      return pedido.detalles
        .map(detalle => `${detalle.formato || 'N/A'} - ${detalle.producto?.categoria || 'N/A'} - ${detalle.producto?.nombre || 'N/A'} (${detalle.cantidad} unidades)`)
        .join(', ');
    },
  },
};
</script>

<style scoped>
.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}
</style>
