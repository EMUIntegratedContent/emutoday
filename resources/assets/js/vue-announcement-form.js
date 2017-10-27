var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import AnnouncementForm from './components/AnnouncementForm.vue';

var vm = new Vue({
    el: '#vue-announcements',
    components: {AnnouncementForm},
    ready() {
      console.log('AnnouncementForm ready');
    }
});

function assignEventListeners(){
  // Edit buttons need to call vue object methods
  $("#calendar-bar").on("click", ".editBtn", function(event){
    vm.$refs.foo.fetchSubmittedRecord(this.parentNode.id);
  });
}
assignEventListeners();
