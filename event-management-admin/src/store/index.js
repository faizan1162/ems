import { createStore } from 'vuex'
import createPersistedState from "vuex-persistedstate";
import account from "./account";
// Create a new store instance.
const saveState = createPersistedState({
    paths: ['account']
})
const store = createStore({
    modules: {
        account
    },
    plugins: [saveState],
})
export default store