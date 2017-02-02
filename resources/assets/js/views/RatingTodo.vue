<template lang="html">
    <div class="card-action edit_todo">
         <a href="#progress" @click.prevent="progress"><i class="material-icons progress_todo">{{progress_icon}}</i></a>
         <a href="#favorite" @click.prevent="favorite"><i class="material-icons favorite_todo">{{favorite_icon}}</i></a>
         <input type="hidden" :value="rate.progress">
         <input type="hidden" :value="rate.favorite">
         <input type="checkbox" id="done" @click="done" :value="rate.done">
         <label for="done"></label>
         <p class="range-field rating_post">
             <input type="range" id="rating" min="0" max="25" :value="infoBlog.id" >
         </p>
         <!-- <p>{{infoBlog}}</p> -->
    </div>
</template>

<script>
export default {
    props:[
        'infoBlog'
    ],
    data(){
        return{
            rate:{
                  progress : 0,
                  favorite : 0,
                  done : 0,
            },
        }
    },
    computed:{
       progress_icon(){
            if(this.rate.progress){
                this.rate.progress = 1;
                return "alarm_on";
            }else{
                 this.rate.progress = 0;
                 return "alarm_off";
            }
       },
       favorite_icon(){
            if(this.rate.favorite){
                   this.rate.favorite = 1;
                   return "favorite";
            }else{
                  this.rate.favorite = 0;
                   return "favorite_border";
            }
       },
       // setInterval(() => {
       //     window.setTimeout(() => {
       //         console.log("ok");
       //     },2000)
       // })
    },
    methods:{
      progress(){
            this.rate.progress = ! this.rate.progress

      },
      favorite(){
            this.rate.favorite = ! this.rate.favorite

      },
      done(){
            if(this.rate.done == 0 ){
                  this.rate.done = 1;
                  Materialize.toast('Congratulation you had done todo !',2000,'rounded')
                  this.$emit('done');
            }else{
                  this.rate.done = 0;
                  this.$emit('done');
            }
      },
   }
}
</script>

<style lang="css">
</style>
