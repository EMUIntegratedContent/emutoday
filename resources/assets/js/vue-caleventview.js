var Vue = require('vue');

var VueResource = require('vue-resource');
Vue.use(VueResource);

var VueRouter = require('vue-router');
Vue.use(VueRouter);

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import EventView from './components/EventView.vue';

new Vue({
    el: '#vue-caleventview',

    components: {EventView},

    ready() {
      // alert('vue ready');
    }
});
