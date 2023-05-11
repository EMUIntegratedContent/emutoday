import { mapState, mapMutations } from "vuex"

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
			'resetEmailBuilderEmail',
			'setEmailBuilderEmail',
			'setEmailBuilderEmailProp',
			'updateAnnouncementsOrder',
			'updateEventsOrder',
			'updateMainStoriesOrder',
			'updateOtherStoriesOrder'
		])
	}
};
