var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import ExpertList from './components/ExpertList.vue';
import ExpertBoxTools from './components/ExpertBoxTools.vue';

var vm = new Vue({
    el: '#vue-expert-list',
    components: {
        ExpertList,
        ExpertBoxTools
    },
    ready() {
      console.log('Expert List ready');
    }
});
