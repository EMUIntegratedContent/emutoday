import { createApp } from "vue"
import StoryideasForm from './components/StoryIdeasForm.vue'
import StoryideasBoxTools from './components/StoryIdeasBoxTools.vue'
import axios from "axios"
import store from './vuex/store'
import CKEditor from '@ckeditor/ckeditor5-vue'

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content')
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { StoryideasForm, StoryideasBoxTools }
})
app.use(store)
app.use(CKEditor)
app.config.globalProperties.$http = axios
app.mount('#vue-storyidea')
