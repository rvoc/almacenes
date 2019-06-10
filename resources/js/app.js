/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VeeValidate from "vee-validate";
import Multiselect from 'vue-multiselect';

// import VueMaterial from 'vue-material'
// import 'vue-material/dist/vue-material.min.css'
// import { MdSwicth } from 'vue-material/dist/components';
// import 'vue-material/dist/components/MdSwitch/index.css';//realizar modulo de compatibilidad a futuro es una muy buena herramienta
// import 'vue-material/dist/components/MdSwitch/theme.scss';

window.Vue = require('vue');
window.spanish_lang = require('./datatable_spanish');
window.Swal = require('sweetalert2');
window.moment = require('moment');
window.numeral = require('numeral');
window.toastr = require('toastr');
window.moment.locale('es');


window.Chart = require('chart.js');

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
// Vue.use(MdSwicth) //adicionando por modulos
Vue.use(VeeValidate, {
    classes: true,
    classNames: {
        valid: "is-valid",
        invalid: "is-invalid"
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('multiselect', Multiselect)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('provider-component', require('./components/ProviderEdit.vue').default);
Vue.component('unit-component', require('./components/UnitEdit.vue').default);
Vue.component('category-component', require('./components/CategoryEdit.vue').default);
Vue.component('budge-item-component', require('./components/BudgeItemEdit.vue').default);
Vue.component('storage-component', require('./components/StorageEdit.vue').default);
Vue.component('article-component', require('./components/ArticleEdit.vue').default);
Vue.component('income-component', require('./components/IncomeCreate.vue').default);
Vue.component('request-component', require('./components/RequestCreate.vue').default);
Vue.component('check-component', require('./components/RequestCheck.vue').default);
Vue.component('check-request-store', require('./components/RequestStoreCheck.vue').default);
Vue.component('transfer-component', require('./components/RequestTransfer.vue').default);
Vue.component('change-storage', require('./components/ChangeStorage.vue').default);

Vue.component('users-index', require('./components/UsersIndex.vue').default);
Vue.component('role-edit', require('./components/RoleEdit.vue').default);
Vue.component('user-edit', require('./components/UserEdit.vue').default);
Vue.component('report-inout', require('./components/ReportInOut.vue').default);
Vue.component('report-out', require('./components/ReportOut.vue').default);
Vue.component('approve-request', require('./components/RequestApprove.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    mounted(){
        //loading config default
        $('[data-toggle="tooltip"]').tooltip();
        // var elem =document.querySelector('.js-switch');
        // var init = new Switchery(elem,  { color: '#41b7f1',size: 'larger' });
    }

});
