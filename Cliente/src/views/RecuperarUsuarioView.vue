<template>
  <main class="min-vh-100 d-flex flex-column justify-content-center align-items-center">
    <h1>Recuperar usuario</h1>
    <p class="info-recu">
      Para que nosotros podamos recuperar su clave de acceso nos tendra que rellenar estos datos, el
      DNI con el que se le registro y un correo para, en caso de que exista, se le envia la clave de
      acceso.
    </p>
    <div v-if="enviado" class="alert alert-success">Consulte su bandeja de entrada o spam</div>
    <div v-if="error" class="alert alert-danger">{{ error }}</div>
    <form class="row" @submit.prevent="enviarCorreo">
      <div class="col-12 my-2">
        <div class="form-floating">
          <input type="text" name="dni" id="dni" class="form-control" placeholder="email" v-model="dni" />
          <label for="dni" class="">DNI</label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-floating">
          <input type="text" name="email" id="email" class="form-control" placeholder="email" v-model="email" />
          <label for="email" class="">Correo electronico</label>
        </div>
      </div>
      <div class="col-12 mt-2">
        <button class="btn btn-primary w-100">Enviar</button>
      </div>
    </form>
  </main>
</template>

<script setup>
import { ref } from 'vue'

const dni = ref('')
const email = ref('')
const enviado = ref(false)
const error = ref(null)

async function enviarCorreo() {
  const datos = {
    dni: dni.value,
    email: email.value
    // Otros datos relacionados con el pedido que puedas necesitar enviar
  }
  console.log(JSON.stringify(datos))
  try {
    const response = await fetch('http://127.0.0.1:8000/api/recuperar', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(datos)
    })

    const data = await response.json()
    enviado.value = data.enviado

    if (!enviado.value) {
      error.value = data.error || 'Error al enviar el correo electrónico'
    }

    console.log('Enviado:', enviado.value)
  } catch (error) {
    console.error('Error al enviar correo:', error)
    error.value = 'Error al enviar el correo electrónico'
  }
}
</script>

<style scoped>
/* Estilos específicos del componente, si es necesario */
.info-recu {
  max-width: 400px;
  text-align: center;
}
</style>
