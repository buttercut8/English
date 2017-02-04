<template lang="html">
    <span class="card-title user_edit">
        <a href="#edit-todo">
            <i class="material-icons" @click.prevent="update_blog">create</i>
        </a>
        <a href="#delete-todo">
            <i class="material-icons" @click.prevent="delete_blog(idBlog)">delete_forever</i>
        </a>
    </span>
</template>
<script>
export default {
    props:{
        idBlog:{
            type: Number,
            default: 0,
        },
    },
    methods:{
        delete_blog(id){
            if(confirm('Are you sure you wanna delete ?')){
                axios.post('/delete-todo',{id : id})
                .then((response) => {
                    if(response.data.success){
                        Materialize.toast(response.data.success, 4000,'rounded')
                        this.$emit('delete')
                    }
                })
                .catch((error) => {
                    alert(error);
                    window.location.reload()
                })
            }
        },
        update_blog(){
            this.$emit('edit')
        },
    }
}
</script>

<style lang="css">


</style>
