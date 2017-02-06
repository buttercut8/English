<template lang="html">
    <div class="">
        <input type="text" v-model="keyword">
        <div class="box" :style="{background : keyword}"></div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            keyword: "",

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
.box{
    width:150px;
    height:150px;
}
</style>
