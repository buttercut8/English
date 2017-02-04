 import "./bootstrap";
 import Router from './routes';
// Vue.component('login',require('./views/Login.vue'))
// import InfomationUser from "./model/InfomationUser";
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
