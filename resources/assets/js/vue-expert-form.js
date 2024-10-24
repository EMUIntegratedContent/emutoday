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
