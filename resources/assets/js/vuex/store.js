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
    usedMainArticle: null,
    usedSubArticle1: null,
    usedSubArticle2: null,
    usedSubArticle3: null,
    usedSubArticle4: null,
    usedSubArticle5: null,
    usedOtherArticles: [],
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
    setIssueArticleAtIndex (state, {index, article}) {
        state.issueArticles.splice(index, 1, article)
    },
    setMagazineArticlesMain (state, articles) {
        state.magazineBuilderArticlesMain = articles
    },
    setMagazineArticlesSub (state, articles) {
        state.magazineBuilderArticlesSub = articles
    },
    setMainArticle (state, article) {
        state.usedMainArticle = article
    },
    setSubArticle1 (state, article) {
        state.usedSubArticle1 = article
    },
    setSubArticle2 (state, article) {
        state.usedSubArticle2 = article
    },
    setSubArticle3 (state, article) {
        state.usedSubArticle3 = article
    },
    setSubArticle4 (state, article) {
        state.usedSubArticle4 = article
    },
    setSubArticle5 (state, article) {
        state.usedSubArticle5 = article
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
