var Vue = require('vue');

import VueResource from 'vue-resource';
import draggable from 'vuedraggable'
Vue.use(VueResource);
Vue.use(draggable)

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import MagazineBuilder from './components/Magazine/MagazineBuilder.vue';
import store from './vuex/store';

var vm = new Vue({
    el: '#vue-magazine-builder',
    components: {
        MagazineBuilder,
    },
    store,
    created() {
      console.log('Magazine builder ready');
    }
});
