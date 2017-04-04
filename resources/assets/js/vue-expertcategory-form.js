var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// var moment = require('moment');
import ExpertcategoryForm from './components/ExpertcategoryForm.vue';

var vm = new Vue({
    el: '#vue-expertcategory',
    components: {ExpertcategoryForm},

    ready() {
      console.log('Expert Category Form ready');
    }
});
