<template>
    <!-- Barra de navegación -->
    <div class="row">
        <div class="col-12">
            <!-- NAVBAR ================================================== -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <router-link to="/" class="navbar-brand">
                        <img id="logo" src="../../assets/img/logo_empresa.png" class="img-thumbnai" alt="Patatas de
                        la marca killer">
                        Killer
                    </router-link>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div v-if="isAuthenticated" class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <router-link to="/product-management" class="nav-link">Gestión de Productos</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/listado-pedidos" class=" nav-link">Lista de Pedidos</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/perfil-usuario" class=" nav-link">Perfil de usuario</router-link>
                            </li>
                            <li class="nav-item ">
                                <router-link to="/contacto" class="nav-link">¿Quieres trabajar con nosotros?</router-link>
                            </li>
                            <li class="nav-item">
                                <button @click="logout" class="nav-link" type="button">Cerrar
                                    Sesión</button>
                            </li>
                        </ul>

                    </div>

                    <div v-else class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <ul class="navbar-nav">
                            <li class="nav-item ">
                                <router-link to="/login" class="nav-link">Iniciar sesión</router-link>
                            </li>
                            <li class="nav-item ">
                                <router-link to="/contacto" class="nav-link">¿Quieres trabajar con nosotros?</router-link>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>
    
<script>
export default {
    data() {
        return {
            //Se llama a la funcion para saber si ese usuario esta logeado
            isAuthenticated: this.autenticacion(),
        };
    },
    mounted() {

    },
    methods: {
        logout() {
            console.log("Sesión cerrada");
            //Borra la sesion storage y redirige a inicio
            sessionStorage.removeItem('autenticado');
            sessionStorage.removeItem('codigo');
            this.$router.push({ name: "login" });
        },
        autenticacion() {
            return sessionStorage.getItem('autenticado');
        },
    },
};
</script>
    
<style scoped>
/* Estilos específicos del componente, si es necesario */
#logo {
    width: 50px;
    height: 50px;
}
</style>
    