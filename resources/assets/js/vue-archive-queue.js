import { createApp } from "vue"
import ArchiveQueue from './components/ArchiveQueue.vue'
import axios from "axios"
import VueResource from 'vue-resource';

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { ArchiveQueue, VueResource }
})
app.config.globalProperties.$http = axios
app.mount('#vue-archive-queue')
