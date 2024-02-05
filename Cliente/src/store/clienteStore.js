// clienteStore.js
import { defineStore } from 'pinia';

export const useClienteStore = defineStore('cliente', {
  state: () => ({
    cliente: {
      nombre: '',
      codigo_acceso: '',
      dni: '',
      calle: '',
    },
  }),
  actions: {
    setCliente(cliente) {
      this.cliente = cliente;
    },
    getCliente() {
      return this.cliente;
    },
  },
});
