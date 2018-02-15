
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


// modal
 // import Vue from 'vue'
 // import App from './components/DocumentComponent'
 //
 // Vue.config.productionTip = false
 //
 // /* eslint-disable no-new */
 // new Vue({
 //   el: '#app',
 //   render: h => h(App)
 // })

 require('./bootstrap');

 window.Vue = require('vue');
//
// import Modal from './components/ModalComponent';
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
// Vue.component('Document', require('./components/DocumentComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });




 import LaravelValidator from 'vue-laravel-validator';
 import bModal from 'bootstrap-vue/es/components/modal/modal';
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
Vue.use(LaravelValidator);

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
//Vue.component('b-modal', bModal);
Vue.component('category', require('./components/CategoryComponent.vue'));

const app = new Vue({
    el: '#app'
});
