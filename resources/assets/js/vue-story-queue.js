var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import moment from 'moment';
import StoryQueue from './components/StoryQueue.vue';

new Vue({
    el: '#vue-story-queue',
    components: {StoryQueue},
    ready() {
       console.log('Vue StoryQueue ready');
    }
});
