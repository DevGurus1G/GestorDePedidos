<template>
  <!-- Contenido principal -->
  <div class="row mt-4">
    <div class="col">
      <h1>¿Quieres trabajar con nosotros?</h1>
      <div v-if="contactoEnviado" class="alert alert-success" role="alert">
        ¡Se ha enviado correctamente la informacion!
      </div>

      <form @submit.prevent="nuevoCliente">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input v-model="cliente.nombre" @input="limpiarErrores('nombre')" type="text" class="form-control" id="nombre">
          <div v-if="errores.nombre" class="text-danger">{{ errores.nombre }}</div>
        </div>
        <div class="mb-3">
          <label for="dni" class="form-label">DNI</label>
          <input v-model="cliente.dni" @input="limpiarErrores('dni')" type="text" class="form-control" id="dni">
          <div v-if="errores.dni" class="text-danger">{{ errores.dni }}</div>
        </div>
        <div class="mb-3">
          <label for="calle" class="form-label">Calle</label>
          <input v-model="cliente.calle" @input="limpiarErrores('calle')" type="text" class="form-control" id="calle">
          <div v-if="errores.calle" class="text-danger">{{ errores.calle }}</div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input v-model="cliente.email" @input="limpiarErrores('email')" type="email" class="form-control" id="email">
          <div v-if="errores.email" class="text-danger">{{ errores.email }}</div>
        </div>

        <div v-if="errores.servidor" class="text-danger">{{ errores.servidor }}</div>
        <button type="submit" class="btn btn-primary">Contactar</button>
      </form>
    </div>
  </div>
</template>
  
<script>
export default {
  data() {
    return {
      cliente: {
        nombre: '',
        dni: '',
        calle: '',
        email: '',
      },
      contactoEnviado: false,
      errores: {
        nombre: '',
        dni: '',
        calle: '',
        email: '',
        servidor: '',
      },
    };
  },
  methods: {
    limpiarErrores(campo) {
      this.errores[campo] = '';
      this.errores.servidor = '';
      this.contactoEnviado = false;
    },

    validarNombre() {
      const nombreRegex = /^[A-Z][a-zA-Záéíóúüñ\s']*$/;
      if (!nombreRegex.test(this.cliente.nombre.trim())) {
        this.errores.nombre = 'Por favor, ingrese un nombre válido que comience con mayúscula o después de un espacio en blanco.';
        return false;
      }
      this.errores.nombre = '';
      return true;
    },

    validarDNI() {
      const dniRegex = /^\d{8}[A-Z]$/;
      if (!dniRegex.test(this.cliente.dni)) {
        this.errores.dni = 'Por favor, ingrese un DNI válido de 8 dígitos seguidos por una letra mayúscula.';
        return false;
      }
      this.errores.dni = '';
      return true;
    },

    validarCalle() {
      if (!this.cliente.calle.trim()) {
        this.errores.calle = 'Por favor, ingrese una calle válida.';
        return false;
      }
      this.errores.calle = '';
      return true;
    },

    validarEmail() {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(this.cliente.email)) {
        this.errores.email = 'Por favor, ingrese una dirección de correo electrónico válida.';
        return false;
      }
      this.errores.email = '';
      return true;
    },

    async nuevoCliente() {
      try {
        if (!this.validarNombre() || !this.validarDNI() || !this.validarCalle() || !this.validarEmail()) {
          return;
        }

        const response = await fetch('http://127.0.0.1:8000/api/cliente/registrar/', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            nombre: this.cliente.nombre,
            dni: this.cliente.dni,
            calle: this.cliente.calle,
            email: this.cliente.email,
          }),
        });

        const data = await response.json();

        if (data.success) {
          this.contactoEnviado = true;
          this.cliente.nombre = "";
          this.cliente.dni = "";
          this.cliente.calle = "";
          this.cliente.email = "";
        } else {
          this.errores.servidor = 'Error al crear el cliente: ' + data.message;
        }
      } catch (error) {
        this.errores.servidor = 'Error en la solicitud para crear el cliente.';
      }
    },
  },
};
</script>


  
<style scoped></style>
