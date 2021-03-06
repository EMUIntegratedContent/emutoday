import Vue from 'vue'
import Vuex from 'vuex'
import moment from 'moment'

Vue.use(Vuex)

const state = {
    // When the app starts, count is set to 0
    recordId: 0,
    recordIsDirty: false,
    recordState: 'init',
    magazineBuilderArticlesMain: [],
    magazineBuilderArticlesSub: [],
    issueArticles: [null,null,null,null,null,null],
    modalPosition: ''
}
const mutations = {
    // A mutation receives the current state as the first argument
    // You can make any modifications you want inside this function
    RECORD_ID (state, id) {
        state.recordId =  id
    },
    RECORD_IS_DIRTY (state, tf) {
        state.recordIsDirty = tf
    },
    RECORD_STATE (state, value) {
        state.recordState = value
    },
    addOtherArticle(state) {
      state.issueArticles.push(null)
    },
    // When removing an article that is not part of the normal magazine buidler (index > 5),
    // Any articles that come after it must move up
    removeOtherArticleAtIndex(state, index) {
        state.issueArticles.splice(index, 1)
    },
    setIssueArticleAtIndex (state, {index, article}) {
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
    }
}
export default new Vuex.Store({
    state,
    mutations
})
