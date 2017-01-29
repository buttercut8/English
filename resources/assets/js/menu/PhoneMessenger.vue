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
    }
}
</script>

<style lang="css">
.box{
    width:150px;
    height:150px;
}
</style>
