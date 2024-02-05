<template>
  <div class="d-flex align-items-center justify-content-center row" style="height: 100vh">
    <div class="col-md-6"> <!-- Ajusta la anchura de la columna según tus necesidades -->
      <h1 class="text-center mb-4">Bienvenido a Killer</h1>
      <form @submit.prevent="login" class="text-center">
        <div class="mb-3">
          <input v-model="code" type="text" class="form-control" placeholder="Código de 8 dígitos" @input="clearError" />
        </div>
        <div>
          <router-link to="/recuperar" class="link">¿Has olvidado tu código?</router-link>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Iniciar sesión</button>
      </form>
      <p v-if="loginError" class="text-danger mt-2">{{ loginError }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router' // Asegúrate de importar 'useRouter' desde 'vue-router'
const code = ref('')
const loginError = ref('')
const router = useRouter() // Asegúrate de inicializar el router

const login = async () => {
  try {
    const response = await fetch(`http://127.0.0.1:8000/api/login/${code.value}`)
    const data = await response.json()

    if (data.success) {
      console.log('Autenticación exitosa')
      sessionStorage.setItem('autenticado', true)
      sessionStorage.setItem('codigo', data.cliente.codigo_acceso)
      router.push({ name: 'inicio' })
    } else {
      loginError.value = data.message
      console.error('Autenticación fallida')
    }
  } catch (error) {
    console.error('Error en la solicitud a la API:', error)
  }
}

const clearError = () => {
  loginError.value = ''
}
</script>
