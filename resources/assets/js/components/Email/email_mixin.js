import { mapActions, mapState, mapMutations, mapGetters } from "vuex"
import moment from 'moment'

export const emailMixin = {
	created() {

	},
	data(){
		return {

		}
	},
	computed: {
		...mapState([
			'emailBuilderEmail'
		]),
	},
	methods: {
		...mapMutations([
			'addMainStory',
			'removeMainStory',
			'setEmailBuilderEmail',
			'setEmailBuilderEmailProp'
		])
	}
};
