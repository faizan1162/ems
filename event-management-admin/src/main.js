import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import jQueryObj from 'jquery'
import 'es6-promise/auto'
import Toaster from '@meforma/vue-toaster';
import helpers from './helpers';


// import 
window.$ = window.jQuery = global.jQuery = jQueryObj;
const app = createApp(App);
// do some necessary preparations
const toastOpt = {
    position: "top-right",
    duration: 3000,
    dismissible: true,

}
const MyCustomPlugin = {
    install() {
        app.helpers = helpers
        app.config.globalProperties.$helpers = helpers
    }
}
app.use(Toaster, toastOpt);
app.use(MyCustomPlugin);
app.use(router).use(store).mount('#app');