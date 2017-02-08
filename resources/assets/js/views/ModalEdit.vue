<template lang="html">
    <div id="edit-todo" class="modal modal-fixed-footer create_todo">
         <form id="formEdit" action="" method="post" enctype="multipart/form-data" @submit.prevent="editTodo">
               <div class="modal-content">
                 <h4>Edit Todo</h4>
                 <div class="row">
                    <input type="hidden" name="id_edit" :value="infoBlog.id">
                    <div class="col l8 offset-l2 input-field">
                    <input type="text" name="title_edit" id="title" class="validate" length="80" maxlength="80" v-model.trim="infoBlog.title" placeholder="">
                        <label for="title">Title Todo</label>
                    </div>
                    <div class="file-field input-field col s12 m12 l6 offset-l2">
                        <div class="upload_image">
                                <i class="material-icons">camera_alt</i>
                               <input type="file" name="image" @change="onFiles">
                        </div>
                        <div class="file-path-wrapper">
                               <input type="text" class="file-path validate" placeholder="Image update">
                        </div>
                    </div>
                    <div class="col s12 m12 l4 image_upload center">
                            <img :src="image" class="responsive-img" v-if="test_image">
                            <img :src="'public/blog/'+image" class="responsive-img" v-else>
                    </div>
                    <div class="col l10 offset-l1">
                        <textarea name="content_edit" id="editor_edit" v-model.trim="infoBlog.content"></textarea>
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
export default {
    props:[
        'infoBlog',
        'image'
    ],
    data(){
        return {
            test:false,
            test_image:false,
        }
    },
    mounted(){
        $('#edit-todo').modal();
    },
    updated(){
        let self = this
        tinymce.init({
          selector: '#editor_edit',
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
          setup: function(editor_edit) {
                editor_edit.on('keyup', function(e) {
                  let new_value = tinymce.get('editor_edit').getContent(self.value);
                    self.infoBlog.content = new_value;
                });
            }
         });
    },
    methods:{
        onFiles(e){
            this.test_image = true
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
        editTodo(){
            let self = this
            if(this.infoBlog.title == ""){
                Materialize.toast("<span class='error_toast'>The title field is required.</span>", 4500);
            }else if(this.infoBlog.content == ""){
                Materialize.toast("<span class='error_toast'>The content field is required.</span>", 4500);
            }else{
                let formData = new FormData(document.getElementById('formEdit'))
                axios.post('/edit-todo',formData)
                .then((response) => {
                    if(response.data.errors){
                        if(response.data.errors['title_edit']){
                            Materialize.toast("<span class='error_toast'>"+response.data.errors['title_edit'][0]+"</span>", 4500);
                        }
                        if(response.data.errors['content_edit']){
                            Materialize.toast("<span class='error_toast'>"+response.data.errors['content_edit'][0]+"</span>", 4500);
                        }
                        if(response.data.errors['image']){
                            Materialize.toast("<span class='error_toast'>"+response.data.errors['image'][0]+"</span>", 4500);
                        }
                    }else{
                        $('#edit-todo').modal('close');
                        Materialize.toast(response.data.success, 4000,'rounded');
                    }
                })
                .catch((error) => {
                    alert(error);
                    window.location.reload();
                })
            }
        }
    }
}
</script>
<style lang="css">
    .image_upload{
        width: 220px !important;
        height: 140px;
        margin-top: -15px;
    }
</style>
