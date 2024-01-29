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
                <li class="nav-item ">
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
      <h1>Datos del usuario</h1>
      <div v-if="actualizado" class="alert alert-success" role="alert">
        ¡Actualización del cliente realizada correctamente!
      </div>
      <form @submit.prevent="updateCliente" v-if="Object.keys(usuario).length > 0">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input v-model="usuario.nombre" type="text" class="form-control" id="nombre">
        </div>
        <div class="mb-3">
          <label for="codigo" class="form-label">Codigo</label>
          <input v-model="usuario.codigo_acceso" type="text" class="form-control" id="codigo" readonly>
          <div id="ayudaCodigo" class="form-text">Si desea cambiar su código de acceso, póngase en contacto con el
            administrador</div>
        </div>
        <div class="mb-3">
          <label for="dni" class="form-label">DNI</label>
          <input v-model="usuario.dni" type="text" class="form-control" id="dni" readonly>
          <div id="ayudaDni" class="form-text">Si desea cambiar su DNI, póngase en contacto con el administrador</div>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </form>
      <div v-else>
        <p>Ha habido algún error con su código, póngase en contacto con un administrador</p>
      </div>
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
      // Se llama a la función para saber si ese usuario está logeado
      isAuthenticated: this.autenticacion(),
      usuario: {},
      actualizado: false,
    };
  },
  mounted() {
    this.getCliente();
  },
  methods: {
    async getCliente() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/cliente/' + localStorage.getItem("codigo"));
        const data = await response.json();

        if (data.success) {
          // Actualiza el objeto usuario con los datos del servidor
          this.usuario = data.cliente;
        } else {
          console.error('Error al obtener el usuario:', data.message);
        }
      } catch (error) {
        console.error('Error en la solicitud para obtener el usuario:', error);
      }
    },

    async updateCliente() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/cliente/update/' + localStorage.getItem("codigo"), {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            nombre: this.usuario.nombre,
          }),
        });

        const data = await response.json();

        if (data.success) {
          console.log("Cliente actualizado con éxito");
          this.actualizado = true;
          this.$router.push({ name: 'perfil-usuario' })
        } else {
          console.error('Error al actualizar el cliente:', data.message);
        }
      } catch (error) {
        console.error('Error en la solicitud para actualizar el cliente:', error);
      }
    },

    logout() {
      console.log("Sesión cerrada");
      // Borra el local storage y redirige a inicio
      localStorage.removeItem('autenticado');
      localStorage.removeItem('cliente');
      this.$router.push({ name: "inicio" });
    },
    autenticacion() {
      return localStorage.getItem('autenticado');
    },
  },
};
</script>
  
<style scoped>
/* Estilos específicos del componente, si es necesario */
</style>
