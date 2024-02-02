<template>
  <!-- Carrousel -->
  <div class="row">
    <div id="carouselInicio" class="carousel slide col-xxl-8 m-auto" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselInicio" data-bs-slide-to="0" class="active" aria-current="true"
          aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselInicio" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselInicio" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselInicio" data-bs-slide-to="3" aria-label="Slide 4"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../assets/img/foto_carousel_1.jfif" class="d-block w-100 object-fit-cover" alt="Botellas killer">
        </div>
        <div class="carousel-item">
          <img src="../assets/img/foto_carousel_2.jfif" class=" d-block w-100 object-fit-cover"
            alt="Barril de la marca killer">
        </div>
        <div class="carousel-item">
          <img src="../assets/img/foto_carousel_3.jfif" class="d-block w-100 object-fit-cover"
            alt="Agua de la marca killer">
        </div>
        <div class="carousel-item">
          <img src="../assets/img/foto_carousel_4.jfif" class="d-block w-100 object-fit-cover"
            alt="Patatas de la marca killer">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselInicio" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselInicio" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>




  <!-- Sección de texto e imágenes -->
  <section class="container my-5">
    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Plataforma Innovadora para la Gestión de Pedidos de Hosteleria</h2>
        <h3 class="text-muted">Transformando la Experiencia Gastronómica con Tecnología Avanzada</h3>
        <p class="lead">En el corazón de la revolución digital en el sector de la hostelería, nuestra empresa se destaca
          como líder en el desarrollo de soluciones innovadoras para la gestión eficiente de pedidos en bares. Con un
          enfoque centrado en la experiencia del cliente y la optimización de los procesos comerciales, estamos marcando
          la pauta para la próxima generación de servicios de pedidos en el mundo gastronómico. Descubre cómo nuestra
          plataforma está cambiando la forma en que los bares gestionan sus operaciones y mejoran la satisfacción de sus
          clientes.</p>
      </div>
      <div class="col-md-5">
        <img class="featurette-image img-fluid mx-auto" alt="Imagen bar con gente" style="width: 500px; height: 500px;"
          src="../assets/img/foto_inicio_1.jfif" data-holder-rendered="true">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Potenciando la Eficiencia Operativa</h2>
        <h3 class="text-muted">Conectando Bares con Tecnología de Vanguardia</h3>
        <p class="lead">Sumérgete en el futuro de la gestión de pedidos en el mundo de la hostelería con nuestra
          plataforma especializada. Desde la toma de pedidos hasta la entrega eficiente, ofrecemos soluciones integrales
          que aumentan la eficiencia operativa de los bares. Descubre cómo nuestra tecnología está transformando la manera
          en que los establecimientos gestionan sus pedidos, optimizan inventarios y mejoran la satisfacción del cliente.
          Únete a nosotros en la vanguardia de la innovación gastronómica.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <img class="featurette-image img-fluid mx-auto" alt="Imagen de la cadena de gestión"
          style="width: 500px; height: 500px;" src="../assets/img/foto_inicio_2.jfif" data-holder-rendered="true">
      </div>
    </div>

  </section>
</template>
  
<script>
export default {
  data() {
    return {
      //Se llama a la funcion para saber si ese usuario esta logeado
      isAuthenticated: this.autenticacion(),
    };
  },
  mounted() {

  },
  methods: {
    autenticacion() {
      return sessionStorage.getItem('autenticado');
    },
  },
};
</script>
  
<style scoped></style>
  