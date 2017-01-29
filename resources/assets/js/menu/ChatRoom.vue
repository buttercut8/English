<template lang="html">
    <div class="">
        <h2>{{message}}</h2>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </div>
</template>

<script>
export default {
    data(){
        return {
            message: "Hello World !"
        }
    },
    // beforeRouteLeave(route, redirect, next){
    //     if(window.confirm('Do you wanna leave page ?')){
    //         next()
    //     }
    // },
    // beforeRouteEnter (router, redirect, next){
    //     window.setTimeout(() => {
    //         next(vm =>{
    //             vm.message = "This is demo beforeRouteEnter !"
    //         })
    //     },2000)
    // }
}
</script>

<style lang="css">
</style>
