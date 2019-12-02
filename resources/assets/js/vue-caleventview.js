var Vue = require('vue');
window.Vue = Vue

Vue.use(require('vue-resource'))
Vue.use(require('vue-router'))

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import EventView from './components/EventView.vue';

new Vue({
    el: '#vue-caleventview',
    components: {EventView},
});
