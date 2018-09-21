var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import StoryideasForm from './components/StoryIdeasForm.vue';
import StoryideasBoxTools from './components/StoryIdeasBoxTools.vue';
import store from './vuex/store';

var vm = new Vue({
    el: '#vue-storyidea',
    components: { StoryideasBoxTools, StoryideasForm },
    store,
    ready() {
      console.log('Story idea Form ready');
    }
});
