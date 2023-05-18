import { createApp } from "vue";
import OauthClientForm from './components/passport/Clients.vue'
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content')
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { OauthClientForm }
})
app.config.globalProperties.$http = axios
app.mount('#vue-oauth-client')
