var Vue = require('vue');

import VueResource from 'vue-resource';
import CKEditor from 'ckeditor4-vue';

Vue.use(VueResource);
Vue.use( CKEditor );

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

import StoryForm from './components/StoryForm.vue'
import BoxTools from './components/BoxTools.vue'
import store from './vuex/store'


new Vue({
	el: '#vue-story-form-wrapper',
	ready () {
		console.log('vue-story-form');
	},
	store,
	components: {
		StoryForm: StoryForm,
		BoxTools: BoxTools
	},
});
