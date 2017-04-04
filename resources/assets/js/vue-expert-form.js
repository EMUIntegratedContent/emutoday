var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// var moment = require('moment');
import ExpertForm from './components/ExpertForm.vue';

var vm = new Vue({
    el: '#vue-experts',
    components: {ExpertForm},

    ready() {
      console.log('Expert Form ready');
    }
});
