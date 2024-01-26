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
        const response = await fetch('ip_server/login/' + this.code, {
          method: 'GET',
          // headers: {
          //   'Content-Type': 'application/json',
          // },
          // body: JSON.stringify({ code: this.code }),
        });

        const data = await response.json();

        if (data.success) {
          console.log("Autenticación exitosa");
          localStorage.setItem('autenticado', true);
          this.$router.push({ name: "product-management" });
        } else {
          this.loginError = "Código incorrecto. Inténtalo de nuevo.";
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
  