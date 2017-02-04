<template lang="html">
    <div id="create_todo" class="modal modal-fixed-footer create_todo">
         <form id="formCreate" action="" method="post" enctype="multipart/form-data" @submit.prevent="createTodo">
               <div class="modal-content">
                 <h4>Create New Todo</h4>
                 <div class="row">
                    <input type="hidden" name="id" :value="todo.id">
                    <div class="col l8 offset-l2 input-field">
                    <input type="text" name="title" id="title" class="validate" length="80" maxlength="80" v-model.trim="todo.title">
                        <label for="title">Title Todo</label>
                    </div>
                    <div class="file-field input-field col s12 m12 l6 offset-l2">
                        <div class="upload_image">
                                <i class="material-icons">camera_alt</i>
                               <input type="file" name="image" @change="onFiles">
                        </div>
                        <div class="file-path-wrapper">
                               <input type="text" class="file-path validate" placeholder="Image todo">
                        </div>
                    </div>
                    <div class="col s12 m12 l4 image_upload center">
                            <img :src="image" class="responsive-img">
                    </div>
                    <div class="col m12 l10 offset-l1">
                        <textarea name="content" id="editor" style="display:block" v-model.trim="todo.content"></textarea>
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
    data(){
        return {
            image:"",
            test:false,
            todo:{
                'content' : "",
                'title' : "",
                'id' : id(),
            },
        }
    },
    mounted(){
        $('#create_todo').modal({
             ready() {
                  document.getElementById('editor').focus();
             },
             complete() {
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
            if(this.todo.title == ""){
            Materialize.toast('<span class="error_toast">The title field is required.</span>',4500)
            }else if(this.todo.content == ""){
                  Materialize.toast('<span class="error_toast">The content field is required.</span>',4500)
            }else{
                let formData = new FormData(document.getElementById('formCreate'))
                // axios.post('/create-new-todo',this.$data)
                axios.post('/create-new-todo',formData)
                .then((response) => {
                    if(response.data.errors){
                        if(response.data.errors['title']){
                              Materialize.toast('<span class="error_toast">'+response.data.errors['title'][0]+'</span>',4500)
                        }
                        if(response.data.errors['content']){
                              Materialize.toast('<span class="error_toast">'+response.data.errors['content'][0]+'</span>',4500)
                        }
                        if(response.data.errors['image']){
                            Materialize.toast('<span class="error_toast">'+response.data.errors['image'][0]+'</span>',4500)
                        }
                    }else{
                          if(response.data.success){
                               $('#create_todo').modal('close');
                               Materialize.toast(response.data.success, 4500,'rounded');
                               this.$emit('create_todo',response.data.data)
                          }
                    }
                })
                .catch((error) => {
                    alert(error);
                    window.location.reload();
                })
            }
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
</style>
