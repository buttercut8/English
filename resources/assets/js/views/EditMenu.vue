<template lang="html">
    <div class="menu_site">
          <div class="fixed-action-btn horizontal click-to-toggle">
                <a href="#" class="btn-floating btn-large bg_color" @click.prevent="show_menu">
                      <i class="large material-icons">{{event_menu}}</i>
                </a>
                <ul>
                      <!-- <li><a href="#create_todo" class="waves-effect btn-floating bg_color"><i class="material-icons">border_color</i></a></li> -->
                      <li><a class="waves-effect btn-floating bg_color" href="#edit_account"><i class="material-icons">settings</i></a></li>
                      <li><a class="waves-effect btn-floating bg_color" href="#edit_password"><i class="material-icons">lock</i></a></li>
                      <li><a href="logout" class="btn-floating bg_color"><i class="material-icons">power_settings_new</i></a></li>
                </ul>
          </div>
          <edit-pass></edit-pass>
          <edit-account :users="users" @update_account="edit_account"></edit-account>
          <!-- <create-todo :users="users"></create-todo> -->
    </div>
</template>

<script>

export default {
        data(){
              return{
                 users:[],
                 show:false,
              }
        },
        components:{
              'edit-pass' : require('./EditPass.vue'),
              'edit-account' : require('./EditAccount.vue'),
            //   'create-todo' : require('./CreateTodo.vue')
        },
        mounted(){
            // Get user
            // InfomationUser.all(users => this.users = users);
            axios.post('/infomation-user',{'id': id()})
            .then((response) => {
            this.users = response.data
            })
        },
        computed:{
              event_menu(){
                   if(this.show){
                         return "close"
                   }else{
                         return "menu"
                   }
              },
        },
        methods:{
           show_menu(){
                 this.show = ! this.show
           },
           edit_account(info_user){
            //    console.log(info_user);
            },
        },
}
</script>
