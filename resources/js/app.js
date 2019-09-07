
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./edit');

//importing vue router
window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform'

//importing Gate tod authenticate user
import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);

import Vue from 'vue';
import VueHtmlToPaper from 'vue-html-to-paper';
 
const options = {
  name: '_blank',
  specs: [
    'fullscreen=yes',
    'titlebar=yes',
    'scrollbars=yes'
  ],
  styles: [
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
    'https://unpkg.com/kidlat-css/css/kidlat.css'
  ]
}
 
Vue.use(VueHtmlToPaper, options);

import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.Toast = Toast;
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('pagination',require('laravel-vue-pagination'));
window.Fire = new Vue();  
import VueRouter from 'vue-router'
Vue.use(VueRouter)

let routes = [
    { path: '/dashboard', component:  require('./components/dashboard.vue').default },
    { path: '/users', component:  require('./components/users.vue').default },
    { path: '/Stock', component:  require('./components/Stock.vue').default },
    { path: '/addOrder', component:  require('./components/addorder.vue').default },
    { path: '/addStock', component:  require('./components/addStock.vue').default },
    { path: '/printInvoice', component:  require('./components/printInvoice.vue').default },
    { path: '/addPeople', component:  require('./components/addPeople.vue').default },
    { path: '/viewCustomer', component:  require('./components/viewCustomer.vue').default },
    { path: '/cashier', component:  require('./components/cashier.vue').default },
    { path: '/profile', component:  require('./components/profile.vue').default },
  ]

const router = new VueRouter({
    mode:'history',
    routes
})
window.Fire = new Vue();
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component(
  'passport-clients',
  require('./components/passport/Clients.vue').default
);

Vue.component(
  'passport-authorized-clients',
  require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
  'passport-personal-access-tokens',
  require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
  'not-found',
  require('./components/NotFound.vue').default
);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data:{
      search: ''
    },
    methods:{
      searchit(){
        console.log('searching.........');
        Fire.$emit('searching');
      }
    }
});
