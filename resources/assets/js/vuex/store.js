import Vuex from 'vuex'

const defaultEmail = {
	id: '',
	clone: [],
	created_at: null,
	exclude_events: 0,
	exclude_inside_posts: 0,
	is_approved: false,
	is_president_included: false,
	is_emu175_included: false,
	is_ready: false,
	is_sent: 0,
	mailgun_clicks: 0,
	mailgun_opens: 0,
	mailgun_spam: 0,
	president_teaser: null,
	president_url: null,
	emu175_teaser: null,
	emu175_url: null,
	send_at: null,
	subheading: null,
	title: null,
	announcements: [],
	events: [],
	mainStories: [],
	otherStories: [],
	insidePosts: [],
	recipients: []
}

const state = {
	calendarCategories: [],
	// When the app starts, count is set to 0
	recordId: 0,
	recordIsDirty: false,
	recordState: 'init',
	magazineBuilderArticlesMain: [],
	magazineBuilderArticlesSub: [],
	issueArticles: [null, null, null, null, null, null],
	modalPosition: '',
	selectedCalendarCategory: null,
	// Email builder
	emailBuilderEmail: JSON.parse(JSON.stringify(defaultEmail)),
	// EMU 175 (2024) story
	emu175Story: null
}
const mutations = {
	// A mutation receives the current state as the first argument
	// You can make any modifications you want inside this function
	RECORD_ID (state, id) {
		state.recordId = id
	},
	RECORD_IS_DIRTY (state, tf) {
		state.recordIsDirty = tf
	},
	RECORD_STATE (state, value) {
		state.recordState = value
	},
	addOtherArticle (state) {
		state.issueArticles.push(null)
	},
	// When removing an article that is not part of the normal magazine buidler (index > 5),
	// Any articles that come after it must move up
	removeOtherArticleAtIndex (state, index) {
		state.issueArticles.splice(index, 1)
	},
	setCalendarCategories (state, categories) {
		state.calendarCategories = categories
	},
	setIssueArticleAtIndex (state, { index, article }) {
		state.issueArticles.splice(index, 1, article)
	},
	setMagazineArticlesMain (state, articles) {
		state.magazineBuilderArticlesMain = articles
	},
	setMagazineArticlesSub (state, articles) {
		state.magazineBuilderArticlesSub = articles
	},
	setModalPosition (state, position) {
		state.modalPosition = position
	},
	setIssueArticles (state, articles) {
		state.issueArticles = articles
	},
	setSelectedCalendarCategory (state, category) {
		state.selectedCalendarCategory = category
	},
	// Email Builder
	addAnnouncement (state, ann) {
		state.emailBuilderEmail.announcements.push(ann)
	},
	addEvent (state, event) {
		state.emailBuilderEmail.events.push(event)
	},
	addInsidePost (state, post) {
		state.emailBuilderEmail.insidePosts.push(post)
	},
	addMainStory (state, story) {
		state.emailBuilderEmail.mainStories.push(story)
	},
	addOtherStory (state, story) {
		state.emailBuilderEmail.otherStories.push(story)
	},
	removeAnnouncement (state, annId) {
		const announcements = JSON.parse(JSON.stringify(state.emailBuilderEmail.announcements))
		const announcement = announcements.find(an => an.id == annId)
		if(announcement) {
			announcements.splice(announcements.indexOf(announcement), 1)
			state.emailBuilderEmail.announcements = JSON.parse(JSON.stringify(announcements))
		}
	},
	removeEvent (state, eventId) {
		const events = JSON.parse(JSON.stringify(state.emailBuilderEmail.events))
		const event = events.find(ev => ev.id == eventId)
		if(event) {
			events.splice(events.indexOf(event), 1)
			state.emailBuilderEmail.events = JSON.parse(JSON.stringify(events))
		}
	},
	removeInsidePost (state, postId) {
		const posts = JSON.parse(JSON.stringify(state.emailBuilderEmail.insidePosts))
		const post = posts.find(ip => ip.postId == postId)
		if(post) {
			posts.splice(posts.indexOf(post), 1)
			state.emailBuilderEmail.insidePosts = JSON.parse(JSON.stringify(posts))
		}
	},
	removeMainStory (state, storyId) {
		const mainStories = JSON.parse(JSON.stringify(state.emailBuilderEmail.mainStories))
		const story = mainStories.find(ms => ms.id == storyId)
		if(story) {
			mainStories.splice(mainStories.indexOf(story), 1)
			state.emailBuilderEmail.mainStories = JSON.parse(JSON.stringify(mainStories))
		}
	},
	removeOtherStory (state, storyId) {
		const story = state.emailBuilderEmail.otherStories.find(os => os.id == storyId)
		if(story) {
			state.emailBuilderEmail.otherStories.splice(state.emailBuilderEmail.otherStories.indexOf(story), 1)
		}
	},
	resetEmailBuilderEmail (state) {
		state.emailBuilderEmail = JSON.parse(JSON.stringify(defaultEmail))
	},
	setEmailBuilderEmail (state, email) {
		state.emailBuilderEmail = email
	},
	setEmailBuilderEmailProp (state, { prop, value }) {
		state.emailBuilderEmail[prop] = value
	},
	updateAnnouncementsOrder (state, { newIndex, oldIndex }) {
		state.emailBuilderEmail.announcements.splice(newIndex, 0, state.emailBuilderEmail.announcements.splice(oldIndex, 1)[0]);
	},
	updateEventsOrder (state, { newIndex, oldIndex }) {
		state.emailBuilderEmail.events.splice(newIndex, 0, state.emailBuilderEmail.events.splice(oldIndex, 1)[0]);
	},
	updateInsidePostsOrder (state, { newIndex, oldIndex }) {
		state.emailBuilderEmail.insidePosts.splice(newIndex, 0, state.emailBuilderEmail.insidePosts.splice(oldIndex, 1)[0]);
	},
	updateMainStoriesOrder (state, { newIndex, oldIndex }) {
		state.emailBuilderEmail.mainStories.splice(newIndex, 0, state.emailBuilderEmail.mainStories.splice(oldIndex, 1)[0]);
	},
	updateOtherStoriesOrder (state, { newIndex, oldIndex }) {
		state.emailBuilderEmail.otherStories.splice(newIndex, 0, state.emailBuilderEmail.otherStories.splice(oldIndex, 1)[0]);
	},
	// EMU 175 (2024)
	setEmu175Story (state, story) {
		state.emu175Story = story
	}
}
const actions = {
	updateRecordId ({ commit, state }, value) {
		commit('RECORD_ID', value)
	},
	updateRecordIsDirty ({ commit, state }, value) {
		commit('RECORD_IS_DIRTY', value)
	},
	updateRecordState ({ commit, state }, value) {
		commit('RECORD_STATE', value)
	}
}

const getters = {
	getRecordId (state) {
		return state.recordId
	},
	getRecordIsDirty (state) {
		return state.recordIsDirty
	},
	getRecordState (state) {
		return state.recordState
	}
}
export default new Vuex.Store({
	state,
	mutations,
	actions,
	getters
})
