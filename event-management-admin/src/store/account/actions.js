/**
 * In action.js of the account module, 
 * we will access a dummy API with Axios to fetch a user and then store it in our state userData 
 * committing the mutations setUserData
 */
//  import router from '../../router'
//  import Axios from 'axios';

import api from '../../http-common.js'
export function saveUser({ commit }, result) {
    let userData = {
        uid: result.id,
        token: result.token,
        full_name: result.full_name,
        email: result.email,
        phone: result.phone,
        avatar: api.getThumbUrl(result.avatar),
    }
    commit("setUserData", userData)
}
export function logout({ commit }) {
    commit("resetUserData")
}