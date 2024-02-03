import { createApp } from "vue"
import Emu175Form from "./components/emu175/Emu175Form"
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { Emu175Form }
})
app.config.globalProperties.$http = axios
app.mount('#vue-emu-175')
