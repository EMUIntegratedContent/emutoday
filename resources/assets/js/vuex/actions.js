// An action will receive the store as the first argument.
// Since we are only interested in the dispatch (and optionally the state)
// we can pull those two parameters using the ES6 destructuring feature
export const updateRecordId = function ({ dispatch, state }, value) {
  dispatch('RECORD_ID', value)
}
export const updateRecordIsDirty = function ({ dispatch, state }, value) {
  dispatch('RECORD_IS_DIRTY', value)
}
export const updateRecordState = function ({ dispatch, state }, value) {
  dispatch('RECORD_STATE', value)
}
