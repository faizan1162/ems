/***
 * It is only possible to change states through mutations.
 * In the account module mutation,
 * We will create a function that receives the userData state as a parameter,
 * and a value that will be assigned to it in the actions.js when some function commits it.
 * The mutation function will assign the received value to the userData state. 
 * mutations.js is used to set data in the state
 */

export function setUserData(state, val) {
    state.userData = val
    state.userId = val.uid,
        state.userToken = val.token
}
export function resetUserData(state) {
    state.userId = null,
        state.userToken = null,
        state.userData = {}
}