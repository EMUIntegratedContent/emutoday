import { createApp } from "vue"
import ExpertList from './components/ExpertList.vue'
import ExpertBoxTools from './components/ExpertBoxTools.vue'
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content')
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { ExpertList, ExpertBoxTools }
})
app.config.globalProperties.$http = axios
app.mount('#vue-expert-list')
