<!-- PedidoView.vue -->
<template>
  <div class="row mt-4">
    <div class="col">
      <h1 class="mb-4">Lista de Pedidos</h1>

      <!-- Mensaje mientras cargan los datos -->
      <div v-if="cargando" class="alert alert-info">
        <p class="mb-0">Cargando datos de pedidos...</p>
      </div>

      <!-- Componente PedidoTable -->
      <PedidoTable :pedidosFiltrados="pedidosFiltrados" />
    </div>
  </div>
</template>

<!-- PedidosView.vue -->

<script setup>
import { ref, onMounted } from 'vue'
import PedidoTable from '../components/pedidos/PedidoTable.vue'

const autenticacion = () => {
  return sessionStorage.getItem('autenticado')
}

const pedidos = ref([])
const pedidosFiltrados = ref([])
const cargando = ref(true)
const busqueda = ref('')

const calcularPrecioTotal = (pedido) => {
  let total = 0
  pedido.detalles.forEach((detalle) => {
    total += detalle.precio * detalle.cantidad
  })
  return parseFloat(total.toFixed(2))
}

onMounted(() => {
  loadPedidos()
})

const loadPedidos = async () => {
  try {
    const response = await fetch(
      `http://127.0.0.1:8000/api/pedidos/${sessionStorage.getItem('codigo')}`
    )
    const datos = await response.json()

    if (datos.success) {
      pedidos.value = datos.data.map((pedido) => {
        pedido.precioTotal = calcularPrecioTotal(pedido)
        return pedido
      })
      filtrarPedidos() // Filtrar pedidos al cargarlos
    } else {
      console.error('Error al obtener pedidos:', datos.message)
    }
  } catch (error) {
    console.error('Error en la solicitud para obtener pedidos:', error)
  } finally {
    cargando.value = false // Indicamos que la carga ha finalizado
  }
}

const filtrarPedidos = () => {
  const busquedaMinusculas = busqueda.value.toLowerCase().trim()

  pedidosFiltrados.value = pedidos.value.filter((pedido) => {
    return (
      pedido.id_pedido.toString().includes(busquedaMinusculas) ||
      pedido.fecha.includes(busquedaMinusculas) ||
      pedido.estado.toLowerCase().includes(busquedaMinusculas) ||
      productosEnPedido(pedido).toLowerCase().includes(busquedaMinusculas) ||
      pedido.precioTotal.toString().includes(busquedaMinusculas)
    )
  })
}

const productosEnPedido = (pedido) => {
  return pedido.detalles
    .map(
      (detalle) =>
        `${detalle.formato || 'N/A'} - ${detalle.producto?.categoria || 'N/A'} - ${detalle.producto?.nombre || 'N/A'} (${detalle.cantidad} unidades)`
    )
    .join(', ')
}
</script>

<style scoped>
.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}
</style>
