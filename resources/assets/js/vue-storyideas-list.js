var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import StoryideasList from './components/StoryideasList.vue';
var vm = new Vue({
    el: '#vue-storyideas-list',
    components: {StoryideasList},
    ready() {
      console.log('Story ideas list ready');
    }
});
