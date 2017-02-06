<template lang="html">
<div class="col m12">
    <h2 class="center-align title_page">{{title}}</h2>
    <div class="col m12">
        <div class="card">
            <!-- <div class="card-image">
                <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
            </div> -->
            <div class="all_message" id="all_message">
                <div class="card-content" v-for="(comment,index) in comments">
                    <div class="info_user_chat">
                        <div class="chip bg_color">
                            <a href="#" class="white-text">
                                <img :src="'public/avatar/'+comment.user.avatar" :alt="comment.user.name">
                                {{comment.user.name}}
                            </a>
                        </div>
                    </div>
                    <div class="message_user">
                        <span v-text="comment.message" class="message_single tooltipped" data-position="right" data-delay="30" :data-tooltip="messagedOn(comment.created_at)"></span>
                         <!-- <i class="material-icons right">delete_forever</i> -->
                         <i class="material-icons right" @click="removeMessage(comment.id,index)">delete_forever</i>
                         <i class="material-icons right" @click="editMessage(comment.id,index)">create</i>
                    </div>
                </div>
            </div>

            <!-- <div>
                <div class="card-content" v-for="comment in comments">
                    <div class="info_user_chat">
                        <div class="chip bg_color white-text">
                            <img :src="'public/avatar/'+comment.user.avatar" :alt="comment.user.name">
                            {{comment.user.name}}
                        </div>
                    </div>
                    <div class="message_user">
                        {{comment.message}}
                    </div>
                </div>
            </div> -->

            <div class="card-action">
                <div class="input-field">
                    <i class="material-icons prefix icon_edit">create</i>
                    <textarea name="inbox" class="materialize-textarea" id="inbox" v-model.trim="inbox.message" @keydown.enter="sendMessage" length="65535" maxlength="65535"></textarea>
                    <label for="inbox">Message</label>
                </div>
                 <!-- <textarea name="comment" id="comment" v-model.trim="chat_comment" @keydown.enter="sendMessage"></textarea> -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
import moment from "moment";
export default {
    data(){
        return {
            title: "Chat Room",
            comments:[
                {
                    message : '',
                    created_at : '',
                    user : {
                        avatar : '',
                        name : ''
                    },
                }
            ],
            inbox:{
                avatar:'',
                name:'',
                message:'',
            }
        }
    },
    created(){
          axios.post('/list-message')
          .then((response) => {
              this.comments = response.data
          });

        Echo.join('chatroom-realtime')
          //  .here((users) => {
          //      this.usersInRoom = users;
          //  })
          //  .joining((user) => {
          //      this.usersInRoom.push(user);
          //  })
          //  .leaving((user) => {
          //      this.usersInRoom = this.usersInRoom.filter(u => u != user)
          //  })
           .listen('MessagePosted', (e) => {
               console.log(e);
            //    this.messages.push({
            //        comments.message: e.chatroom.message,
            //        comments.user.name : e.user.name
            //    });
           });
    },
    mounted(){
        axios.post('/infomation-user',{'id': id()})
        .then((response) => {
            this.inbox.avatar = response.data.avatar
            this.inbox.name = response.data.name
        })
    },
    updated(){
        // var self = this
        // tinymce.init({
        //   selector: '#comment',
        //   height: 180,
        //   theme: 'modern',
        //   plugins: [
        //     'lists link image  hr',
        //     'fullscreen',
        //     'insertdatetime media table',
        //     'emoticons textcolor colorpicker'
        //   ],
        //   toolbar1: 'undo redo  | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        //   toolbar2: 'print preview media | forecolor backcolor emoticons',
        //   image_advtab: true,
        //   setup: function(comment) {
        //         comment.on('keyup', function(e) {
        //           let new_value = tinymce.get('comment').getContent(self.value);
        //             self.message = new_value;
        //         });
        //     }
        //  });
        let messages = document.getElementById('all_message');
        messages.scrollTop = messages.scrollHeight
    },
    methods:{
        messagedOn(time){
            return moment(time).fromNow();
        },
        sendMessage(e){
            if(e.keyCode == 13 && !e.shiftKey){
                e.preventDefault;
                this.submitMessage();
            }
        },
        submitMessage(){
            let data = {
                message : this.inbox.message,
                user : {
                    avatar : this.inbox.avatar,
                    name : this.inbox.name
                },
            };
            this.comments.push(data);
            this.inbox.message = "";
            axios.post('/send-message',data)
            .then((response) => {
                console.log(response.data);
                // if(response.data.chatroom){

                // }
                // if(response.data.errors){
                //     Materialize.toast('<span class="error_toast">'+response.data.errors+'</span>',4000)
                // }
            })
            .catch((error) => {
                Materialize.toast('<span class="error_toast">'+error+'</span>',4000)
            });

        },
        editMessage(info_inbox,key){
            // axios.post('/edit-message/'+info_inbox)
            // .then((response) => {
            //     if(response.data.success){
            //         this.comments.splice(key,1);
            //         Materialize.toast(response.data.success,2500,'rounded');
            //     }
            //     if(response.data.errors){
            //         Materialize.toast('<span class="error_toast">'+response.data.errors+'</span>',4000)
            //     }
            // })
            // .catch((error) => {
            //     Materialize.toast('<span class="error_toast">'+error+'</span>',4000)
            // });
        },
        removeMessage(info_inbox,key){
            axios.post('/delete-message/'+info_inbox)
            .then((response) => {
                if(response.data.success){
                    this.comments.splice(key,1);
                    Materialize.toast(response.data.success,2500,'rounded');
                }
                if(response.data.errors){
                    Materialize.toast('<span class="error_toast">'+response.data.errors+'</span>',4000)
                }
            })
            .catch((error) => {
                Materialize.toast('<span class="error_toast">'+error+'</span>',4000)
            });
        }
    },
}
</script>
<style lang="css">
</style>
