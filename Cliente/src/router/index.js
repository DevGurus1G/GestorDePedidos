import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/components/Login.vue'
import ProductManagement from '@/components/ProductManagement.vue'
import ListadoPedidos from '@/components/ListadoPedidos.vue'
import PerfilUsuario from '@/components/PerfilUsuario.vue'
import Inicio from '@/components/Inicio.vue'
import RecuperarUsuario from '@/components/RecuperarUsuario.vue'
import Contacto from '@/components/Contacto.vue'

const routes = [
  {
    path: '/',
    name: 'inicio',
    component: Inicio,
    meta: { showFooter: true, showNav: true }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: { showFooter: false, showNav: false } // Para no ver el footer y el nav en el login
  },
  {
    path: '/product-management',
    name: 'product-management',
    component: ProductManagement,
    meta: { requiresAuth: true, showFooter: true, showNav: true } // Asegura que solo usuarios autenticados pueden acceder y que se vea el footer y el nav
  },
  {
    path: '/listado-pedidos',
    name: 'listado-pedidos',
    component: () => import('../views/PedidosView.vue'),
    meta: { requiresAuth: true, showFooter: true, showNav: true }
  },
  {
    path: '/perfil-usuario',
    name: 'perfil-usuario',
    component: PerfilUsuario,
    meta: { requiresAuth: true, showFooter: true, showNav: true }
  },
  {
    path: '/recuperar',
    name: 'recuperar',
    component: RecuperarUsuario
  },
  {
    path: '/contacto',
    name: 'contacto',
    component: Contacto,
    meta: { showFooter: true, showNav: true }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
