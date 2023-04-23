// var Vue = require('vue');
//
// import VueResource from 'vue-resource';
// Vue.use(VueResource);
//
// // Remember the token we created in the <head> tags? Get it here.
// var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
// Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;
//
// // var moment = require('moment');
// import ExpertForm from './components/ExpertForm.vue';
// import ExpertFormPublic from './components/ExpertFormPublic.vue';
// import ExpertBoxTools from './components/ExpertBoxTools.vue';
// import store from './vuex/store';
//
// var vm = new Vue({
//     el: '#vue-experts',
//     components: {
//         ExpertForm,
//         ExpertBoxTools
//     },
//     store
// });
//
// var vmpublic = new Vue({
//     el: '#vue-experts-public',
//     components: {ExpertFormPublic},
//     store
// });
//
// function assignEventListeners(){
//   // Cancel and edit buttons need to call vue object methods
//   $("#experts-area").on("click", ".editBtn", function(event){
//     vmpublic.$refs.foo.fetchSubmittedRecord(this.parentNode.id);
//   });
//   $("#experts-area").on("click", ".cancelBtn", function(event){
//     vmpublic.$refs.foo.cancelRecord(this.parentNode.id);
//   });
// }
// assignEventListeners();

import { createApp } from "vue"
import ExpertForm from './components/ExpertForm.vue'
import ExpertFormPublic from './components/ExpertFormPublic.vue'
import ExpertBoxTools from './components/ExpertBoxTools.vue'
import store from './vuex/store'
import axios from "axios"
import CKEditor from '@ckeditor/ckeditor5-vue'

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const appAdmin = createApp({
    components: {
        ExpertForm,
        ExpertBoxTools
    },
    store,
})
appAdmin.config.globalProperties.$http = axios
appAdmin.use(CKEditor)
appAdmin.mount('#vue-experts')

const appPublic = createApp({
    components: {
        ExpertFormPublic
    },
    store
})
appPublic.config.globalProperties.$http = axios
appPublic.use(CKEditor)
const vmpublic = appPublic.mount('#vue-experts-public')

// console.log(appPublic)
function assignEventListeners(){
  // Cancel and edit buttons need to call vue object methods
  $("#experts-area").on("click", ".editBtn", function(evt){
      vmpublic.$refs.efpublic.fetchSubmittedRecord(this.parentNode.id)
  });
  $("#experts-area").on("click", ".cancelBtn", function(evt){
      vmpublic.$refs.efpublic.cancelRecord(this.parentNode.id)
  });
}
assignEventListeners();