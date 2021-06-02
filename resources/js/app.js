require('./bootstrap');

window.Vue = require('vue').default;

import VueCookies from 'vue-cookies'
import Vuelidate from "vuelidate/src";
import VueMask from 'v-mask'
import router from './router.js'

Vue.use(VueCookies)
Vue.use(Vuelidate)
Vue.use(VueMask)

const app = new Vue({
    el: '#app',
    router
});
