var Vue = require('vue');
import VueResource from 'vue-resource';
Vue.use(VueResource);
import SearchFormOffcanvas from './components/SearchFormOffcanvas.vue'
new Vue({
    el: '#vue-search-form-offcanvas',
    components: {SearchFormOffcanvas},
    http: {
        headers: {
            // You could also store your token in a global object,
            // and reference it here. APP.token
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    }
});
