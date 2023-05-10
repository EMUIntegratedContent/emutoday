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
			'addAnnouncement',
			'addEvent',
			'addMainStory',
			'addOtherStory',
			'removeAnnouncement',
			'removeEvent',
			'removeMainStory',
			'removeOtherStory',
			'setEmailBuilderEmail',
			'setEmailBuilderEmailProp',
			'updateAnnouncementsOrder',
			'updateEventsOrder',
			'updateMainStoriesOrder',
			'updateOtherStoriesOrder'
		])
	}
};
