var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import EmailForm from './components/Email/EmailForm.vue';
//import EmailBoxTools from './components/EmailBoxTools.vue';
import store from './vuex/store';

var vm = new Vue({
    el: '#vue-emails',
    components: {
        EmailForm,
        //ExpertBoxTools
    },
    store,
    ready() {
      console.log('Email Form ready');
    }
});

function assignEventListeners(){
  // Cancel and edit buttons need to call vue object methods
  /*
  $("#experts-area").on("click", ".editBtn", function(event){
    vmpublic.$refs.foo.fetchSubmittedRecord(this.parentNode.id);
  });
  $("#experts-area").on("click", ".cancelBtn", function(event){
    vmpublic.$refs.foo.cancelRecord(this.parentNode.id);
  });
  */
}
assignEventListeners();
