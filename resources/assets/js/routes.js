import VueRouter from 'vue-router';

let routes = [
    {
        path:'/add-member',
        component:require('./menu/AddMember'),
    },
    {
        path:'/todo-list',
        component:require('./menu/TodoList'),
    },
    {
        path:'/firebase',
        component:require('./menu/FireBase'),
    },
    {
        path:'/chat-room',
        component:require('./menu/ChatRoom'),
        // beforeEnter (router, redirect, next){
        //     let confirm = window.confirm("Are you ready ?")
        //     if(confirm){
        //         next()
        //     }else{
        //         redirect('/')
        //     }
        // }
    },
    // {
    //     path:'/messenger',
    //     component:require('./menu/ChatRoom'),
    // },
    {
        path:'/phone-messenger',
        component:require('./menu/PhoneMessenger'),
    },
    {
        path:'/insert-photo',
        component:require('./menu/InsertPhoto'),
    },
    {
        path:'/watch-movie',
        component:require('./menu/WatchMovie'),
    },
    {
        path:'/listening-music',
        component:require('./menu/ListeningMusic'),
    },
    {
        path:'/upload-document',
        component:require('./menu/UploadDocument'),
    },
];

export default new VueRouter({
    routes,
    mode:'history',
    linkActiveClass :'active-menu'
});
