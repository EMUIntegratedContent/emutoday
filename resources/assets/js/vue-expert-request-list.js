var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import ExpertRequestList from './components/ExpertList.vue';

var vm = new Vue({
    el: '#vue-expert-request-list',
    components: {
        ExpertRequestList,
    },
    ready() {
      console.log('Expert Request List ready');
    }
});
