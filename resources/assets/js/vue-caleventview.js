import { createApp } from "vue";
import EventView from './components/EventView.vue'
import store from './vuex/store'
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { EventView }
})
app.use(store)
app.config.globalProperties.$http = axios
app.mount('#vue-caleventview')
