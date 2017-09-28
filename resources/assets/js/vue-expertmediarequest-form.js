var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// var moment = require('moment');
import ExpertMediaRequestForm from './components/ExpertMediaRequestForm.vue';

var vm = new Vue({
    el: '#vue-expertmediarequest-form',
    components: {ExpertMediaRequestForm},
    ready() {
      console.log('Expert Media Request Form ready');
    }
});
