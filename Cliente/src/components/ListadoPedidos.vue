<template>
  <div class="row mt-4">
    <h1 class="mb-4">Lista de Pedidos</h1>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">ID Pedido</th>
            <th scope="col">Fecha</th>
            <th scope="col">Estado</th>
            <th scope="col">Detalles</th>
            <th scope="col">Precio Total</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pedido in pedidos" :key="pedido.id_pedido">
            <td>{{ pedido.id_pedido }}</td>
            <td>{{ pedido.fecha }}</td>
            <td>{{ pedido.estado }}</td>
            <td>
              <table class="table table-bordered text-center">
                <thead>
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
                    <td>{{ detalle.precio || 'N/A' }}</td>
                    <td>{{ detalle.cantidad || 'N/A' }}</td>
                  </tr>
                </tbody>
              </table>
            </td>
            <td>{{ calcularPrecioTotal(pedido) }}</td>
          </tr>
        </tbody>
      </table>
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
        const response = await fetch('http://127.0.0.1:8000/api/pedidos/' + localStorage.getItem('codigo'));
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
      return localStorage.getItem('autenticado');
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
