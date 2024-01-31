<template>
  <div id="app" class="container-fluid">
    <Nav v-if="$route.meta.showNav"></Nav>
    <router-view />
    <Footer v-if="$route.meta.showFooter"></Footer>

  </div>
</template>

<script>
import Footer from './components/common/Footer.vue';

import Nav from './components/common/Nav.vue';

export default {
  components: {
    'Footer': Footer,
    'Nav': Nav
  },
  name: "App"
};
</script>
