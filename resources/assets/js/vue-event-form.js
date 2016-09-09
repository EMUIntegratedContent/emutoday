var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import EventForm from './components/EventForm.vue'
new Vue({
    el: '#vue-event-form',
    components: {EventForm:EventForm},
    ready() {
      console.log('vue ready');
    }
});
