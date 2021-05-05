require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('registration', require('./components/Registration.vue').default);
Vue.component('all-clients', require('./components/AllClients.vue').default);
Vue.component('edit-client', require('./components/EditClient.vue').default);
Vue.component('index', require('./components/Index.vue').default);

const app = new Vue({
    el: '#app',
});
