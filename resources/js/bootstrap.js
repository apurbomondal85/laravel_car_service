import _ from 'lodash';
window._ = _;

import.meta.glob([
    '../images/**',
]);

try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('@popperjs/core');
    window.bootstrap = require('bootstrap');

} catch (e) {}

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;

window.axios.defaults.headers.common['CSRF-TOKEN'] = getToken();

window.url = getBaseUrl();
window.BASE_URL = getBaseUrl();

function getToken()
{
    return document.getElementsByName("csrf-token")[0].getAttribute('value');
}

function getBaseUrl()
{
    return document.getElementsByName("base-url")[0].getAttribute('value');
}
