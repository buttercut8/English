<template lang="html">
    <div class="card-content">
        <div class="all_feedback" id="all_feedback">
            <transition-group name="custom_transition" enter-active-class="animated zoomIn" leave-active-class="animated fadeOutUp" mode="in-out">
                <span v-for="info in feedback" :key="info" v-if="info.id_blog == idBlog">
                    <p v-html="info.message"></p>
                    <p class="time_feedback">{{postedOn(info)}}</p>
                    <!-- <div class="chip bg_color white-text"> -->
                    <div class="chip white-text" :class="color_chip">
                        <img :src="'public/avatar/'+info.avatar" :alt="info.name">
                        {{info.name}}
                        <span v-if="id == info.id">
                            <!-- <a href="#"><i class="material-icons edit_cm">create</i></a> -->
                            <a href="#" @click.prevent="removeFeedback(info)"><i class="material-icons delete_cm red-text text-accent-2">close</i></a>
                        </span>
                    </div>
                </span>
            </transition-group>
        </div>
        <div class="input-field feedback">
            <i class="material-icons prefix" @click="addFeedback2">send</i>
            <textarea placeholder="Enter feedback ...." v-model="infomation.message" @keydown.enter="addFeedback" class="materialize-textarea"></textarea>
        </div>
    </div>
</template>
<script>
import moment from "moment";
let db = Firebase.database();
let feedbackRef = db.ref('feedback');
export default {
    firebase: {
        feedback: feedbackRef.limitToLast(6)
        // feedback: feedbackRef
    },
    props:[
        'idBlog',
    ],
    data(){
        return{
            infomation:{
                name: "",
                message: "",
                avatar: "",
                id:"",
                id_blog:this.idBlog,
                time:"",
            },
            id:id(),
        }
    },
    computed:{
        color_chip(){
            if(this.idBlog % 2 == 0){
                return "bg_color";
            }else{
                return "blue darken-2";
            }
        }
    },
    mounted(){
        axios.post('/infomation-user',{'id': id()})
        .then((response) => {
            this.infomation.name = response.data.name
            this.infomation.avatar = response.data.avatar
            this.infomation.id = response.data.id
        })
    },
    updated(){
        let feedback = document.getElementById('all_feedback');
        feedback.scrollTop = feedback.scrollHeight
    },
    methods:{
         postedOn(feedback){
              return moment(feedback.time).fromNow()
         },
        addFeedback(e){
            if(e.keyCode == 13 && !e.shiftKey){
                e.preventDefault;
                this.submitFeedback();
            }
        },
        addFeedback2(){
            this.submitFeedback();
        },
        submitFeedback(){
            this.infomation.time = Date.now();
            feedbackRef.push(this.infomation);
            this.infomation.message = "";
            let feedback = document.getElementById('all_feedback');
            feedback.scrollTop = feedback.scrollHeight
        },
        removeFeedback(feedback){
          feedbackRef.child(feedback['.key']).remove()
        }

    }
}
</script>
<style lang="css">
</style>
