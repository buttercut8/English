<template lang="html">
    <div id="edit_password" class="modal">
          <form action="" method="post" id="form_password" @submit.prevent="change_password">
                <i class="material-icons modal-action modal-close right">clear</i>
                <div class="modal-content change_pass">
                      <h4>Change Password</h4>
                      <div class="row">
                           <div class="input-field col s12  m12 l8 offset-l2">
                               <i class="material-icons" @click="change_attr1" >{{attr1.icon}}</i>
                               <input :type="attr1.type" name="passCurrent" class="validate" :value="attr1.value" @input="attr1.value = $event.target.value">
                                <label for="passCurrent">Password Current</label>
                               <transition name="slide-fade" mode="out-in">
                                   <p class="error_pass" v-if="attr1.error" v-text="attr1.error"></p>
                               </transition>
                           </div>
                           <div class="input-field col s12 m12 l8 offset-l2">
                               <i class="material-icons" @click="change_attr2">{{attr2.icon}}</i>
                               <input :type="attr2.type" name="passNew" class="validate" :value="attr2.value" @input="attr2.value = $event.target.value">
                                <label for="passNew">Password New</label>
                               <transition name="slide-fade" mode="out-in">
                                   <p class="error_pass" v-if="attr2.error" v-text="attr2.error"></p>
                               </transition>
                           </div>
                           <div class="input-field col s12 m12 l8 offset-l2">
                               <i class="material-icons" @click="change_attr3">{{attr3.icon}}</i>
                               <input :type="attr3.type" name="passConfirm" class="validate" :value="attr3.value" @input="attr3.value = $event.target.value">
                                <label for="passConfirm">Re-type Password New</label>
                               <transition name="slide-fade" mode="out-in">
                                   <p class="error_pass" v-if="attr3.error" v-text="attr3.error"></p>
                               </transition>
                           </div>
                      </div>
                </div>
                <div class="modal-footer center-align">
                      <button type="submit" class="btn waves-effect waves-light">
                            Agree<i class="material-icons right">done</i>
                      </button>
                </div>
          </form>
    </div>
</template>
<script>
export default {
    data(){
          return{
              attr1: {
                  icon: "lock_outline",
                  type: "password",
                  value: "",
                  error: "",
              },
              attr2: {
                  icon: "lock_outline",
                  type: "password",
                  value: "",
                  error: "",
              },
              attr3: {
                  icon: "lock_outline",
                  type: "password",
                  value: "",
                  error: "",
              },
          }
    },
    mounted(){
        $('#edit_password').modal();
    },
    methods:{
        change_attr1(){
            if(this.attr1.type == "password"){
                  this.attr1.type = "text"
                  this.attr1.icon = "lock_open"

            }else{
                  this.attr1.type = "password"
                  this.attr1.icon = "lock_outline"
            }
        },
        change_attr2(){
            if(this.attr2.type == "password"){
                  this.attr2.type = "text"
                  this.attr2.icon = "lock_open"

            }else{
                  this.attr2.type = "password"
                  this.attr2.icon = "lock_outline"
            }
        },
        change_attr3(){
            if(this.attr3.type == "password"){
                  this.attr3.type = "text"
                  this.attr3.icon = "lock_open"

            }else{
                  this.attr3.type = "password"
                  this.attr3.icon = "lock_outline"
            }
        },
        change_password(){
            let vm = this
            if(this.attr1.value.trim() == ""){
                this.attr1.error = true
                this.attr1.error = "The password current field is required."
                document.getElementsByName('passCurrent')[0].classList.add("invalid")
                setTimeout(function(){
                    vm.attr1.error = false
                },3000)
            }else if(this.attr2.value.trim() == ""){
                this.attr2.error = true
                this.attr2.error = "The password current field is required."
                document.getElementsByName('passNew')[0].classList.add("invalid")
                setTimeout(function(){
                    vm.attr2.error = false
                },3000)
            }else if(this.attr3.value.trim() == ""){
                this.attr3.error = true
                this.attr3.error = "The password current field is required."
                document.getElementsByName('passConfirm')[0].classList.add("invalid")
                setTimeout(function(){
                    vm.attr3.error = false
                },3000)
            }else{
                let form = document.getElementById('form_password')
                let data = new FormData(form)
                data.append('id',id())
                axios.post('/edit-password',data)
                .then((response) => {
                    if(response.data['message']){
                        $('#edit_password').modal('close');
                       Materialize.toast(response.data['message'],3000,'rounded',function(){
                            if(confirm(response.data['confirm']) == true){
                                  axios.get('/logout').then((response)=>{
                                      return ""
                                  })
                                  window.location.href = response.data['url']
                            }else{
                                  vm.attr1.value =  ""
                                  vm.attr2.value =  ""
                                  vm.attr3.value =  ""
                            }
                       })
                }else if(response.data.error_pass){
                        vm.attr3.error  = true
                        vm.attr3.error = response.data.error_pass
                        setTimeout(function(){
                            vm.attr3.error = false
                        },5000)
                    }else if(response.data.errors['passCurrent']){
                        vm.attr1.error = true
                        vm.attr1.error = response.data.errors['passCurrent'][0]
                        document.getElementsByName('passCurrent')[0].classList.add("invalid")
                        setTimeout(function(){
                            vm.attr1.error = false
                        },3000)
                    }else if(response.data.errors['passNew']){
                        vm.attr2.error  = true
                        vm.attr2.error = response.data.errors['passNew'][0]
                        document.getElementsByName('passNew')[0].classList.add("invalid")
                        setTimeout(function(){
                            vm.attr2.error = false
                        },5000)
                    }else if(response.data.errors['passConfirm']){
                        vm.attr3.error  = true
                        vm.attr3.error = response.data.errors['passConfirm'][0]
                        document.getElementsByName('passConfirm')[0].classList.add("invalid")
                        setTimeout(function(){
                            vm.attr3.error = false
                        },5000)
                    }
                })
                .catch((error) => {
                   alert('Handing Error !!!' + error);
                    window.location.reload(true);
                })
            }
        }
    }

}
</script>
<style lang="css">

</style>
