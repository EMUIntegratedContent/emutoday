var Vue = require('vue');
window.Vue = Vue

Vue.use(require('vue-resource'))

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import AnnouncementForm from './components/AnnouncementForm.vue';

window.vm = new Vue({
    el: '#vue-announcements',
    components: {AnnouncementForm},
});

function assignEventListeners(){
    // Edit buttons need to call vue object methods
    $("#calendar-bar").on("click", ".editBtn", function(event){
        vm.$refs.aform.fetchSubmittedRecord(this.parentNode.id);
    });
}
assignEventListeners();
