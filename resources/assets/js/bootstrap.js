import jquery from 'jquery/dist/jquery';
import materialize from 'materialize-css/dist/js/materialize';
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueFire from 'vuefire';



import Firebase from "firebase";
let config = {
    apiKey: "AIzaSyCSq-3cHF-Ms405RAmtyWdF9GXaA1LmIis",
    authDomain: "chatroom-f1482.firebaseapp.com",
    databaseURL: "https://chatroom-f1482.firebaseio.com",
    storageBucket: "chatroom-f1482.appspot.com",
    messagingSenderId: "540488619760"
 };
Firebase.initializeApp(config);
window.Firebase = Firebase;

window.$ = window.jQuery = jquery;

window.Vue = Vue;
Vue.use(VueRouter);
Vue.use(VueFire);
window.axios = axios;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
