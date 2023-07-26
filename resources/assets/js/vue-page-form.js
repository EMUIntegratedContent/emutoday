import { createApp } from "vue"
import PageForm from "./components/Page/PageForm"
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { PageForm }
})
app.config.globalProperties.$http = axios
app.mount('#vue-page')
