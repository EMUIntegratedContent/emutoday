import { createApp } from "vue"
import MediahighlightForm from './components/MediahighlightForm.vue'
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { MediahighlightForm }
})
app.config.globalProperties.$http = axios
app.mount('#vue-mediahighlight')
