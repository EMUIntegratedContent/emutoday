var Vue = require('vue');

var VueResource = require('vue-resource');
Vue.use(VueResource);


import EventView from './components/EventView.vue';

new Vue({
    el: '#vue-caleventview',

    components: {EventView},

    ready() {
      // alert('vue ready');
    }
});
