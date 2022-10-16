var Vue = require('vue');

import VueResource from 'vue-resource';
import Sortable from 'vue-sortable';
Vue.use(VueResource);
Vue.use(Sortable)

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import EmailForm from './components/Email/EmailForm.vue';
import store from './vuex/store';

var vm = new Vue({
    el: '#vue-emails',
    components: {
        EmailForm,
    },
    store
});
