<template lang="html">
    <div id="edit_account" class="modal modal-fixed-footer edit_account">
         <form id="formAccount" action="" method="post" @submit.prevent="update_account(users.id)" enctype="multipart/form-data">
               <div class="modal-content">
                 <h4>Update Profile</h4>
                 <div class="row">
                     <input type="hidden" name="id" :value="users.id">
                      <div class="file-field input-field col s12 m12 l6">
                          <div class="btn bg_color upload_i">
                                <i class="material-icons">file_upload</i>
                               <input type="file" name="avatar" @change="onFiles">
                          </div>
                          <div class="file-path-wrapper">
                               <input type="text" class="file-path validate">
                          </div>
                          <transition name="slide-fade" mode="out-in">
                              <p v-if="errors.avatar" class="center error_update">{{notice.avatar}}</p>
                          </transition>
                        </div>
                        <div class="col s12 m12 l6 avatar_upload">
                            <img :src="image" :alt="users.name" class="circle responsive-img" v-if="test_image">
                            <img :src="'public/avatar/'+users.avatar" :alt="users.name" class="circle responsive-img" v-else>
                        </div>
                       <div class="input-field col s12 m12 l6">
                             <i class="prefix material-icons">account_box</i>
                             <input type="text" id="name" name="name" v-model.trim="users.name" class="validate" placeholder="" maxlength="60" length="60">
                             <label for="name">Full Name</label>
                             <transition name="slide-fade" mode="out-in">
                                 <p v-if="errors.name" class="center error_update">{{notice.name}}</p>
                             </transition>
                       </div>
                       <div class="input-field col s12 m12 l6">
                             <i class="prefix material-icons">contact_mail</i>
                             <input type="email" id="email" name="email" v-model.trim="users.email" class="validate" placeholder="" maxlength="60" length="60">
                             <label for="email">Email Adress</label>
                             <transition name="slide-fade" mode="out-in">
                                 <p v-if="errors.email" class="center error_update">{{notice.email}}</p>
                             </transition>
                       </div>
                       <div class="input-field col s12 m12 l6">
                             <i class="prefix material-icons">phone</i>
                             <input type="text" id="phone" name="phone" v-model.trim="users.phone" class="validate" placeholder="" @keyup="validate_phone" maxlength="12">
                             <label for="phone">Phone Number</label>
                             <transition name="slide-fade" mode="out-in">
                                 <p v-if="errors.phone" class="center error_update">{{notice.phone}}</p>
                             </transition>
                       </div>
                       <div class="input-field col s12 m12 l6">
                             <i class="prefix facebook-icon"></i>
                             <input type="text" id="facebook" name="facebook" v-model.trim="users.facebook" class="validate" placeholder="" maxlength="100" length="100">
                             <label for="facebook">Link Facebook</label>
                       </div>
                       <div class="input-field col s12 m12 l6">
                             <i class="prefix skype-icon"></i>
                             <input type="text" id="skype" name="skype" v-model.trim="users.skype" class="validate" placeholder="" maxlength="100" length="100">
                             <label for="skype">Link Skype</label>
                       </div>
                       <div class="input-field col s12 m12 l6">
                             <i class="prefix twitter-icon"></i>
                             <input type="text" id="twitter" name="twitter" v-model.trim="users.twitter" class="validate" placeholder="" maxlength="100" length="100">
                             <label for="twitter">Link Twitter</label>
                       </div>
                       <div class="input-field col s12 m12 l8 offset-l2">
                             <i class="prefix material-icons icon_edit">mode_edit</i>
                             <textarea id="about_me" name="about_me" class="materialize-textarea validate" v-model.trim="users.about_me" placeholder="" maxlength="255" length="255"></textarea>
                             <label for="about_me">About Me</label>
                       </div>
                 </div>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn-flat waves-effect waves-light modal-action modal-close">
                          Cancel
                    </button>
                    <button type="submit" class="btn waves-effect waves-light" :disabled="test">
                          Save Changes
                    </button>
              </div>
         </form>
    </div>
</template>

<script>
export default {
    props:[
        'users',
        'users2'
    ],
    data(){
        return {
            image:"",
            test_image:false,
            errors:{
                name:false,
                email:false,
                phone:false,
                avatar:false
            },
            notice:{
                name:"",
                email:"",
                phone:"",
                avatar:""
            },
            test:false,
        }
    },
    mounted(){
        // setInterval(() => {
        //     window.setTimeout(() => {
        //         console.log("ok");
        //     },2000)
        // })
        $('#name,#email,#facebook,#twitter,#skype,#about_me').characterCounter();
        $('#edit_account').modal();
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
        validate_phone(){
            let regex = /^[\(\)\s\-\+\d]{10,12}$/;
            if(regex.test(this.users.phone) == false){
                    this.errors.phone = true
                    this.notice.phone = "The phone format is invalid."
                    document.getElementsByName('phone')[0].classList.add("invalid")
                    this.test = true
            }else{
                this.errors.phone = false
                this.test = false
            }
        },
        update_account(){
            let vm = this
            if(this.users.name == ""){
                this.errors.name = true
                this.notice.name = "The name field is required."
                document.getElementById('name').classList.add("invalid")
                window.setTimeout(() =>{
                    vm.errors.name = false
                },4500)
            }else if(this.users.email == ""){
                this.errors.email = true
                this.notice.email = "The email field is required."
                document.getElementsByName('email')[0].classList.add("invalid")
                window.setTimeout(() =>{
                    vm.errors.email = false
                },4500)
            }else if(this.users.phone == ""){
                this.errors.phone = true
                this.notice.phone = "The phone field is required."
                document.getElementsByName('phone')[0].classList.add("invalid")
                window.setTimeout(() =>{
                    vm.errors.phone = false
                },4500)
            }else{
                let form =  document.getElementById('formAccount')
                let formData = new FormData(form)
                axios.post('/update-account',formData)
                .then((response) => {
                    if(response.data.success){
                       $('#edit_account').modal('close');
                       Materialize.toast(response.data.success, 3500, 'rounded')
                       let data_user = {
                           'name' : response.data.name,
                           'email' : response.data.email,
                           'avatar' : response.data.avatar
                       };
                       this.$emit('update_account',data_user)
                   }else{
                       if(response.data.errors.name){
                           this.errors.name = true
                           this.notice.name = response.data.errors.name[0]
                           document.getElementById('name').classList.add("invalid")
                           window.setTimeout(() =>{
                               vm.errors.name = false
                           },4500)
                       }else if(response.data.errors.email){
                           this.errors.email = true
                           this.notice.email = response.data.errors.email[0]
                           document.getElementsByName('email')[0].classList.add("invalid")
                           window.setTimeout(() =>{
                              vm.errors.email = false
                           },4500)
                       }else if(response.data.errors.phone){
                           this.errors.phone = true
                           this.notice.phone = response.data.errors.phone[0]
                           document.getElementsByName('phone')[0].classList.add("invalid")
                           window.setTimeout(() =>{
                               vm.errors.phone = false
                           },4500)
                       }else if(response.data.errors.avatar){
                           this.errors.avatar = true
                           this.notice.avatar = response.data.errors.avatar[0]
                           window.setTimeout(() =>{
                               vm.errors.avatar = false
                           },4500)
                       }
                   }
                })
                .catch((error) =>{
                    alert(error);
                    window.location.reload();
                })
            }
        },
    }
}
</script>
<style lang="css">
.error_update{
    color: #fe4f4f;
    font-weight: 500;
    margin: 0px;
    line-height: 0px;
    padding: 0px;
}
</style>
