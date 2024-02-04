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
          <input
            v-model="cliente.nombre"
            @input="limpiarErrores('nombre')"
            type="text"
            class="form-control"
            id="nombre"
          />
          <div v-if="errores.nombre" class="text-danger">{{ errores.nombre }}</div>
        </div>
        <div class="mb-3">
          <label for="dni" class="form-label">DNI</label>
          <input
            v-model="cliente.dni"
            @input="limpiarErrores('dni')"
            type="text"
            class="form-control"
            id="dni"
          />
          <div v-if="errores.dni" class="text-danger">{{ errores.dni }}</div>
        </div>
        <div class="mb-3">
          <label for="calle" class="form-label">Calle</label>
          <input
            v-model="cliente.calle"
            @input="limpiarErrores('calle')"
            type="text"
            class="form-control"
            id="calle"
          />
          <div v-if="errores.calle" class="text-danger">{{ errores.calle }}</div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            v-model="cliente.email"
            @input="limpiarErrores('email')"
            type="email"
            class="form-control"
            id="email"
          />
          <div v-if="errores.email" class="text-danger">{{ errores.email }}</div>
        </div>

        <div v-if="errores.servidor" class="text-danger">{{ errores.servidor }}</div>
        <button type="submit" class="btn btn-primary">Contactar</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const cliente = ref({
  nombre: '',
  dni: '',
  calle: '',
  email: ''
})

const contactoEnviado = ref(false)

const errores = ref({
  nombre: '',
  dni: '',
  calle: '',
  email: '',
  servidor: ''
})

const limpiarErrores = (campo) => {
  errores.value[campo] = ''
  errores.value.servidor = ''
  contactoEnviado.value = false
}

const validarNombre = () => {
  const nombreRegex = /^[A-Z][a-zA-Záéíóúüñ\s']*$/
  if (!nombreRegex.test(cliente.value.nombre.trim())) {
    errores.value.nombre =
      'Por favor, ingrese un nombre válido que comience con mayúscula o después de un espacio en blanco.'
    return false
  }
  errores.value.nombre = ''
  return true
}

const validarDNI = () => {
  const dniRegex = /^\d{8}[A-Z]$/
  if (!dniRegex.test(cliente.value.dni)) {
    errores.value.dni =
      'Por favor, ingrese un DNI válido de 8 dígitos seguidos por una letra mayúscula.'
    return false
  }
  errores.value.dni = ''
  return true
}

const validarCalle = () => {
  if (!cliente.value.calle.trim()) {
    errores.value.calle = 'Por favor, ingrese una calle válida.'
    return false
  }
  errores.value.calle = ''
  return true
}

const validarEmail = () => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!emailRegex.test(cliente.value.email)) {
    errores.value.email = 'Por favor, ingrese una dirección de correo electrónico válida.'
    return false
  }
  errores.value.email = ''
  return true
}

const nuevoCliente = async () => {
  try {
    if (!validarNombre() || !validarDNI() || !validarCalle() || !validarEmail()) {
      return
    }

    const response = await fetch('http://127.0.0.1:8000/api/cliente/registrar/', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        nombre: cliente.value.nombre,
        dni: cliente.value.dni,
        calle: cliente.value.calle,
        email: cliente.value.email
      })
    })

    const data = await response.json()

    if (data.success) {
      contactoEnviado.value = true
      cliente.value.nombre = ''
      cliente.value.dni = ''
      cliente.value.calle = ''
      cliente.value.email = ''
      errores.value.servidor = ''
    } else {
      errores.value.servidor = 'Error al crear el cliente: ' + data.message
    }
  } catch (error) {
    errores.value.servidor = 'Error en la solicitud para crear el cliente.'
  }
}
</script>
