import { createApp } from "vue"
import ExpertSpeakerRequestForm from './components/ExpertSpeakerRequestForm.vue'
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content')
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { ExpertSpeakerRequestForm }
})
app.config.globalProperties.$http = axios
app.mount('#vue-expertspeakerrequest-form')
