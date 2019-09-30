require('./bootstrap');
window.Vue = require('vue');

import items from './components/Items.vue'
import navbar from './components/Navbar.vue'

  const app = new Vue({
      el: '#app',
      components: { items, navbar }
  });
