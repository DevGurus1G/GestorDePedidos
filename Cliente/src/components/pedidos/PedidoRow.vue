<template>
  <tr>
    <td>{{ pedido.fecha }}</td>
    <td>{{ pedido.estado }}</td>
    <td>
      <PedidoDetalles :pedido="pedido" />
    </td>
    <td>{{ calcularPrecioTotal(pedido) }}€</td>
  </tr>
</template>

<script setup>
import { defineProps } from 'vue'
import PedidoDetalles from './PedidoDetalles.vue'

const props = defineProps(['pedido'])

const calcularPrecioTotal = (pedido) => {
  let total = 0
  pedido.detalles.forEach((detalle) => {
    total += detalle.precio * detalle.cantidad
  })
  return parseFloat(total.toFixed(2))
}
</script>
