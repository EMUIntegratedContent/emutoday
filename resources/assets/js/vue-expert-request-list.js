var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import ExpertMediaRequestList from './components/ExpertRequestList.vue';

var vm = new Vue({
    el: '#vue-expert-request-list',
    components: {
        ExpertMediaRequestList,
    },
    ready() {
      console.log('Expert Request List ready');
    }
});
