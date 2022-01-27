/**
 * In the index.js we will import getters, mutations, actions, and state.
 */
import state from './state'
import * as getters from './getters'
import * as mutations from './mutations'
import * as actions from './actions'
export default {
  namespaced: true,
  getters,
  mutations,
  actions,
  state
}