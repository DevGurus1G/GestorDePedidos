<template>
  <!-- Contenido principal -->
  <div class="row mt-4">
    <div class="col">
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
    autenticacion() {
      return localStorage.getItem('autenticado');
    },
  },
};
</script>
  
<style scoped>
/* Estilos específicos del componente, si es necesario */
</style>
