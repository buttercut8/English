<template lang="html">
      <div class="">
            <form id="upload_bg" action="" method="post" enctype="multipart/form-data">
                  <img :src="bg_update" :alt="users.name" class="background_user" v-if="test_image">
                  <img :src="'public/background/'+this.users.background" :alt="users.name" class="background_user" v-else>
                  <input type="hidden" name="id" :value="users.id">
            <!-- <div class="info_user" :style="styleBg"> -->
                  <div class="info_user">
                          <div class="change_bg right-align">
                              <div class="file-field btn">
                                    <i class="material-icons">file_upload</i>
                                    <input type="file" name="image" @change="onFiles">
                              </div>
                          </div>
                         <img :src="avatar" :alt="users.name" class="responsive-img">
                         <div class="name_email">
                              <p>{{users.name}}</p>
                              <p>{{users.email}}</p>
                         </div>
                         <div class="social_icon">
                              <a :href="users.facebook" target="_blank"><i class="icon_facebook"></i></a>
                              <a :href="users.skype" target="_blank"><i class="icon_skype"></i></a>
                              <a :href="users.twitter" target="_blank"><i class="icon_twitter"></i></a>
                         </div>
                  </div>
            </form>
      </div>
</template>

<script>
export default {
    data(){
        return{
            users:[],
            bg_update:"",
            test_image:false,
        }
    },
    mounted(){
        axios.post('/infomation-user',{'id': id()})
        .then((response) => {
            this.users = response.data
        })
    },
    computed:{
      //   styleBg(){
      //        return { background:"url(/background/"+this.users.background+") center center no-repeat / cover"}
      //   },
        avatar(){
            return "public/avatar/"+this.users.avatar
        }
    },
    methods:{
          onFiles(e){
              let bg = new FormData(document.getElementById('upload_bg'));
              axios.post('update-background',bg)
              .then((response) => {
                  if (response.data.errors) {
                        Materialize.toast('<span class="error_toast">'+response.data.errors+'</span>',4000)
                  }else{
                        this.test_image = true
                        let files = e.target.files
                        this.createImg(files[0]);
                        Materialize.toast(response.data.success,4000,'rounded')
                  }
              })
              .catch((error) => {
                    alert(error)
                    window.location.reload();
              })
          },
          createImg(files){
                let reader = new FileReader()
                let bg_update = new Image()
                let self = this
                reader.onload = (e) => {
                      self.bg_update = e.target.result
                }
                reader.readAsDataURL(files)
          },
    }
}
</script>
<style lang="css">
</style>
