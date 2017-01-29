<template lang="html">
    <div class="">
        <div class="card-action edit_todo">
             <a href="#"><i class="material-icons progress_todo">alarm_off</i></a>
             <!-- <a href="#"><i class="material-icons">alarm_on</i></a> -->
             <a href="#"><i class="material-icons favorite_todo">favorite_border</i></a>
             <!-- <a href="#"><i class="material-icons">favorite</i></a> -->
             <a href="#"><i class="material-icons favorite_todo">done_all</i></a>
             <p class="range-field rating_post">
                 <input type="range" id="rating" min="0" max="25" :value="idBlog" >
             </p>
        </div>
    </div>
</template>

<script>
export default {
    props:[
        'idBlog'
    ],
    data(){
        return{

        }
    }
}
</script>

<style lang="sass">
</style>
