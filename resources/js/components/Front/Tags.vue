<script>

import translate from "./../../translates/front/tags.js"

import {tagsFront} from "./../../api/api.js"
import router from "@/router/index.js";
export default {
    data(){
        return {
            tags:[],
            translate:translate
        }
    },
    mounted(){
        tagsFront().then(res => {
            if(res.status === 200 ){
                this.tags = res.data.tags
                this.$emit('getTags', false)
            }
        })
    },
    methods:{
        getByTag(id){
            let query = {}
            if(this.$route.query.category_id > 0){
                query.category_id = this.$route.query.category_id
            }
            if(this.$route.query.q !== ""){
                query.q = this.$route.query.q
            }
            query.tag_id = id
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
    <div class="sidebar-item tags">
        <div class="sidebar-heading">
            <h2>{{translate[lang].title}}</h2>
        </div>
        <div class="content">
            <ul id="tags">
                <li v-for="tag in  tags">
                    <a :class="(parseInt(tag.id) === parseInt(this.$route.query.tag_id)) ? 'active' : '' " href="#" v-on:click.prevent="getByTag(tag.id)">
                        {{tag['name_'+lang]}}
                    </a>
                </li>
                <li><a href="#" :class="(this.$route.query.tag_id === null) ? 'active' : '' " v-on:click.prevent="getByTag(null)">{{translate[lang].all}}</a></li>
            </ul>
        </div>
    </div>
</template>

<style>
  #tags .active {
      color: #f48840;
      font-weight: 900;
  }
</style>
