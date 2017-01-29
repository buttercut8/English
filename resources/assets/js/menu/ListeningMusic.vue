<template lang="html">

        <div class="wrapper">
            <div class="row">
                <div class="col m12">
                    <div class="col m6 offset-m3">
                        <input type="text" v-model="keyword" placeholder="Search Courses..." class="center-align">
                    </div>
                </div>
                <div class="col m3"  v-for="post in fillterCourse">
                    <div class="card">
                        <a :href="post.author">
                            <img :src="post.img" :alt="post.author" class="responsive-img">
                            <small>Posted by {{post.author}}</small>
                            <p class="center-align title">{{post.title}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
class Post{
    constructor(title,author,img){
        this.title = title;
        this.author = author;
        this.img = img;
    }
}
export default {
    data(){
        return {
            keyword : "",
            posts:[
                new Post(
                    'Vue js 2.0',
                    'Evan Vue',
                    'https://vuejs.org//images/logo.png',
                ),
                new Post(
                    'Ember 2.0',
                    'Remy',
                    'https://vuejs.org//images/logo.png',
                ),
                new Post(
                    'Angular 2.0',
                    'Google',
                    'https://vuejs.org//images/logo.png',
                ),
                new Post(
                    'React JS ',
                    'Facebook',
                    'https://vuejs.org//images/logo.png',
                ),
                new Post(
                    'Meteor.js',
                    'Evan Vue',
                    'https://vuejs.org//images/logo.png',
                ),
                new Post(
                    'Node Js',
                    'Node',
                    'https://vuejs.org//images/logo.png',
                ),
            ]
        }
    },
    computed:{
        fillterCourse(){
            return this.posts.filter((listPost) => {
                return listPost.title.toLowerCase().includes(this.keyword.toLowerCase())
            });
        }
    }

}
</script>

<style lang="css">
</style>
