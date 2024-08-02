import { createApp } from "vue"
import InsideemuPostQueue from "./components/Insideemu/admin/InsideemuPostQueue.vue"
import axios from "axios"
import store from './vuex/insideemu_store'

// Vuetify
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const vuetify = createVuetify({
    components,
    directives,
})

const app = createApp({
    components: { InsideemuPostQueue }
})
app.use(store)
app.use(vuetify)
app.config.globalProperties.$http = axios
app.mount('#vue-insideemu-queue')
