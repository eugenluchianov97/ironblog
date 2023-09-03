<script>
import {postCategoriesFront} from "./../../api/api.js"
import router from "@/router/index.js";

import translate from "./../../translates/front/categories.js"

export default {
    name:"Categories",
    props:"getCategories",
    data() {
        return {
            loading:true,
            categories:[],
            translate:translate
        }
    },
    mounted() {
        postCategoriesFront(this.success,this.error)
    },
    methods:{
        success(res){
            this.categories = res.data.categories
        },
        error(err){

        },
        getByCategory(id){
            let query = {}
            if(this.$route.query.tag_id > 0){
                query.tag_id = this.$route.query.tag_id
            }
            if(this.$route.query.q !== ""){
                query.q = this.$route.query.q
            }
            query.category_id = id
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
    <div class="sidebar-item categories">
        <div class="sidebar-heading">
            <h2>{{translate[lang].title}}</h2>
        </div>
        <div class="content" id="categories" >
            <ul>
                <li v-for="category in categories">
                    <a :class="(parseInt(category.id) === parseInt(this.$route.query.category_id)) ? 'active' : '' " href="#" v-on:click.prevent="getByCategory(category.id)" >
                        - {{category['name_'+lang]}}
                    </a>
                </li>
                <li>
                    <a href="#" :class="(this.$route.query.category_id === null) ? 'active' : '' " v-on:click.prevent="getByCategory(null)" >
                    - {{translate[lang].all}}</a>
                </li>
            </ul>
        </div>
    </div>

</template>

<style>
#categories .active {
    color: #f48840;
    font-weight: 900;
}
</style>
