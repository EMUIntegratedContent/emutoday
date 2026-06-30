import { createApp } from "vue"
import StudentEmailForm from "./components/StudentEmail/StudentEmailForm"
import axios from "axios"
import store from './vuex/store'

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { StudentEmailForm }
})
app.use(store)
app.config.globalProperties.$http = axios
app.mount('#vue-studentemails')
