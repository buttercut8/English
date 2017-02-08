<template lang="html">
    <div class="">
        <a href="#create_todo" class="waves-effect btn-floating bg_color btn_create_todo"><i class="material-icons">border_color</i></a>
        <h2 class="title_page">Todo List</h2>
        <modal-edit :infoBlog="infoBlog" :image="image"></modal-edit>
        <create-todo @create_todo="create_new_todo"></create-todo>

        <transition-group name="slide-fade" mode="out-in">
        <div id="all_todo" class="col s12 m12 l12" v-for="(listTodo,key) in listTodos" :key="listTodo">
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
                        <img :src="'public/blog/'+listTodo.images" :alt="listTodo.title" class="activator">
                        <delete-edit-todo
                            v-if="id == listTodo.user.id"
                            :idBlog="listTodo.id"
                            @delete="close_blog(key)"
                            @edit="edit_blog(listTodo)">
                        </delete-edit-todo>
                    </div>
                    <div class="card-content">
                        <span class="card-title activator truncate">{{listTodo.title}}</span>
                        <!-- <p class="truncate" v-text="listTodo.content"></p> -->
                    </div>
                    <rating-todo
                        :infoBlog="listTodo"
                        @done="done_todo(key)"
                    ></rating-todo>
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
                    <h5 class="center blue-grey-text text-darken-2">Feedback</h5>
                </div>
                <feedback :idBlog="listTodo.id"></feedback>
            </div>
        </div>
        </transition-group>
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
            showMore:false,
            loaddingTodo:false,
            stopped:false,
            id:id(),
            infoBlog : "",
            image : "",
        }
    },
    // beforeRouteEnter (router, redirect, next){
    //     window.setTimeout(() => {
    //         next(vm =>{
    //         })
    //     },2000)
    // },
    components:{
          'rating-todo' : require('../views/RatingTodo.vue'),
          'delete-edit-todo' : require('../views/DeleteEditTodo.vue'),
          'modal-edit' : require('../views/ModalEdit.vue'),
          'create-todo' : require('../views/CreateTodo.vue'),
          'feedback' : require('../views/FeedBack.vue'),
    },
    created(){
        // ListTodo.all(listTodos => this.listTodos = listTodos);
        axios.post('/list-todo')
        .then((response) => {
            if(response.data.length >= 1){
                this.listTodos = response.data
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
                },850)
            })
            .catch((error) => {
                alert(error)
                window.location.reload();
            })
        },
        close_blog(key){
            this.listTodos.splice(key,1)
        },
        edit_blog(todo_edit){
            this.image = todo_edit.images
            this.infoBlog = todo_edit
        },
        create_new_todo(data_todo){
            this.listTodos.unshift(data_todo)
        },
        done_todo(key){
            //  console.log(key);
            // this.listTodos
        }
    }
}
</script>
<style lang="css">

</style>
