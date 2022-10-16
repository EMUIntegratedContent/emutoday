var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import ExpertList from './components/ExpertList.vue';
import ExpertBoxTools from './components/ExpertBoxTools.vue';

var vm = new Vue({
    el: '#vue-expert-list',
    components: {
        ExpertList,
        ExpertBoxTools
    }
});
