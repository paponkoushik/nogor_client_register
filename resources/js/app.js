require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('registration', require('./components/Registration.vue').default);

const app = new Vue({
    el: '#app',
});
