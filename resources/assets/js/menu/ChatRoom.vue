<template lang="html">
<div class="col m12">
    <h2 class="center-align">{{title}}</h2>
    <div class="col m12">
        <div class="card">
            <!-- <div class="card-image">
                <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
            </div> -->


            <div class="all_message">

                <div class="card-content">
                    <div class="info_user_chat">
                        <div class="chip bg_color white-text">
                            <img src="avatar/avatar.png" alt="name user">
                            Mark Remy
                        </div>
                    </div>
                    <div class="message_user">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                </div>





            </div>


















            <div class="card-action">
                <div class="input-field">
                    <i class="material-icons prefix icon_edit">create</i>
                    <textarea name="comment" class="materialize-textarea" id="comment" v-model.trim="chat_comment" @keydown.enter="sendMessage"></textarea>
                    <label for="comment" length="">Message</label>
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
            chat_comment: "",
        }
    },
    mounted(){

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
        //             self.chat_comment = new_value;
        //         });
        //     }
        //  });
    },
    computed:{

    },
    methods:{
        sendMessage(e){
            if(e.keyCode == 13 && !e.shiftKey){
                e.preventDefault;
                this.submitMessage();
                this.chat_comment = "";
            }
        },
        submitMessage(){
            if(this.chat_comment){
                console.log(this.chat_comment);
            }
        }
    },
}
</script>
<style lang="css">
</style>
