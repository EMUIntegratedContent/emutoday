import { createApp } from "vue"
import StoryideasList from './components/StoryideasList.vue'
import axios from "axios"
import store from './vuex/store'

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content')
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { StoryideasList }
})
app.use(store)
app.config.globalProperties.$http = axios
app.mount('#vue-storyideas-list')
