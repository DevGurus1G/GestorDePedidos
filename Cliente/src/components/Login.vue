<template>
  <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div>
      <h1 class="text-center">Login</h1>
      <form @submit.prevent="login" class="text-center">
        <input v-model="code" type="text" class="form-control" placeholder="Código de 8 dígitos" @input="clearError" />
        <button type="submit" class="btn btn-primary mt-3">Iniciar sesión</button>
      </form>
      <p v-if="loginError" class="text-danger mt-2">{{ loginError }}</p>
    </div>
  </div>
</template>
  
<script>
export default {
  data() {
    return {
      code: "",
      loginError: "",
    };
  },
  methods: {
    //LLAMADA AL SERVIDOR, FALTA PONERLE LA IP Y REALIZAR LAS PRUEBAS CONTRA LARAVEL
    async login() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/login/' + this.code);

        const data = await response.json();

        if (data.success) {
          console.log("Autenticación exitosa");
          sessionStorage.setItem('autenticado', true);
          sessionStorage.setItem('codigo', data.cliente.codigo_acceso);
          this.$router.push({ name: "inicio" });
        } else {
          this.loginError = data.message;
          console.error("Autenticación fallida");
        }
      } catch (error) {
        console.error("Error en la solicitud a la API:", error);
      }
    },
    clearError() {
      this.loginError = "";
    },
  },
};
</script>
  