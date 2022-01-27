import moment from "moment";
import { IMAGE_URL, THUMB_URL } from './config/constants'
export default {
    cDateFormat(dateTime) {
        var dt = moment(dateTime);
        return dt.format('Do MMMM YYYY');
    },

    capFirstLetter(val) {
        return val.charAt(0).toUpperCase() + val.slice(1);
    },
    getThumbUrl: function(image_name) {
        if (image_name == "" || image_name == null) {
            return "/assets/dummy.png";
        } else {
            return THUMB_URL + image_name;
        }
    },
    getImageUrl: function(image_name) {
        if (image_name == "" || image_name == null) {
            return "/assets/dummy.png";
        } else {
            return IMAGE_URL + image_name;
        }
    },
    utcToLocal: function(t) {
        return moment.utc(t).local().format('MM/DD/YYYY, h:mm:ss A z');
    },
};