<template lang="html">
    <div class="col m12">
        <div class="card">
            <div class="card-content">
                <h2 class="center-align title_page">{{title}}</h2>
                <div class="row">
                    <div class="col s12 m6">
                        <div class="input-field">
                            <i class="prefix material-icons">person</i>
                            <input type="text" id="name_member" name="name" v-model.trim="member.name" length="60" maxlength="60">
                            <label for="name_member">Name</label>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="input-field">
                            <i class="prefix material-icons">phone</i>
                            <input type="text" name="phone" id="phone_member" v-model.trim="member.phone" length="12" maxlength="12">
                            <label for="phone_member">Phone</label>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="input-field">
                            <i class="prefix material-icons">mail</i>
                            <input type="text" name="email" id="email_member" v-model.trim="member.email" length="60" maxlength="60">
                            <label for="email_member">Email</label>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="input-field">
                            <i class="prefix material-icons">lock</i>
                            <input type="password" id="pass_member" name="password" v-model.trim="member.password">
                            <label for="pass_member">Password</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-action right-align">
                <button type="button" @click="addMember" class="btn bg_color waves-effect waves-light">add new<i class="material-icons right">add</i></button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            title:"Add New Member",
            member:{
                name : "",
                phone : "",
                email : "",
                password : "",
            },
        }
    },
    methods:{
        addMember(){
            axios.post('/add-member',this.member)
            .then((response) => {
                if(response.data.errors){
                    Materialize.toast('<span class="error_toast">'+response.data.errors+'</span>','4000');
                }else{
                    Materialize.toast(response.data.success,'3000','rounded');
                    this.member.name = "";
                    this.member.phone = "";
                    this.member.email = "";
                    this.member.password = "";
                }
            })
            .catch((error)=>{
                alert(error);
                window.location.reload();
            })
        }
    }
}
</script>

<style lang="css">
</style>
