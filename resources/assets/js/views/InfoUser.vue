<template lang="html">
    <div class="info_user" :style="styleBg">
    <!-- <div class="info_user" :style="{background:'url(/background/'+users.background+')'+'no-repeat center center'}"> -->
            <form id="change_bg" action="" method="post" class="right-align">
                 <div class="file-field btn">
                       <i class="material-icons">file_upload</i>
                       <input type="file" name="img_bg" @change="onFiles">
                 </div>
            </form>
           <img :src="bg_user" :alt="users.name" style="" v-if="test_image">
           <img :src="demo" alt="">
           <img :src="avatar" :alt="users.name" class="responsive-img">
           <div class="name_email">
                 <p>{{users.name}}</p>
                 <p>{{users.email}}</p>
           </div>
           <div class="social_icon">
                 <a :href="users.facebook" target="_blank" @click.prevent="fb"><i class="icon_facebook"></i></a>
                 <a :href="users.skype" target="_blank"><i class="icon_skype"></i></a>
                 <a :href="users.twitter" target="_blank"><i class="icon_twitter"></i></a>
           </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            users:[],
            bg_user:"",
            demo:"",
            test_image:false,
      //       styleBg: {
      //           background: 'red',
      //           backgroundSize: 'cover'
      //     },
        }
    },
    created(){
        axios.post('/infomation-user',{'id': id()})
        .then((response) => {
            this.users = response.data
        })
    },
    computed:{
        styleBg(){
            if(this.test_image == true){
                  console.log(this.bg_user);
                  return { background:this.bg_user+") center center no-repeat / cover"}
            }
            if(this.test_image == false){
                  return { background:"url(/background/"+this.users.background+") center center no-repeat / cover"}
            }
        },
        demo(){
                  return this.bg_user;
        },
        avatar(){
            return "/avatar/"+this.users.avatar
        }
    },
    methods:{
          fb(){

          },
          onFiles(e){
               this.test_image = true
              let files = e.target.files
              this.createImg(files[0]);
          },
          createImg(files){
                let reader = new FileReader()
                let bg_user = new Image()
                let self = this
                reader.onload = (e) => {
                      self.bg_user = e.target.result
                }
                reader.readAsDataURL(files)
          },
    }
}
</script>
<style lang="css">
</style>
