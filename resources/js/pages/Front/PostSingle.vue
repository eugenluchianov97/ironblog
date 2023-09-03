<script>
import translate from "./../../translates/front/blog.js"

import MainLayout from "../../layouts/MainLayout.vue";
import Categories from "../../components/Front/Categories.vue";
import Tags from "../../components/Front/Tags.vue";
import {postsItemFront} from "@/api/api.js";
import PostSidebar from "../../components/Front/PostSidebar.vue";

import img from "./../../images/main.jpg";

export default  {
    name:"PostSingle",
    components:{PostSidebar, Categories, MainLayout,Tags},
    data(){
        return {
            id:this.$route.params.id,
            post:{},
            loading:true,
            img:img,
            translate:translate
        }
    },
    mounted(){
        postsItemFront(this.id).then((res) => {
            if(res.status === 200){
                this.post = res.data.post
                this.loading = false;

            }
        }).catch(err => {})
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

            <div  class="heading-page header-text">
                <section class="page-heading" v-bind:style="{ 'background-image': 'url(' + img + ')' }">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-content">
                                    <h4 v-if="post.category!==undefined">{{post.category['name_' + lang]}}</h4>
                                    <h2>{{post['title_' + lang]}}</h2>
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
                                    <div class="col-lg-12">
                                        <div class="blog-post" v-if="post">
                                            <div class="blog-thumb">
                                                <img :src="post.image" alt="">
                                            </div>
                                            <div class="down-content">
                                                <span v-if="post.category!== undefined">{{post.category['name_' + lang]}}</span>
                                                <a href="post-details.html"><h4>{{post['title_' + lang]}}</h4></a>
                                                <ul class="post-info">
                                                    <li><a v-if="post.user!== undefined" href="#">{{post.user.name}}</a></li>
                                                    <li><a href="#">{{post.created_at}}</a></li>
                                                </ul>
                                                <div id="blogContent" v-html="post['content_' + lang]"></div>
                                                <div class="post-options m-3">
                                                    <div class="row">
                                                        <div class="col-6">
                                                        </div>
                                                        <div class="col-6 text-right">
                                                            <ul class="post-tags">
                                                                <li><i class="fa fa-tags"></i></li>
                                                                <li v-for="(tag,idx) in post.tags">
                                                                    <router-link :to="{name:'blog',query:{tag_id:tag.id}}">{{tag['name_' + lang ]}}</router-link>
                                                                    <template v-if="idx+1 !== post.tags.length">,</template>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

<style>
#blogContent > p {
    border:none;
    text-transform: none!important;
    font-weight:normal!important;
}
</style>

