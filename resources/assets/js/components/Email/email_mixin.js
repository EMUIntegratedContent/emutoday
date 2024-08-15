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
			'addInsidePost',
			'addMainStory',
			'addOtherStory',
			'removeAnnouncement',
			'removeEvent',
			'removeInsidePost',
			'removeMainStory',
			'removeOtherStory',
			'resetEmailBuilderEmail',
			'setEmailBuilderEmail',
			'setEmailBuilderEmailProp',
			'updateAnnouncementsOrder',
			'updateEventsOrder',
			'updateInsideemuPostsOrder',
			'updateMainStoriesOrder',
			'updateOtherStoriesOrder'
		])
	}
};
