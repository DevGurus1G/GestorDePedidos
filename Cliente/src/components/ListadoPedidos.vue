<template>
  <div class="row mt-4">
    <div class="col">
      <h1 class="mb-4">Lista de Pedidos</h1>
      <div v-if="pedidos.length > 0" class="table-responsive">
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
            <tr v-for="pedido in pedidos" :key="pedido.id_pedido">
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
</template>

<script>
export default {
  data() {
    return {
      isAuthenticated: this.autenticacion(),
      pedidos: [],
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
        } else {
          console.error('Error al obtener productos:', datos.message);
        }
      } catch (error) {
        console.error('Error en la solicitud para obtener productos:', error);
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
      return total;
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
