var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// var moment = require('moment');
import ExpertSpeakerRequestForm from './components/ExpertSpeakerRequestForm.vue';

var vm = new Vue({
    el: '#vue-expertspeakerrequest-form',
    components: {ExpertSpeakerRequestForm},
    ready() {
      console.log('Expert Speaker Request Form ready');
    }
});
