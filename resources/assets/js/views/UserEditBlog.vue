<template lang="html">
    <div class="">
        <span class="card-title user_edit">
            <a href="#edit"><i class="material-icons" @click="edit_blog">create</i></a>
            <a href="#delete"><i class="material-icons" @click="delete_blog" >delete_forever</i></a>
            <a href="#delete">{{idBlog}}</a>
        </span>
    </div>
</template>

<script>
export default {
    props:{
        idBlog:{type:Number, default:'0'},
    },
    data(){
        return{

        }
    },
    methods:{
        delete_blog(){
            // console.log(this.$parent.$data)
            this.$emit('delete')
            // this.$emit('delete')
        },
        edit_blog(){

        }
    }
}
</script>

<style lang="sass">


</style>
