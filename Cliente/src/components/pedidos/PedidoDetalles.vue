<template>
  <button
    class="btn btn-link"
    type="button"
    data-bs-toggle="collapse"
    :data-bs-target="'#detallesCollapse' + pedido.id_pedido"
    aria-expanded="false"
    aria-controls="detallesCollapse"
  >
    Ver los productos del pedido
  </button>
  <div class="collapse" :id="'detallesCollapse' + pedido.id_pedido">
    <table class="table table-bordered text-center table-striped">
      <thead class="table-dark">
        <tr>
          <th scope="col">Formato</th>
          <th scope="col">Producto</th>
          <th scope="col">Categoría</th>
          <th scope="col">Precio</th>
          <th scope="col">Cantidad</th>
        </tr>
      </thead>
      <tbody>
        <!-- Aquí deberías iterar sobre los detalles del pedido -->
        <tr v-for="detalle in pedido.detalles" :key="detalle.formato_producto_id">
          <td>{{ detalle.formato || 'N/A' }}</td>
          <td>{{ detalle.producto?.nombre || 'N/A' }}</td>
          <td>{{ detalle.producto?.categoria || 'N/A' }}</td>
          <td>{{ detalle.precio || 'N/A' }}€</td>
          <td>{{ detalle.cantidad || 'N/A' }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps(['pedido'])
</script>
