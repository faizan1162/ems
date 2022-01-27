/* Getters returns the states; */
export function user(state) {
    return state.userData;
}
export function isLoggedIn(state) {
    return (state.userToken != null && state.userToken != "" ? true : false);
}
export function getUserId(state) {
    return state.userId;
}
export function authToken(state) {
    return state.userToken;
}