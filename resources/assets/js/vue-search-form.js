var Vue = require('vue');
import VueResource from 'vue-resource';
Vue.use(VueResource);

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import SearchForm from './components/SearchForm.vue'
new Vue({
    el: '#vue-search-form',
    components: {SearchForm},
    http: {
        headers: {
            // You could also store your token in a global object,
            // and reference it here. APP.token
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    }
});
