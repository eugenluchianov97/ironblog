<script>
import translate from "./../../translates/front/home.js"

import MainLayout from "../../layouts/MainLayout.vue";
import Categories from "../../components/Front/Categories.vue";
import Tags from "../../components/Front/Tags.vue";
import RecentPosts from "../../components/Front/RecentPosts.vue";
import Post from "../../components/Front/Home/Post.vue";
import PostSideber from "../../components/Front/PostSidebar.vue";

import img from "./../../images/main.jpg";
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

import {postsHomeFront} from "./../../api/api.js"
 export default  {
     name:"Home",

     components:{Post, RecentPosts, Categories, MainLayout,Tags,PostSideber,
         Carousel,
         Slide,
         Pagination,
         Navigation,
     },
     data() {
         return {
             loading:true,
             posts:[],
             translate:translate,
             settings: {
                 itemsToShow: 3,
                 snapAlign: 'center',
             },
             breakpoints: {
                 700: {
                     itemsToShow: 1,
                     snapAlign: 'start',
                 },
             },
             img:img

         }
     },
     mounted(){
         postsHomeFront().then(res => {
             if(res.status === 200){
                 console.log(res);
                 this.posts = res.data.posts
                 this.loading = false
             }
         })
     },
     methods:{
         getCategories(param){
             // this.loading = param;
         },
         getTags(param){
             // this.loading = param;
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
    <MainLayout :loading="loading">



        <template v-slot:content>

            <div class="heading-page header-text">
                <section class="page-heading" v-bind:style="{ 'background-image': 'url(' + img + ')' }">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-content">
                                    <h4>IRON BLOG</h4>
                                    <h2>{{translate[lang].h2}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <section class="blog-posts">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="all-blog-posts">
                                <div class="row">
                                    <Post v-if="posts.length > 0" v-for="post in posts" :post="post"></Post>
                                    <div v-else class="col-lg-12 my-3">
                                        <p  class="text-center">{{translate[lang].noPosts}}</p>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="main-button">
                                            <router-link :to="{name:'blog'}">{{translate[lang].all}}</router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <PostSideber></PostSideber>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </MainLayout>

</template>

