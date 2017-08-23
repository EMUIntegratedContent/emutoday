var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// var moment = require('moment');
import ExpertForm from './components/ExpertForm.vue';
import ExpertFormPublic from './components/ExpertFormPublic.vue';
import ExpertBoxTools from './components/ExpertBoxTools.vue';
import store from './vuex/store';

var vm = new Vue({
    el: '#vue-experts',
    components: {
        ExpertForm,
        ExpertBoxTools
    },
    store,
    ready() {
      console.log('Expert Form ready');
    }
});

var vmpublic = new Vue({
    el: '#vue-experts-public',
    components: {ExpertFormPublic},
    store,
    ready() {
      console.log('Public Expert Form ready');
    }
});

function assignEventListeners(){
  // Cancel and edit buttons need to call vue object methods
  $("#experts-bar").on("click", ".editBtn", function(event){
    vmpublic.$refs.foo.fetchSubmittedRecord(this.parentNode.id);
  });
  $("#experts-bar").on("click", ".cancelBtn", function(event){
    vmpublic.$refs.foo.cancelRecord(this.parentNode.id);
  });
}
assignEventListeners();
