<template lang="html">
    <div id="app" class="login">
        <div class="login_english"></div>
        <div class="login_bg">
            <div class="container">
                <section class="section">
                    <div class="row">
                        <div class="col s12 m6 l6 offset-l3 form-login">
                            <div class="row">
                                <h3 class="center">Sign In</h3>
                                <div class="col m12 input-field">
                                    <i class="material-icons prefix">account_box</i>
                                    <input type="text" name="email" id="email" class="validate" v-model="email" @keyup.enter="login">
                                    <label for="email">Email</label>
                                    <transition name="slide-fade">
                                        <p v-if="error_login" v-text="notice"></p>
                                    </transition>
                                </div>
                                <div class="col m12 input-field">
                                    <i class="material-icons prefix">lock</i>
                                    <input type="password" name="password" id="password" class="validate" v-model="password" @keyup.enter="login">
                                    <label for="password">Password</label>
                                    <transition name="slide-fade">
                                        <p v-if="error_login2" v-text="notice2"></p>
                                    </transition>
                                </div>
                                <div class="col m12 input-field remember">
                                    <input type="checkbox" v-model="remember" id="remember" class="filled-in">
                                    <label for="remember">Remember me</label>
                                </div>
                                <div class="col m12 center">
                                    <button type="button" id="login" class="btn waves-effect waves-light bg_color white-text" @click="login">Login</button>
                                </div>
                                <div class="col m12 center load_login" v-if="load_login">
                                    <div class="preloader-wrapper active">
                                      <div class="spinner-layer spinner-green-only">
                                        <div class="circle-clipper left">
                                          <div class="circle"></div>
                                        </div><div class="gap-patch">
                                          <div class="circle"></div>
                                        </div><div class="circle-clipper right">
                                          <div class="circle"></div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>
<script>
var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
export default {
    data(){
        return {
            email: "",
            password: "",
            remember: "",
            error_login: false,
            error_login2: false,
            notice: "",
            notice2: "",
            load_login: false,
        }
    },
    methods:{
        login(){
            let sending = false
            let vm = this
            if(this.email.trim() == ""){
                this.notice = "The email field is required."
                this.error_login = true
                document.getElementById('email').classList.add("invalid")
                setTimeout(function(){
                    vm.error_login = false
                    document.getElementById('email').classList.remove("invalid")
                },4500)
            }else if(!emailRE.test(this.email)){
                this.notice = "Please provide a valid email address !"
                this.error_login = true
                document.getElementById('email').classList.add("invalid")
                setTimeout(function(){
                    vm.error_login = false
                    document.getElementById('email').classList.remove("invalid")
                },4500)
            }else if(this.password.trim() == ""){
                this.notice2 = "The password field is required."
                this.error_login2 = true
                document.getElementById('password').classList.add("invalid")
                setTimeout(function(){
                    vm.error_login2 = false
                    document.getElementById('password').classList.remove("invalid")
                },4500)
            }
            else{
                let data = {
                    'email' : this.email,
                    'password' : this.password,
                    'remember' : this.remember
                }
                axios.post('/login',data)
                .then(function (response) {
                    if(response.data['login']){
                        vm.load_login = true
                        window.setTimeout(() => {
                            window.location.href = response.data.login
                        },700)
                    }else if(response.data['error_login']){
                        vm.notice2 = response.data['error_login']
                        vm.error_login2 = true
                        setTimeout(() => {
                            vm.error_login2 = false
                        },4500)
                    }else if(response.data.errors['email'] && response.data.errors['email'][0] == "The email field is required."){
                        vm.notice = response.data.errors['email'][0]
                        vm.error_login = true
                        document.getElementById('email').classList.add("invalid")
                        setTimeout(() => {
                            vm.error_login = false
                            document.getElementById('email').classList.remove("invalid")
                        },4500)
                    }else if (response.data.errors['email'] && response.data.errors['email'][0] == "The email must be a valid email address."){
                        vm.notice = response.data.errors['email'][0]
                        vm.error_login = true
                        document.getElementById('email').classList.add("invalid")
                        setTimeout(() => {
                            vm.error_login = false
                            document.getElementById('email').classList.remove("invalid")
                        },4500)
                    }else if(response.data.errors['password']){
                        vm.notice2 = response.data.errors['password'][0]
                        vm.error_login2 = true
                        document.getElementById('password').classList.add("invalid")
                        setTimeout(function(){
                            vm.error_login2 = false
                            document.getElementById('password').classList.remove("invalid")
                        },4500)
                    }
                })
                .catch(function (error) {
                    alert('Handing Error !!!' + error);
                    window.location.reload(true);
                })
            }
        },
    }
}
</script>
<style lang="css">
.load_login{
    margin-top:20px;
}
</style>
