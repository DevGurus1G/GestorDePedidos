<template>
  <!-- Contenido principal -->
  <div class="row mt-4">
    <h1>Lista de Productos</h1>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nombre producto</th>
            <th scope="col">Categoria</th>
            <th scope="col">Precio</th>
            <th scope="col">Formato</th>
            <th scope="col">Fotos</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="productoInd in productos" :key="productoInd.id">
            <td>{{ productoInd.producto.nombre }}</td>
            <td>{{ productoInd.producto.categoria.nombre }}</td>
            <td>{{ productoInd.precio }}</td>
            <td>{{ productoInd.formato.tipo }}</td>
            <td>
              <div>
                <img v-if="productoInd.imagenes.length > 0" :src="'data:image/png;base64,' + productoInd.imagenes[0]"
                  alt="Imagen" height="100" width="100" />
                <span v-else>No hay imagen disponible</span>
              </div>
            </td>
            <td>
              <input type="number" v-model="productoInd.cantidad" min="0" step="1" class="form-control" />
            </td>
            <td>
              <button @click="anadirAlPedido(productoInd)" class="btn btn-primary">Añadir al Pedido</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Sección para mostrar y gestionar el pedido -->
    <div class="mt-4" v-if="pedido.length > 0">
      <h2>Pedido Actual</h2>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Producto</th>
            <th scope="col">Formato</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio Unitario</th>
            <th scope="col">Precio Total</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in pedido" :key="index">
            <td>{{ item.producto.nombre }}</td>
            <td>{{ item.formato.tipo }}</td>
            <td>{{ item.cantidad }}</td>
            <td>{{ item.producto_precio }}</td>
            <td>{{ item.producto_precio * item.cantidad }}</td>
            <td>
              <button @click="eliminarDelPedido(index)" class="btn btn-danger">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>

      <button @click="enviarPedido" class="btn btn-success">Enviar Pedido</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isAuthenticated: this.autenticacion(),
      productos: [],
      pedido: [],
    };
  },
  methods: {
    async loadProducts() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/productos');
        const datos = await response.json();

        if (datos.success) {
          this.productos = datos.data.map(producto => {
            producto.cantidad = 0;
            return producto;
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
    anadirAlPedido(producto) {
      if (producto.cantidad > 0) {
        const index = this.pedido.findIndex(
          item => item.producto.id === producto.producto.id && item.formato.id === producto.formato.id
        );

        if (index !== -1) {
          this.pedido[index].cantidad += producto.cantidad;
        } else {
          this.pedido.push({
            producto_id: producto.producto.id,
            formato_id: producto.formato.id,
            formato_productos: producto.id,
            cantidad: producto.cantidad,
            producto: producto.producto,
            formato: producto.formato,
            producto_precio: producto.precio,
          });
        }

        producto.cantidad = 0;
      }
    },
    eliminarDelPedido(index) {
      this.pedido.splice(index, 1);
    },
    async enviarPedido() {
      try {
        if (this.pedido.length === 0) {
          console.warn('No hay productos en el pedido.');
          return;
        }

        const response = await fetch('http://127.0.0.1:8000/api/pedidos/crear', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            cliente: localStorage.getItem('codigo'),
            productos: this.pedido.map(item => ({
              formato_productos: item.producto_id,
              cantidad: item.cantidad,
            })),
          }),
        });

        const datos = await response.json();

        if (datos.success) {
          console.log('Pedido enviado correctamente:', datos.message);
          this.pedido = [];
        } else {
          console.error('Error al enviar el pedido:', datos.message);
        }
      } catch (error) {
        console.error('Error en la solicitud para enviar el pedido:', error);
      }
    },
  },
  mounted() {
    this.loadProducts();
  },
};
</script>

<style scoped></style>
