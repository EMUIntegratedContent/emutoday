var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);


import StoryForm from './components/StoryForm.vue'
import BoxTools from './components/BoxTools.vue'
import store from './vuex/store'


new Vue({
    el: '#vue-story-form-wrapper',
    ready() {
      console.log('vue-story-form');
    },
    http: {
         headers: {
             // You could also store your token in a global object,
             // and reference it here. APP.token
             'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
         }
    },
  store,
  components: {
      StoryForm: StoryForm,
      BoxTools: BoxTools
  },
});
