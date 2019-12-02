var Vue = require('vue');
window.Vue = Vue

Vue.use(require('vue-resource'))
Vue.use(require('vue-select'))

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import EventForm from './components/EventForm.vue'

window.vm = new Vue({
    el: '#vue-event-form',
    components: {EventForm},
});

function assignEventListeners(){
    // Cancel and edit buttons need to call vue object methods
    $("#calendar-bar").on("click", ".editBtn", function(event){
        vm.$refs.eform.fetchSubmittedRecord(this.parentNode.id);
    });
    $("#calendar-bar").on("click", ".cancelBtn", function(event){
        vm.$refs.eform.cancelRecord(this.parentNode.id);
    });
}
assignEventListeners();
