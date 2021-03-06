/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;

import App from './components/App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import axios from 'axios';
import { routes } from './routes';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.use(VueAxios, axios);

const vuetify = new Vuetify();
import 'vuetify/dist/vuetify.min.css';

const router = new VueRouter({
    mode: 'history',
    routes: routes
});
 
const app = new Vue({
    router: router,
    vuetify,
    render: h => h(App),
}).$mount('#app');;