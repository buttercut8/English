<template lang="html">
    <div id="create_todo" class="modal modal-fixed-footer">
         <form id="formCreate" action="" method="post" enctype="multipart/form-data" @submit.prevent="createTodo">
               <div class="modal-content">
                 <h4>Create New Todo</h4>
                 <div class="row">
                    <input type="hidden" name="id" :value="users.id">
                    <div class="col l8 offset-l2 input-field">
                    <input type="text" name="title" id="title" class="validate" length="80" maxlength="80" v-model.trim="todo.title">
                        <label for="title">Title Todo</label>
                        <transition name="slide-fade" mode="out-in">
                            <p class="center error_create" v-if="errors_create.title">{{notice.title}}</p>
                        </transition>
                    </div>
                    <div class="file-field input-field col s12 m12 l6 offset-l2">
                        <div class="upload_image">
                                <i class="material-icons">camera_alt</i>
                               <input type="file" name="image" @change="onFiles">
                        </div>
                        <div class="file-path-wrapper">
                               <input type="text" class="file-path validate" placeholder="Image todo">
                               <transition name="slide-fade" mode="out-in">
                                   <p class="center error_create" v-if="errors_create.image">{{notice.image}}</p>
                               </transition>
                        </div>
                    </div>
                    <div class="col s12 m12 l4 image_upload center">
                            <img :src="image" class="responsive-img">
                    </div>
                    <div class="col l10 offset-l1">
                        <textarea id="editor" name="content" v-model.trim="todo.content"></textarea>
                        <transition name="slide-fade" mode="out-in">
                            <p class="center error_content" v-if="errors_create.content">{{notice.content}}</p>
                        </transition>
                    </div>
                 </div>
               </div>
               <div class="modal-footer">
                    <button type="submit" class="btn waves-effect waves-light" :disabled="test">
                          Post
                          <i class="material-icons right">send</i>
                    </button>
              </div>
         </form>
    </div>
</template>
<script>
// class Errors {
//     constructor() {
//         this.errors  = {}
//     }
//
//     has(field){
//         return this.errors.hasOwnProperty(field)
//     }
//     any(){
//         return Object.keys(this.errors).length > 0 ;
//     }
//     get(field){
//         if(this.errors[field]){
//             return this.errors[field][0]
//         }
//     }
//     record(errors) {
//         this.errors = errors
//     }
//     clear(field){
//         delete this.errors[field]

 // @keydown="errors.clear($event.target.name)"
//     }
// }
export default {
    props:[
        'users'
    ],
    data(){
        return {
            // image:"/avatar/avatar.png",
            image:"",
            test:false,
            errors_create:{
                'title' : false,
                'image' : false,
                'content' : false
            },
            notice:{
                'title' : "",
                'image' : "",
                'content' : ""
            },
            todo:{
                'content' : "",
                'title' : ""
            },
        }
    },
    mounted(){
        $('#title_todo').characterCounter();
        $('#create_todo').modal();
        $('#create_todo').modal({
             complete:function() {
                 document.getElementById('formCreate').reset();
             }
         });
    },
    updated(){
        var self = this
        tinymce.init({
          selector: '#editor',
          height: 180,
          theme: 'modern',
          plugins: [
            'lists link image  hr',
            'fullscreen',
            'insertdatetime media table',
            'emoticons textcolor colorpicker'
          ],
          toolbar1: 'undo redo  | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          toolbar2: 'print preview media | forecolor backcolor emoticons',
          image_advtab: true,
          setup: function(editor) {
                editor.on('keyup', function(e) {
                  let new_value = tinymce.get('editor').getContent(self.value);
                    self.todo.content = new_value;
                });
            }
         });
    },
    methods:{
        onFiles(e){
            let files = e.target.files
            this.createImg(files[0]);
        },
        createImg(files){
              let reader = new FileReader()
              let image = new Image()
              let self = this
              reader.onload = (e) => {
                    self.image = e.target.result
              }
              reader.readAsDataURL(files)
        },
        createTodo(){
            let self = this
            let form =  document.getElementById('formCreate')
            let formData = new FormData(form)
            // axios.post('/create-new-todo',this.$data)
            axios.post('/create-new-todo',formData)
            .then((response) => {
                console.log(response.data)
                if(response.data.errors){
                    if(response.data.errors['title']){
                        this.errors_create.title = true
                        this.notice.title = response.data.errors['title'][0]
                        window.setTimeout(() => {
                            self.errors_create.title = false
                        },4500)
                    }
                    if(response.data.errors['content']){
                        this.errors_create.content = true
                        this.notice.content = response.data.errors['content'][0]
                        window.setTimeout(() => {
                            self.errors_create.content = false
                        },4500)
                    }
                    if(response.data.errors['image']){
                        this.errors_create.image = true
                        this.notice.image = response.data.errors['image'][0]
                        window.setTimeout(() => {
                            self.errors_create.image = false
                        },4500)
                    }
                }else{
                    $('#create_todo').modal('close');
                    Materialize.toast(response.data.success, 4500);

                }
            })
            .catch((error) => {
                alert(error)
            })
        },

    },
}
</script>
<style lang="css">
    .image_upload{
        width: 220px !important;
        height: 140px;
        margin-top: -15px;
    }
    .error_create,.error_content{
        color: #fe4f4f;
        font-weight: 500;
        margin: -10px;
    }
    .error_content{
        margin: 12px;
    }
</style>
