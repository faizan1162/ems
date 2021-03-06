export const API_URL = "http://127.0.0.1:8000/api/v1/";
export const IMAGE_URL = "http://127.0.0.1:8000/assets/uploads/images/";
export const THUMB_URL = "http://127.0.0.1:8000/assets/thumbnails/";

export const API_LOG = true;
export const ERROR_SOMETHING_WENT_WRONG = 'Something went wrong please try again later.';

export const ERROR_TOKEN_EXPIRE = {
    message: 'Please Login in order to continue!',
    error: 'Please Login in order to continue!',
};
export const REQUEST_TYPE = {
    GET: 'get',
    POST: 'post',
    DELETE: 'delete',
    PUT: 'put',
};
/* AUTHENTICATION CONSTANTS */
export const _LOGIN = {
    route: API_URL + 'admin/login',
    access_token_required: false,
    type: REQUEST_TYPE.POST,
};
export const _LOGOUT = {
    route: API_URL + 'admin/logout',
    access_token_required: true,
    type: REQUEST_TYPE.POST,
};
/* DASHBOARD CONSTANTS */
export const _DASHBOARD = {
    route: API_URL + 'admin/dashboard',
    access_token_required: true,
    type: REQUEST_TYPE.GET,
};

/* Event CONSTANTS */
export const _ADD_EVENTS = {
    route: API_URL + 'admin/event',
    access_token_required: true,
    type: REQUEST_TYPE.POST,
};
export const _ALL_EVENTS = {
    route: API_URL + 'admin/events',
    access_token_required: true,
    type: REQUEST_TYPE.GET,
};
export const _COMPLETED_EVENTS = {
    route: API_URL + 'admin/events?type=completed',
    access_token_required: true,
    type: REQUEST_TYPE.GET,
};
export const _SCHEDULED_EVENTS = {
    route: API_URL + 'admin/events?type=scheduled',
    access_token_required: true,
    type: REQUEST_TYPE.GET,
};
export const _EVENT_DETAILS = {
    route: API_URL + 'admin/event/',
    access_token_required: true,
    type: REQUEST_TYPE.GET,
};

export const _ACTIVE_EVENT_LIST = {
    route: API_URL + 'admin/events/list',
    access_token_required: true,
    type: REQUEST_TYPE.GET,
};
/* Event Participant */
export const _ADD_EVENT_PARTICIPANT = {
    route: API_URL + 'admin/event/participant',
    access_token_required: true,
    type: REQUEST_TYPE.POST,
};
export const _GET_EVENT_PARTICIPANT = {
    route: API_URL + 'admin/event/',
    access_token_required: true,
    type: REQUEST_TYPE.GET,
};
export const _GET_EVENT_AND_USER_DETAILS = {
    route: API_URL + 'admin/event/user/details',
    access_token_required: true,
    type: REQUEST_TYPE.GET,
};
/** Event Ticket Book  */
export const _ALL_TICEKT_BOOKINGS = {
    route: API_URL + 'admin/tickets',
    access_token_required: true,
    type: REQUEST_TYPE.GET,
};
export const _ADD_EVENT_TICKET = {
    route: API_URL + 'admin/event/ticket',
    access_token_required: true,
    type: REQUEST_TYPE.POST,
};
/** Sales Report  */
export const _ALL_EVENT_LIST = {
    route: API_URL + 'admin/event/list',
    access_token_required: true,
    type: REQUEST_TYPE.GET,
};
export const _SALES_REPORT = {
    route: API_URL + 'admin/sales/report',
    access_token_required: true,
    type: REQUEST_TYPE.GET,
};
/** User Routes */
export const _ADD_USER = {
    route: API_URL + 'admin/user',
    access_token_required: true,
    type: REQUEST_TYPE.POST,
};