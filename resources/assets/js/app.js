 import "./bootstrap";
 import Router from './routes';
// Vue.component('login',require('./views/Login.vue'))
// import InfomationUser from "./model/InfomationUser";

// import Firebase from "firebase";
// let config = {
//         apiKey: "AIzaSyCSq-3cHF-Ms405RAmtyWdF9GXaA1LmIis",
//         authDomain: "chatroom-f1482.firebaseapp.com",
//         databaseURL: "https://chatroom-f1482.firebaseio.com",
//         storageBucket: "chatroom-f1482.appspot.com",
//         messagingSenderId: "540488619760"
// };
// let app = Firebase.initializeApp(config);
// let db = app.database();


let app = new Vue({
    el: '#app_english',
    data(){
        return{
            // users:[],
            loadding:false,
        }
    },
    components:{
        'login' :require('./views/Login'),
        'editmenu' :require('./views/EditMenu'),
        'info-user' :require('./views/InfoUser'),
    },
    mounted(){
        // axios.post('/infomation-user',{'id': id()})
        // .then((response) => {
        // this.users = response.data
        // })
    },
    methods:{

    },
    router:Router,
});
