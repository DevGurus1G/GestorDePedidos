import { createRouter, createWebHistory } from 'vue-router';
import Login from '@/components/Login.vue';
import ProductManagement from '@/components/ProductManagement.vue';
import ListadoPedidos from '@/components/ListadoPedidos.vue';
import PerfilUsuario from '@/components/PerfilUsuario.vue';
import Inicio from '@/components/Inicio.vue';


const routes = [
  {
    path: '/',
    name: 'inicio',
    component: Inicio,
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
  },
  {
    path: '/product-management',
    name: 'product-management',
    component: ProductManagement,
    meta: { requiresAuth: true }, // Asegura que solo usuarios autenticados pueden acceder
  },
  {
    path: '/listado-pedidos',
    name: 'listado-pedidos',
    component: ListadoPedidos,
   meta: { requiresAuth: true }, // Asegura que solo usuarios autenticados pueden acceder
  },
  {
    path: '/perfil-usuario',
    name: 'perfil-usuario',
    component: PerfilUsuario,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
