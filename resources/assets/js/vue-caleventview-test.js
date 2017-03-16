var Vue = require('vue');

var VueResource = require('vue-resource');
Vue.use(VueResource);

var VueRouter = require('vue-router');
Vue.use(VueRouter);


import EventViewTest from './components/EventViewTest.vue';

new Vue({
    el: '#vue-caleventview-test',

    components: {EventViewTest},

    ready() {
      // alert('vue ready');
    }
});
