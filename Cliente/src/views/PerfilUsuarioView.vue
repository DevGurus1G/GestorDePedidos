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
          <input v-model="usuario.nombre" @input="limpiarErrores('nombre')" type="text" class="form-control"
            id="nombre" />
          <div v-if="errores.nombre" class="text-danger">{{ errores.nombre }}</div>
        </div>
        <div class="mb-3">
          <label for="calle" class="form-label">Calle</label>
          <input v-model="usuario.calle" @input="limpiarErrores('calle')" type="text" class="form-control" id="calle" />
          <div v-if="errores.calle" class="text-danger">{{ errores.calle }}</div>
        </div>
        <div class="mb-3">
          <label for="codigo" class="form-label">Codigo</label>
          <input v-model="usuario.codigo_acceso" type="text" class="form-control" id="codigo" readonly disabled />
          <div id="ayudaCodigo" class="form-text">
            Si desea cambiar su código de acceso, póngase en contacto con el administrador
          </div>
        </div>
        <div class="mb-3">
          <label for="dni" class="form-label">DNI</label>
          <input v-model="usuario.dni" type="text" class="form-control" id="dni" readonly disabled />
          <div id="ayudaDni" class="form-text">
            Si desea cambiar su DNI, póngase en contacto con el administrador
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </form>
      <div v-if="errores.servidor" class="text-danger">{{ errores.servidor }}</div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useClienteStore } from '@/store/clienteStore';

const clienteStore = useClienteStore(); // Asegúrate de inicializar la tienda
const isAuthenticated = () => sessionStorage.getItem('autenticado')
const usuario = ref({})
const actualizado = ref(false)
const errores = ref({
  nombre: '',
  calle: '',
  servidor: ''
})
const cargando = ref(true)

onMounted(() => {
  const cliente = clienteStore.getCliente();
  if (cliente.nombre !== "") {
    usuario.value = cliente;
    cargando.value = false;
  } else {
    //Cuando no lo encuentra en pinia hace una peticion al servidor
    (async () => {
      try {
        const response = await fetch(
          `http://killercervezas.blog/api/cliente/${sessionStorage.getItem('codigo')}`
        );
        const data = await response.json();

        if (data.success) {
          usuario.value = data.cliente;
        } else {
          console.error('Error al obtener el usuario:', data.message);
          errores.value.servidor = 'Error al obtener el usuario: ' + data.message;
        }
      } catch (error) {
        console.error('Error en la solicitud para obtener el usuario:', error);
        errores.value.servidor = 'Error en la solicitud para obtener el usuario.';
      } finally {
        cargando.value = false; // Indicamos que la carga ha finalizado
      }
    })();  // Añade paréntesis de ejecución aquí
  }
});

const limpiarErrores = (campo) => {
  errores.value[campo] = ''
  errores.value.servidor = ''
  actualizado.value = false
}

const validarNombre = () => {
  const nombreRegex = /^[A-Z][a-zA-Záéíóúüñ\s']*$/
  if (!nombreRegex.test(usuario.value.nombre.trim())) {
    errores.value.nombre =
      'Por favor, ingrese un nombre válido que comience con mayúscula o después de un espacio en blanco.'
    return false
  }
  errores.value.nombre = ''
  return true
}

const validarCalle = () => {
  if (usuario.value.calle.trim() !== '') {
    errores.value.calle = 'La calle no puede estar vacia';
    return false;
  }
  errores.value.calle = '';
  return true;
};

const updateCliente = async () => {
  try {
    if (!validarNombre() || !validarCalle()) {
      return;
    }

    const response = await fetch(
      `http://killercervezas.blog/api/cliente/update/${sessionStorage.getItem('codigo')}`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          nombre: usuario.value.nombre
        })
      }
    )

    const data = await response.json()

    if (data.success) {
      actualizado.value = true
      setTimeout(() => {
        limpiarErrores()
      }, 2000)
    } else {
      errores.value.servidor = 'Error al actualizar el cliente: ' + data.message
    }
  } catch (error) {
    errores.value.servidor = 'Error en la solicitud para actualizar el cliente.'
  }
}

const autenticacion = isAuthenticated
</script>


<style scoped>
/* Estilos específicos del componente, si es necesario */
</style>
