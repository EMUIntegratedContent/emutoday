import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
    // When the app starts, count is set to 0
    recordId: 0,
    recordIsDirty: false,
    recordState: 'init'
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
    }
}
export default new Vuex.Store({
    state,
    mutations
})
