var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import moment from 'moment';
import StoryQueue from './components/StoryQueue.vue';

new Vue({
    el: '#vue-story-queue',
    components: {StoryQueue},
    ready() {
       console.log('Vue StoryQueue ready');
    }
});
