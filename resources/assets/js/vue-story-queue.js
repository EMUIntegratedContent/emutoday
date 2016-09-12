var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import moment from 'moment';
import StoryQueue from './components/StoryQueue.vue';

new Vue({
    el: '#vue-story-queue',
    components: {StoryQueue},
        http: {
                headers: {
                        // You could also store your token in a global object,
                        // and reference it here. APP.token
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
        },
    ready() {
      console.log('new Vue StoryQueue ready');
    }
});
