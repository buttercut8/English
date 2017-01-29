<template lang="html">
    <div class="">
        <div class="info_user" :style="img_bg">
        <!-- <div class="info_user" :style="{background:'url(/background/'+users.background+')'+'no-repeat center center'}"> -->
              <div class="bg_user">
                    <div class="btn">
                          <i class="material-icons">file_upload</i>
                          <!-- <input type="file"> -->
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
    </div>.
</template>

<script>
export default {
    // props:[
    //     'users'
    // ],
    data(){
        return{
            users:[],
        }
    },
    created(){
        axios.post('/infomation-user',{'id': id()})
        .then((response) => {
        this.users = response.data
        })
    },
    // updated(){
    //     var url = window.location.origin+"/background/"
    //     var bg = this.users.background
    //     var img = url+bg
    // },
    computed:{
        img_bg(){
            return { background:"url(/background/"+this.users.background+")" + "no-repeat center center" }
        },
        avatar(){
            return "/avatar/"+this.users.avatar
        }
    },
    methods:{
        
    }
}
</script>
<style lang="css">
</style>
