var Vue = require('vue');
import VueResource from 'vue-resource';
Vue.use(VueResource);
// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import VueCharts from  'vue-charts';
Vue.use(VueCharts);
import PageChartApp from './components/PageChartApp.vue'
new Vue({
    el: '#vue-chart-app',
    components: {PageChartApp}
});
