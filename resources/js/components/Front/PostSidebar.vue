<script>
import Categories from "../../components/Front/Categories.vue";
import Tags from "../../components/Front/Tags.vue";

import translate from "./../../translates/front/postSideBar.js"
import config from "../../config.js";
import router from "@/router/index.js";
export default {
    name:"PostSideBar",
    components:{
        Categories,Tags

    },
    data(){
        return {
            query:this.$route.query.q,
            translate:translate
        }
    },
    methods:{
        search(){
            let query = {

            }
            if(this.$route.query.tag_id > 0){
                query.tag_id = this.$route.query.tag_id
            }
            if(this.$route.query.category_id > 0){
                query.category_id = this.$route.query.category_id
            }
            query.q = this.query
            router.push({
                name: 'blog',
                query:query
            })
        }
    },
    computed: {
        lang(){
            return this.$store.state.lang
        }
    },
}
</script>

<template>
    <div class="sidebar">
        <div class="row">
            <div class="col-lg-12">
                <div class="sidebar-item search">
                    <form v-on:submit.prevent="search">
                        <input v-model="query" type="text"  class="searchText" :placeholder="translate[lang].search" autocomplete="on">
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <Categories></Categories>
            </div>
            <div class="col-lg-12">
                <Tags></Tags>
            </div>
        </div>
    </div>
</template>

<style>
.sidebar {
    overflow-x: unset;
}
</style>

