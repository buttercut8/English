<template lang="html">
    <div class="">
        <h2 class="title_page">Todo List</h2>
        <div id="all_todo" class="col s12 m12 l12" v-for="(listTodo,index) in listTodos">
                <p>{{listTodo.user}}</p>
                <div class="col m2 time_todo">
                <div class="decorate"></div>
                <div class="decorate_first"></div>
                <div class="decorate_shadow1"></div>
                <div class="decorate_shadow2"></div>
                <div class="decorate_last">
                    <p class="month">{{postedMonth(listTodo)}}</p>
                </div>
                <div class="calendar_todo">
                    <p class="day">{{postedDay(listTodo)}}</p>
                    <p class="time">{{postedTime(listTodo)}}</p>
                </div>
            </div>

            <div class="col m7 list_todo">
                <div class="card hoverable">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img :src="'blog/'+listTodo.images" :alt="listTodo.title" class="activator">
                        <user-edit-blog v-if="id == listTodo.user.id" :idBlog="listTodo.id" @delete="close_blog"></user-edit-blog>
                    </div>
                    <div class="card-content">
                        <span class="card-title activator truncate">{{listTodo.title}}</span>
                        <!-- <p class="truncate" v-text="listTodo.content"></p> -->
                    </div>
                    <rating-blog :idBlog="listTodo.id"></rating-blog>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4 center">
                            {{listTodo.title}}
                            <i class="material-icons right">close</i>
                        </span>
                        <p v-html="listTodo.content"></p>
                    </div>
                </div>
            </div>
            <!-- feedback -->
            <div class="col m3">
                <div class="card-titles">
                    <h5 class="center blue-grey-text text-darken-2">Feedback- {{listTodo.id}}</h5>
                </div>
                <div class="card-content">
                    <p>Bạn làm tốt lắm nhưng cần khắc phục 1 số lỗi phát âm như phâm a , e , oe, chúc bạn năm mới phát tài thành công, cố gắng học hàng tốt hơn .</p>
                    <div class="chip">
                        <img :src="'avatar/'+listTodo.user.avatar" :alt="listTodo.user.name">
                        {{listTodo.user.name}}
                    </div>
                    <p>Mình cám ơn bạn rất nhiều bạn cũng vậy nhé ! Happy new years and good luck everthings .</p>
                    <div class="chip">
                        <img :src="'avatar/'+listTodo.user.avatar" :alt="listTodo.user.name">
                        {{listTodo.user.name}}
                        <a href="#"><i class="material-icons edit_cm">create</i></a>
                        <a href="#"><i class="material-icons delete_cm">close</i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- loadding -->
        <div class="col l12 center-align" v-show="showMore">
            <button type="button" class="loadding" @click="loadMore">Load more</button>
        </div>
        <div class="center" v-if="loaddingTodo">
            <div class="preloader-wrapper small active">
               <div class="spinner-layer pinner-green-only">
                     <div class="circle-clipper left">
                       <div class="circle"></div>
                     </div>
                     <div class="gap-patch">
                         <div class="circle"></div>
                     </div>
                     <div class="circle-clipper right">
                       <div class="circle"></div>
                     </div>
               </div>
             </div>
        </div>
    </div>
</template>
<script>
// import ListTodo from "../model/ListTodo";
import moment from "moment";
export default {
    data(){
        return {
            listTodos : [],
            imageTodo:[],
            showMore:false,
            loaddingTodo:false,
            stopped:false,
            id:id(),
        }
    },
    // beforeRouteEnter (router, redirect, next){
    //     window.setTimeout(() => {
    //         next(vm =>{
    //         })
    //     },2000)
    // },
    components:{
          'rating-blog' : require('../views/RatingBlog.vue'),
          'user-edit-blog' : require('../views/UserEditBlog.vue'),
    },
    created(){
        // ListTodo.all(listTodos => this.listTodos = listTodos);
        axios.get('/list-todo')
        .then((response) => {
            if(response.data.length >= 1){
                this.listTodos = response.data
            }else{
                alert("Not todo list !")
            }
        })
    },
    mounted(){
        window.onscroll = function (){
            let scroll = document.body.scrollTop
            let all_height =  document.body.clientHeight
            let height = window.innerHeight
            if((scroll + 50) > (all_height - height)){
                document.querySelector('.loadding').click();
            }
        }
    },
    methods:{
        postedOn(todo){
            return moment(todo.created_at).fromNow()
        },
        postedMonth(todo){
            return moment(todo.created_at).format("MMMM")
        },
        postedTime(todo){
            return moment(todo.created_at).format("HH:mm A")
        },
        postedDay(todo){
            return moment(todo.created_at).format("Do")
        },
        loadMore(){
            let vm = this
            let current_todo = this.listTodos.length
            if (this.loaddingTodo == true){
                return false
            }
            if (this.stopped == true){
                return false
            }
            this.loaddingTodo = true
            axios.post('/pagination-list-todo',{'current_todo' : current_todo})
            .then((response) => {
                setTimeout(function(){
                    if(response.data.last){
                        vm.listTodos = vm.listTodos.concat(response.data.last)
                        vm.loaddingTodo = false
                        vm.stopped = true

                    }else{
                        vm.listTodos = vm.listTodos.concat(response.data)
                        vm.loaddingTodo = false
                    }
                },800)
            })
            .catch((error) => {
                alert(error)
            })
        },
        close_blog(){
            console.log("ok");
        }
    }
}
</script>
<style lang="css">

</style>
