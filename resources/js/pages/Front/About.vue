<script>
import MainLayout from "../../layouts/MainLayout.vue";

import img from "./../../images/main.jpg";

import translate from "./../../translates/front/about.js"

export default  {
    name:"About",
    components:{MainLayout},
    data(){
       return {
           img:img,
           loading:true,
           translate:translate
       }
    },
    mounted(){
        setTimeout(() => {
            this.loading = false
        },1000)

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
                                    <h4>{{translate[lang].title}}</h4>
                                    <h2>{{translate[lang].h2}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <section class="about-us">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-12">
                            <p>
                                {{translate[lang].description}}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

        </template>
    </MainLayout>
</template>
