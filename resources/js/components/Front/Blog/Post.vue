<script>
export default {
    props:['post'],
    computed: {
        lang(){
            return this.$store.state.lang
        }
    },
}

</script>

<template>
    <div class="col-lg-6">
        <div class="blog-post">
            <div class="blog-thumb">
                <img :src="post.image" alt="">
            </div>
            <div class="down-content">
                <span>{{post.category['name_' + lang]}}</span>
                <router-link :to="{name:'blog.show',params:{id:post.id}}"><h4>{{post['title_' + lang]}}</h4></router-link>
                <ul class="post-info">
                    <li><a href="#">{{post.user.name}}</a></li>
                    <li><a href="#">{{post.created_at}}</a></li>
                </ul>
                <hr>
                <div class="post-options my-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="post-tags" v-if="post.tags.length > 0">
                                <li><i class="fa fa-tags"></i></li>
                                <li v-for="(tag, idx) in post.tags">
                                    <a href="#">{{tag['name_' + lang]}}<template v-if="idx + 1 !== post.tags.length">,</template></a>
                                </li>
                            </ul>
                            <ul v-else class="post-tags">
                                <li><a href="#">-</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

