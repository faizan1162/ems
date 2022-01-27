import axios from 'axios';
import { API_URL, IMAGE_URL, THUMB_URL } from './config/constants';
import store from './store';
export default {
    async execute(meta, uri, data) {
        let token = "";
        if (meta.access_token_required) {
            token = store.getters['account/authToken'];
        }
        let config = {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Access-Control-Allow-Origin": "*"
                },
                method: meta.type.toLowerCase(),
                url: uri,
                data: data,
                baseURL: API_URL,
                validateStatus: function(status) {
                    return status >= 200 && status < 400
                }
            }
            /* just for testing log config */
        return axios(config).then(
            function(response) {
                return response.data
            }
        ).catch(err => {
            if (err.response) {
                if (err.response.status == 401) {
                    store.dispatch('account/logout');
                    //console.log(store.getters['account/authToken'])
                    alert("UnAuthrize Access, Your Token Expired");
                    window.location.href = '/login';
                    //this.$router.push({ name: "AdminLogin" });
                }
            } else if (err.request) {
                // client never received a response, or request never left
            } else {
                // anything else
            }
        })
    },
    getImageUrl: function(image_name) {
        return IMAGE_URL + image_name;
    },
    getThumbUrl: function(image_name) {
        if (image_name == "" || image_name == null) {
            return "/assets/images/dummy.png";
        } else {
            return THUMB_URL + image_name;
        }
    }

}