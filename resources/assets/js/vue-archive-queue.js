var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;


import ArchiveQueue from './components/ArchiveQueue.vue'

new Vue({
    el: '#vue-archive-queue',
    components: {ArchiveQueue},
    ready() {
      console.log('new Vue Archive Queue ready');
    }
});
