import Vuex from 'vuex'

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
	emailBuilderEmail: {
		id: '',
		clone: [],
		created_at: null,
		exclude_events: 0,
		is_approved: false,
		is_president_included: false,
		is_ready: false,
		is_sent: 0,
		mailgun_clicks: 0,
		mailgun_opens: 0,
		mailgun_spam: 0,
		president_teaser: null,
		president_url: null,
		send_at: null,
		subheading: null,
		title: null,
		announcements: [],
		events: [],
		mainStories: [],
		otherStories: [],
		recipients: [],
	}
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
	addMainStory (state, story) {
		state.emailBuilderEmail.mainStories.push(story)
	},
	removeMainStory (state, storyId) {
		const story = state.emailBuilderEmail.mainStories.find(ms => ms.id == storyId)
		if(story) {
			state.emailBuilderEmail.mainStories.splice(state.emailBuilderEmail.mainStories.indexOf(story), 1)
		}
	},
	setEmailBuilderEmail (state, email) {
		state.emailBuilderEmail = email
	},
	setEmailBuilderEmailProp (state, { prop, value }) {
		state.emailBuilderEmail[prop] = value
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
