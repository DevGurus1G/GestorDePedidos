<template>
  <!-- Contenido principal -->
  <div class="row mt-4">
    <div :class="{ 'col-xl-6': pedido.length > 0, 'col-12': pedido.length === 0 }">
      <h1 class="mb-4">Lista de Productos</h1>
      <!-- Campo de búsqueda -->
      <div class="mb-3">
        <label for="buscar" class="form-label">Buscar Producto</label>
        <input v-model="busqueda" @input="filtrarProductos" type="text" class="form-control" id="buscar">
      </div>
      <!-- Mensaje mientras cargan los datos -->
      <div v-if="cargando" class="alert alert-info">
        <p class="mb-0">Cargando datos de los productos...</p>
      </div>
      <div v-else>
        <div v-if="productosFiltrados.length > 0" class="table-responsive">
          <table class="table table-hover table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
              <tr>
                <th scope="col" @click="ordenar('nombre')">
                  Nombre producto
                  <span v-if="orden === 'asc:nombre'">↑</span>
                  <span v-if="orden === 'desc:nombre'">↓</span>
                </th>
                <th scope="col" @click="ordenar('categoria')">
                  Categoria
                  <span v-if="orden === 'asc:categoria'">↑</span>
                  <span v-if="orden === 'desc:categoria'">↓</span>
                </th>
                <th scope="col" @click="ordenar('precio')">
                  Precio
                  <span v-if="orden === 'asc:precio'">↑</span>
                  <span v-if="orden === 'desc:precio'">↓</span>
                </th>
                <th scope="col" @click="ordenar('formato')">
                  Formato
                  <span v-if="orden === 'asc:formato'">↑</span>
                  <span v-if="orden === 'desc:formato'">↓</span>
                </th>
                <th scope="col">Fotos</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="productoInd in productosFiltrados" :key="productoInd.id">
                <td>{{ productoInd.producto.nombre }}</td>
                <td>{{ productoInd.producto.categoria.nombre }}</td>
                <td>{{ productoInd.precio }}€</td>
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
        <div v-else class="alert alert-warning">
          <p class="mb-0">No hay productos disponibles con el criterio de búsqueda.</p>
        </div>
      </div>
    </div>

    <!-- Sección para mostrar y gestionar el pedido -->
    <div class="mt-4 col-xl-6" v-if="pedido.length > 0">
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
            <td>{{ item.producto_precio }}€</td>
            <td>{{ item.producto_precio * item.cantidad }}€</td>
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

<script setup>
import { ref, watch, onMounted } from 'vue';

const isAuthenticated = sessionStorage.getItem('autenticado');
const productos = ref([]);
const productosFiltrados = ref([]);
const pedido = ref([]);
const cargando = ref(true);
const busqueda = ref('');
const orden = ref(null);

const ordenar = (columna) => {
  if (orden.value && orden.value.includes(columna)) {
    orden.value = orden.value.startsWith('asc') ? `desc:${columna}` : `asc:${columna}`;
  } else {
    orden.value = `asc:${columna}`;
  }

  filtrarProductos();
};

const obtenerValorOrdenamiento = (item, columna) => {
  switch (columna) {
    case 'nombre':
      return item.producto.nombre.toLowerCase();
    case 'categoria':
      return item.producto.categoria.nombre.toLowerCase();
    case 'precio':
      return item.precio;
    case 'formato':
      return item.formato.tipo.toLowerCase();
    default:
      return '';
  }
};

const loadProducts = async () => {
  try {
    const response = await fetch('http://killercervezas.blog/api/productos');
    const datos = await response.json();

    if (datos.success) {
      productos.value = datos.data.map(producto => {
        producto.cantidad = 0;
        return producto;
      });
      filtrarProductos(); // Filtrar productos al cargarlos
    } else {
      console.error('Error al obtener productos:', datos.message);
    }
  } catch (error) {
    console.error('Error en la solicitud para obtener productos:', error);
  } finally {
    cargando.value = false; // Indicamos que la carga ha finalizado
  }
};

const autenticacion = () => {
  return isAuthenticated;
};

const anadirAlPedido = (producto) => {
  if (producto.cantidad > 0) {
    const index = pedido.value.findIndex(
      item => item.producto.id === producto.producto.id && item.formato.id === producto.formato.id
    );

    if (index !== -1) {
      pedido.value[index].cantidad += producto.cantidad;
    } else {
      pedido.value.push({
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
};

const eliminarDelPedido = (index) => {
  pedido.value.splice(index, 1);
};

const enviarPedido = async () => {
  try {
    if (pedido.value.length === 0) {
      console.warn('No hay productos en el pedido.');
      return;
    }

    const response = await fetch('http://killercervezas.blog/api/pedidos/crear', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        cliente: sessionStorage.getItem('codigo'),
        productos: pedido.value.map(item => ({
          formato_productos: item.formato_productos,
          cantidad: item.cantidad,
        })),
      }),
    });

    const datos = await response.json();

    if (datos.success) {
      console.log('Pedido enviado correctamente:', datos.message);
      pedido.value = [];
    } else {
      console.error('Error al enviar el pedido:', datos.message);
    }
  } catch (error) {
    console.error('Error en la solicitud para enviar el pedido:', error);
  }
};

const filtrarProductos = () => {
  const busquedaMinusculas = busqueda.value.toLowerCase().trim();

  productosFiltrados.value = productos.value.filter(producto => {
    return (
      producto.producto.nombre.toLowerCase().includes(busquedaMinusculas) ||
      producto.producto.categoria.nombre.toLowerCase().includes(busquedaMinusculas) ||
      producto.precio.toString().includes(busquedaMinusculas) ||
      producto.formato.tipo.toLowerCase().includes(busquedaMinusculas)
    );
  });

  // Aplicar ordenamiento
  if (orden.value) {
    const [ordenamiento, columna] = orden.value.split(':');
    const ordenMultiplier = ordenamiento === 'asc' ? 1 : -1;

    productosFiltrados.value.sort((a, b) => {
      const valorA = obtenerValorOrdenamiento(a, columna);
      const valorB = obtenerValorOrdenamiento(b, columna);

      return valorA > valorB ? 1 * ordenMultiplier : valorA < valorB ? -1 * ordenMultiplier : 0;
    });
  }
};

watch(busqueda, () => {
  filtrarProductos();
});

onMounted(() => {
  loadProducts();
});
</script>

<style scoped></style>
