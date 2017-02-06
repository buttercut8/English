<template lang="html">
    <div class="col m12">
        <h2 class="center-align title_page">Firebase</h2>
        <div class="col m12">
        <form @submit.prevent="addMessage" action="" method="post">
            <div class="card">
                <div class="all_message" id="all_message">
                    <div class="card-content" v-for="info in chatroom">
                        <div class="info_user_chat">
                            <div class="chip bg_color white-text">
                                <img :src="'avatar/'+info.avatar" alt="name user">
                                {{info.author}}
                            </div>
                        </div>
                        <div class="message_user">
                            <span v-html="info.message"></span>
                             <i class="material-icons right" @click="removeMessage(info)" v-if="id == info.id">delete_forever</i>
                        </div>
                    </div>
                </div>

                <div class="card-action">
                    <div class="row">
                        <div class="col m12 input-field">
                            <i class="material-icons prefix icon_edit">create</i>
                            <textarea name="message" class="materialize-textarea" id="message" v-model="infomation.message" @keyup.enter="addMessage" length="65535" maxlength="65535"></textarea>
                            <label for="message">Message</label>
                        </div>
                        <div class="col m12 center-align">
                            <button class="btn waves-effect waves-light bg_color" type="submit">Send Message
                               <i class="material-icons right">send</i>
                             </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</template>
<script>
import Firebase from "firebase";
let config = {
    apiKey: "AIzaSyCSq-3cHF-Ms405RAmtyWdF9GXaA1LmIis",
    authDomain: "chatroom-f1482.firebaseapp.com",
    databaseURL: "https://chatroom-f1482.firebaseio.com",
    storageBucket: "chatroom-f1482.appspot.com",
    messagingSenderId: "540488619760"
 };
let app = Firebase.initializeApp(config);
let db = app.database();
let chatroomRef = db.ref('chatroom')

export default {
    firebase:{
        chatroom: chatroomRef
    },
    data(){
        return {
            infomation:{
                author: "",
                message: "",
                avatar: "",
                id:"",
            },
            id:id()
        }
    },
    mounted(){
        axios.post('/infomation-user',{'id': id()})
        .then((response) => {
            this.infomation.author = response.data.name
            this.infomation.avatar = response.data.avatar
            this.infomation.id = response.data.id
        })
    },
    methods:{
        addMessage(e){
            if(e.keyCode == 13 && !e.shiftKey){
                e.preventDefault;
                this.submitMessage();
            }
        },
        submitMessage(){
            chatroomRef.push(this.infomation)
            this.infomation.message = "";
        },
        removeMessage(infomation){
            console.log(infomation);
            chatroomRef.child(infomation['.key']).remove();
            Materialize.toast('Delete successful !','3000','rounded')
        }
    }
}
</script>
<style lang="css">
</style>
