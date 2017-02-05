<template lang="html">
    <div class="col m12">
        <h2 class="center-align title_page">Firebase</h2>
        <div class="col m12">
        <form @submit.prevent="addMessage" action="" method="post">
            <div class="card">
                <div class="all_message">
                    <div class="card-content" v-for="info in chatroom">
                        <div class="info_user_chat">
                            <div class="chip bg_color white-text">
                                <img src="avatar/avatar.png" alt="name user">
                                {{info.author}}
                            </div>
                        </div>
                        <div class="message_user">
                            {{info.message}}
                             <i class="material-icons right" @click="removeMessage(info)">delete_forever</i>
                        </div>
                    </div>
                </div>
                <!-- <pre>
                    {{chatroom}}
                </pre> -->

                <div class="card-action">
                    <div class="row">
                        <div class="col m4 input-field">
                            <i class="material-icons prefix icon_edit">create</i>
                            <textarea name="author" class="materialize-textarea" id="author" v-model="infomation.author"></textarea>
                            <label for="author">Author</label>
                        </div>
                        <div class="col m8 input-field">
                            <i class="material-icons prefix icon_edit">create</i>
                            <textarea name="message" class="materialize-textarea" id="message" v-model="infomation.message"></textarea>
                            <label for="message">Message</label>
                        </div>
                        <div class="col m12 center-align">
                            <button class="btn waves-effect waves-light" type="submit">Send
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
                message: ""
            },
        }
    },
    methods:{
        addMessage(){
            chatroomRef.push(this.infomation)
            this.infomation.author = "";
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
