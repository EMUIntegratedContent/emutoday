var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// var moment = require('moment');
import AuthorForm from './components/AuthorForm.vue';

var vm = new Vue({
    el: '#vue-authors',
    components: {AuthorForm},
    // http: {
    //     headers: {
    //         // You could also store your token in a global object,
    //         // and reference it here. APP.token
    //         'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
    //     }
    // },
    ready() {
      console.log('AuthorForm ready');
    }
});
