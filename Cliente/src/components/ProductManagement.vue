<template>
  <!-- Contenido principal -->
  <div class="row mt-4 ">
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
              <div v-for="(imagen, index) in productoInd.imagenes" :key="index">
                <img :src="'data:image/png;base64,' + imagen" alt="Imagen" height="100" width="100" />
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

    <div class="mt-4">
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
            // Agregamos la propiedad cantidad para almacenar la cantidad seleccionada por el usuario
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
      // Añadir el producto al arreglo pedido solo si la cantidad es mayor a 0
      if (producto.cantidad > 0) {
        this.pedido.push({
          producto_id: producto.producto.id,
          cantidad: producto.cantidad,
        });
        // Reiniciar la cantidad seleccionada para este producto
        producto.cantidad = 0;
      }
    },
    async enviarPedido() {
      try {
        // Verificar si hay productos en el pedido antes de enviar la solicitud
        if (this.pedido.length === 0) {
          console.warn('No hay productos en el pedido.');
          return;
        }

        // Puedes enviar una solicitud al servidor para crear el pedido con los productos seleccionados
        const response = await fetch('http://127.0.0.1:8000/api/pedidos', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            productos: this.pedido,
            // Otros datos relacionados con el pedido que puedas necesitar enviar
          }),
        });

        const datos = await response.json();

        if (datos.success) {
          console.log('Pedido enviado correctamente:', datos.message);
          // Limpiar el arreglo pedido después de enviar el pedido
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
