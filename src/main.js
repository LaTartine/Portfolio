import Vue from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files
import './styles/custom-bootstrap.scss'

//Import media queries vue
import VueMq from 'vue-mq'

Vue.use(VueMq)

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

//Parallax Scroll
import VueRellax from 'vue-rellax'
Vue.use(VueRellax)

//Parallax Souris
import VueParallaxView from "vue-parallax-view"
Vue.use(VueParallaxView);
import "vue-parallax-view/dist/vue-parallax-view.css";

// typical GSAP
import gsap from "gsap";
import CustomEase from "gsap/dist/CustomEase";
gsap.registerPlugin(CustomEase);
Vue.use(gsap);

//axios
import axios from 'axios'
import VueAxios from 'vue-axios'

//ajout axios vue
Vue.use(VueAxios, axios)

/*Fontawesome*/
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'

Vue.config.productionTip = false

new Vue({
  router,
  store,
  breakpoints: {
    sm: 450,
    md: 1250,
    lg: Infinity,
  },
  render: h => h(App)
}).$mount('#app')
