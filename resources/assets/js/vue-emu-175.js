import { createApp } from "vue"
import Emu175StoryQueue from "./components/emu175/Emu175StoryQueue"
import axios from "axios"
import store from './vuex/store'

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { Emu175StoryQueue }
})
app.use(store)
app.config.globalProperties.$http = axios
app.mount('#vue-emu-175')
