import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'inicio',
    component: () => import('../views/InicioView.vue'),
    meta: { showFooter: true, showNav: true }
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../views/LoginView.vue'),
    meta: { showFooter: false, showNav: false } // Para no ver el footer y el nav en el login
  },
  {
    path: '/product-management',
    name: 'product-management',
    component: () => import('../views/ProductManagementView.vue'),
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
    component: () => import('../views/PerfilUsuarioView.vue'),
    meta: { requiresAuth: true, showFooter: true, showNav: true }
  },
  {
    path: '/recuperar',
    name: 'recuperar',
    component: () => import('../views/RecuperarUsuarioView.vue'),
  },
  {
    path: '/contacto',
    name: 'contacto',
    component: () => import('../views/ContactoView.vue'),
    meta: { showFooter: true, showNav: true }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
