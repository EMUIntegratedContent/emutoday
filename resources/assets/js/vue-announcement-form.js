import { createApp } from "vue"
import AnnouncementForm from './components/AnnouncementForm.vue'
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content')
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
	components: { AnnouncementForm }
})
app.config.globalProperties.$http = axios
const vm = app.mount('#vue-announcements')

function assignEventListeners () {
	// Edit buttons need to call vue object methods
	$("#calendar-bar").on("click", ".editBtn", function (event) {
		vm.$refs.aform.fetchCurrentRecord(this.parentNode.id)
	})
}

assignEventListeners()
