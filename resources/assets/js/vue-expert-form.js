var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// var moment = require('moment');
import ExpertForm from './components/ExpertForm.vue';
import store from './vuex/store'

var vm = new Vue({
    el: '#vue-experts',
    components: {ExpertForm},
    store,
    ready() {
      console.log('Expert Form ready');
    }
});
