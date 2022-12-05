import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

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
	selectedCalendarCategory: null
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
