<script>
import translate from "./../../translates/front/blog.js"

import MainLayout from "../../layouts/MainLayout.vue";
import RecentPosts from "@/components/Front/RecentPosts.vue";
import Categories from "@/components/Front/Categories.vue";
import Tags from "@/components/Front/Tags.vue";

import Post from "./../../components/Front/Blog/Post.vue"
import PostSidebar from "./../../components/Front/PostSidebar.vue";

import {postsBlogFront} from "@/api/api.js";

import img from "./../../images/main.jpg";

export default  {
    name:"Blog",
    components:{PostSidebar, Tags, Categories, RecentPosts, MainLayout,Post},
    data(){
        return {
            translate:translate,
            loading:true,

            posts:[],

            tag:this.$route.query.tag_id,
            category:this.$route.query.category_id,
            query:this.$route.query.q,

            last_page:null,
            current_page:null,
            from:null,
            to:null,
            total:null,

            img:img
        }
    },
    mounted(){
        this.getPosts();
    },
    watch: {
        '$route.query.tag_id'(id) {
            this.tag = id;
            this.getPosts();
        },
        '$route.query.category_id'(id) {
            this.category = id;
            this.getPosts();
        },
        '$route.query.q'(q) {
            this.query = q;
            this.getPosts();
        },
    },
    methods:{
        getPosts(page = 1){
            this.loading = true
            postsBlogFront(page,this.tag, this.category, this.query).then((res) => {
                if(res.status === 200){
                    this.posts = res.data.posts.data;

                    this.current_page = res.data.posts.current_page
                    this.last_page = res.data.posts.last_page
                    this.to = res.data.posts.to
                    this.from = res.data.posts.from
                    this.total = res.data.posts.total

                }

            }).then( res => {
                this.loading = false
            })
        },
        search(){
            console.log(this.query)
            this.paginate();
        },


    } ,
    computed: {
        lang(){
            return this.$store.state.lang
        }
    },
}
</script>

<template>

    <MainLayout :loading="loading">
        <template v-slot:content>

            <div class="heading-page header-text">
                <section class="page-heading" v-bind:style="{ 'background-image': 'url(' + img + ')' }">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-content">
                                    <h4>{{translate[lang].title}}</h4>
                                    <h2>{{translate[lang].h2}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <section class="blog-posts grid-system">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="all-blog-posts">
                                <div class="row">
                                    <Post v-if="posts.length > 0" v-for="post in posts" :post="post"></Post>
                                    <div v-else class="col-lg-12 text-center">
                                        <p>{{translate[lang].no}}</p>
                                    </div>

                                    <div class="col-lg-12">
                                        <ul class="page-numbers">
                                            <li v-on:click="getPosts(current_page - 1)"  :class="current_page > 1 ? '' : 'd-none'">
                                                <a href="#" >
                                                    <i class="fa fa-angle-double-left"></i>
                                                </a>
                                            </li>
                                            <li v-on:click="getPosts(index)"  v-for="index in last_page" :key="index" :class="current_page === index ? 'active' : '' ">
                                                <a href="#" >{{index}}</a>
                                            </li>

                                            <li  v-on:click="getPosts(current_page + 1)" :class="current_page < last_page ? '' : 'd-none'">
                                                <a href="#">
                                                    <i class="fa fa-angle-double-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <PostSidebar></PostSidebar>
                        </div>
                    </div>
                </div>
            </section>

        </template>
    </MainLayout>

</template>
