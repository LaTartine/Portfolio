import Vue from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files
import './styles/custom-bootstrap.scss'

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

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
