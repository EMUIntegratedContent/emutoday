import { createApp } from "vue"
import EventForm from "./components/EventForm"
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content')
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { EventForm }
})
app.config.globalProperties.$http = axios
const vm = app.mount('#vue-event-form')

function assignEventListeners(){
    // Cancel and edit buttons need to call vue object methods
    $("#calendar-bar").on("click", ".editBtn", function(event){
        vm.$refs.eform.fetchSubmittedRecord(this.parentNode.id)
    })
    $("#calendar-bar").on("click", ".cancelBtn", function(event){
        vm.$refs.eform.cancelRecord(this.parentNode.id)
    })
}
assignEventListeners()
