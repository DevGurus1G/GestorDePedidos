<template>
  <!-- Barra de navegación -->
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

          <div v-else class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
              <li class="nav-item ">
                <router-link to="/login" class="nav-link">Iniciar sesión</router-link>
              </li>
            </ul>

          </div>
        </div>
      </nav>
    </div>
  </div>

  <!-- Carrousel -->
  <div id="carouselExampleIndicators" class="carousel slide bg-danger" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../assets/icons/facebook-icon.svg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../assets/icons/icono-enlace-roto.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../assets/icons/icono-enlace-roto.png" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>



  <!-- Sección de texto e imágenes -->
  <section class="container my-5">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Titulo. <span class="text-muted">Titulo Clarito.</span></h2>
        <p class="lead">.</p>
      </div>
      <div class="col-md-5">
        <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500"
          style="width: 500px; height: 500px;"
          src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22500%22%20height%3D%22500%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20500%20500%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18d451e84bc%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A25pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18d451e84bc%22%3E%3Crect%20width%3D%22500%22%20height%3D%22500%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22185.12109375%22%20y%3D%22261.1%22%3E500x500%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
          data-holder-rendered="true">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Titulo. <span class="text-muted">Titulo Clarito.</span></h2>
        <p class="lead">.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500"
          style="width: 500px; height: 500px;"
          src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22500%22%20height%3D%22500%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20500%20500%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18d451e84be%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A25pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18d451e84be%22%3E%3Crect%20width%3D%22500%22%20height%3D%22500%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22185.12109375%22%20y%3D%22261.1%22%3E500x500%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
          data-holder-rendered="true">
      </div>
    </div>

  </section>

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
</template>
  
<script>
export default {
  data() {
    return {
      //Se llama a la funcion para saber si ese usuario esta logeado
      isAuthenticated: this.autenticacion(),
      orders: [], // Un array para almacenar los pedidos
    };
  },
  mounted() {

  },
  methods: {
    logout() {
      console.log("Sesión cerrada");
      localStorage.removeItem('autenticado');
      // Redirige al login después de cerrar sesión
      this.$router.push({ name: "login" });
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
  