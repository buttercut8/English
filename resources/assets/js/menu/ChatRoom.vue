<template lang="html">
<div class="col m12">
    <h2 class="center-align title_page">{{title}}</h2>
    <div class="col m12">
        <div class="card">
            <!-- <div class="card-image">
                <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
            </div> -->
            <div class="all_message">

                <div class="card-content" v-for="comment in comments">
                    <div class="info_user_chat">
                        <div class="chip bg_color white-text">
                            <img src="avatar/avatar.png" alt="name user">
                            <!-- Mark Remy -->
                            {{comment.users}}
                        </div>
                    </div>
                    <div class="message_user">
                        {{comment.message}}
                    </div>
                </div>


            </div>


            <div class="card-action">
                <div class="input-field">
                    <i class="material-icons prefix icon_edit">create</i>
                    <textarea name="comment" class="materialize-textarea" id="comment" v-model.trim="comments.message" @keydown.enter="sendMessage" length="65535" maxlength="65535"></textarea>
                    <label for="comment">Message</label>
                </div>
                 <!-- <textarea name="comment" id="comment" v-model.trim="chat_comment" @keydown.enter="sendMessage"></textarea> -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return {
            title: "Chat Room",
            comments:[
                  {
                        message:"asdasd",
                        users:"",
                  }
            ],
            users:[],

        }
    },
    mounted(){
          axios.post('/infomation-user',{'id': id()})
          .then((response) => {
                if(response.data){
                  //     this.users = response.data
                      this.comments.users = response.data.name
                }
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
    },
    methods:{
        sendMessage(e){
            if(e.keyCode == 13 && !e.shiftKey){
                e.preventDefault;
                this.submitMessage();
                this.comments.message = "";
            }
        },
        submitMessage(){
            if(this.comments.message){
                  this.comments.push(this.comments.message)
            }
        }
    },
}
</script>
<style lang="css">
</style>
