<template>
  <div v-if="pedidosFiltrados.length > 0" class="table-responsive">
    <table class="table table-hover table-bordered table-striped text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th scope="col">Fecha</th>
          <th scope="col">Estado</th>
          <th scope="col">Productos del pedido</th>
          <th scope="col">Precio Total</th>
        </tr>
      </thead>
      <tbody>
        <!-- Utiliza el componente PedidoRow en lugar de la directiva v-for -->
        <PedidoRow v-for="pedido in pedidosFiltrados" :key="pedido.id_pedido" :pedido="pedido" />
      </tbody>
    </table>
  </div>
  <div v-else class="alert alert-warning">
    <p class="mb-0">Este cliente no ha realizado ningún pedido aún.</p>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import PedidoRow from './PedidoRow.vue' // Asegúrate de importar el componente PedidoRow

const props = defineProps(['pedidosFiltrados'])
</script>
