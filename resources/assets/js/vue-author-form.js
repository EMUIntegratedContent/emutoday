var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import AuthorForm from './components/AuthorForm.vue';

var vm = new Vue({
    el: '#vue-authors',
    components: {AuthorForm},
    ready() {
      console.log('AuthorForm ready');
    }
});
