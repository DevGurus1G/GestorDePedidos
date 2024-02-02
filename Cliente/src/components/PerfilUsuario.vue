<template>
  <!-- Contenido principal -->
  <div class="row mt-4">
    <div class="col">
      <h1>Datos del usuario</h1>
      <div v-if="actualizado" class="alert alert-success" role="alert">
        ¡Actualización del cliente realizada correctamente!
      </div>
      <div v-if="cargando" class="alert alert-info">
        <p class="mb-0">Cargando datos de del usuario...</p>
      </div>
      <form v-else @submit.prevent="updateCliente">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input v-model="usuario.nombre" @input="limpiarErrores('nombre')" type="text" class="form-control" id="nombre">
          <div v-if="errores.nombre" class="text-danger">{{ errores.nombre }}</div>
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
      <div v-if="errores.servidor" class="text-danger">{{ errores.servidor }}</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isAuthenticated: this.autenticacion(),
      usuario: {},
      actualizado: false,
      errores: {
        nombre: '',
        servidor: '',
      },
      cargando: true, // Para el pequeño intervalo que cargan los datos
    };
  },
  mounted() {
    this.getCliente();
  },
  methods: {
    limpiarErrores(campo) {
      this.errores[campo] = '';
      this.errores.servidor = '';
      this.actualizado = false;
    },

    validarNombre() {
      const nombreRegex = /^[A-Z][a-zA-Záéíóúüñ\s']*$/;
      if (!nombreRegex.test(this.usuario.nombre.trim())) {
        this.errores.nombre = 'Por favor, ingrese un nombre válido que comience con mayúscula o después de un espacio en blanco.';
        return false;
      }
      this.errores.nombre = '';
      return true;
    },

    async getCliente() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/cliente/' + sessionStorage.getItem("codigo"));
        const data = await response.json();

        if (data.success) {
          this.usuario = data.cliente;
        } else {
          console.error('Error al obtener el usuario:', data.message);
          this.errores.servidor = 'Error al obtener el usuario: ' + data.message;
        }
      } catch (error) {
        console.error('Error en la solicitud para obtener el usuario:', error);
        this.errores.servidor = 'Error en la solicitud para obtener el usuario.';
      } finally {
        this.cargando = false; // Indicamos que la carga ha finalizado
      }
    },

    async updateCliente() {
      try {
        if (!this.validarNombre()) {
          return;
        }

        const response = await fetch('http://127.0.0.1:8000/api/cliente/update/' + sessionStorage.getItem("codigo"), {
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
          this.actualizado = true;
          setTimeout(() => {
            this.limpiarErrores();
          }, 2000);
        } else {
          this.errores.servidor = 'Error al actualizar el cliente: ' + data.message;
        }
      } catch (error) {
        this.errores.servidor = 'Error en la solicitud para actualizar el cliente.';
      }
    },
    autenticacion() {
      return sessionStorage.getItem('autenticado');
    },
  },
};
</script>

<style scoped>
/* Estilos específicos del componente, si es necesario */
</style>
