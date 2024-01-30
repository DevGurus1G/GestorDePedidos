<template>
  <div class="container">

    <div class="row">
      <div class="col-12">
        <!-- NAVBAR ================================================== -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container-fluid">
            <router-link to="/" class="navbar-brand">DevGurus</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
              aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div v-if="isAuthenticated" class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <router-link to="/product-management" class="nav-link">Gestión de Productos</router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/listado-pedidos" class=" nav-link">Lista de Pedidos</router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/perfil-usuario" class=" nav-link">Perfil de usuario</router-link>
                </li>
                <li class="nav-item">
                  <button @click="logout" class="nav-link" type="button">Cerrar
                    Sesión</button>
                </li>
              </ul>

            </div>
          </div>
        </nav>
      </div>
    </div>


    <!-- Contenido principal -->
    <div class="row mt-4">
      <h1>Lista de Pedidos</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID Pedido</th>
            <th scope="col">Fecha</th>
            <th scope="col">Estado</th>
            <th scope="col">Detalles</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pedido in pedidos" :key="pedido.id_pedido">
            <td>{{ pedido.id_pedido }}</td>
            <td>{{ pedido.fecha }}</td>
            <td>{{ pedido.estado }}</td>
            <td>
              <ul>
                <li v-for="detalle in pedido.detalles" :key="detalle.formato_producto_id">
                  <strong>Formato:</strong> {{ detalle.detalles[0].formato }}
                  <br>
                  <strong>Producto:</strong> {{ detalle.detalles[0].producto.nombre }}
                  <br>
                  <strong>Categoría:</strong> {{ detalle.detalles[0].producto.categoria }}
                  <br>
                  <strong>Precio:</strong> {{ detalle.detalles[0].precio }}
                  <br>
                </li>
              </ul>
            </td>
          </tr>
        </tbody>
      </table>
    </div>



    <!-- FOOTER -->
    <div class="row">
      <footer class="col d-flex justify-content-between mt-4 bg-light">
        <p>DevGurus</p>
        <p class="order-2">
          <a href="">
            <img src="../assets/icons/twitter-icon.svg" alt="Twitter" class="img-fluid">
          </a>
          <a href="">
            <img src="../assets/icons/instagram-icon.svg" alt="Instagram" class="img-fluid">
          </a>
          <a href="">
            <img src="../assets/icons/facebook-icon.svg" alt="Facebook" class="img-fluid">
          </a>
        </p>
      </footer>
    </div>



  </div>
</template>
  
<script>
export default {
  data() {
    return {
      //Se llama a la funcion para saber si ese usuario esta logeado
      isAuthenticated: this.autenticacion(),
      pedidos: [], // Un array para almacenar los productos
    };
  },
  mounted() {
    // Llama a la función para cargar productos cuando el componente se monta
    this.loadPedidos();
  },
  methods: {
    async loadPedidos() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/pedidos/' + localStorage.getItem('codigo'));
        const datos = await response.json();

        if (datos.success) {
          this.pedidos = datos.data;  // Asigna data.data a this.productos
        } else {
          console.error('Error al obtener productos:', data.message);
        }
      } catch (error) {
        console.error('Error en la solicitud para obtener productos:', error);
      }
    },
    logout() {
      console.log("Sesión cerrada");
      //Borra el local storage y redirige a inicio
      localStorage.removeItem('autenticado');
      localStorage.removeItem('codigo');
      this.$router.push({ name: "inicio" });
    },
    autenticacion() {
      return localStorage.getItem('autenticado');
    },
  },
};
</script>
  
<style scoped></style>
  