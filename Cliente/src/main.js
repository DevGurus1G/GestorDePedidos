import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';



const app = createApp(App);

// Middleware para verificar la autenticación antes de acceder a rutas protegidas
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !isAuthenticated()) {
    // Redirigir al inicio de sesión si no está autenticado
    next({ name: 'login' });
  } else {
    next();
  }
});

// Función de ejemplo para verificar la autenticación
function isAuthenticated() {
  // Implementa la lógica de autenticación, en este caso el true de localstorage
  return localStorage.getItem('autenticado');
}

app.use(router).mount('#app');
