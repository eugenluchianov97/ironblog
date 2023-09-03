<script>
import config from "../../config.js";
import translate from "./../../translates/front/header.js"


export default {
    name:"Header",
    data(){
         return{
             translate:translate
         }
    },
    mounted() {
        if(config.languages.includes(this.$route.params.lang)){
            this.setLang(this.$route.params.lang)
        }
        if(this.$route.params.lang === ''){
            this.setLang(config.lang)
        }
    },
    methods:{
        open(){
            this.$refs.menu.classList.toggle('show')
        },
        setLang(lang){
            this.$store.commit('setLang',lang)

            this.$router.push({name:this.$route.name,params:{lang:this.currentLang}})
        }
    },
    computed: {
        currentLang () {
            //return this.$store.state.lang
            return this.$store.state.lang === config.lang ? '' : this.$store.state.lang
        },
        lang(){
            return this.$store.state.lang
        }
    },

}
</script>
<template>
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <router-link class="navbar-brand" :to="{name:'home'}">
                    <h2>Iron Blog<em>.</em></h2>
                </router-link>
                <button class="navbar-toggler" v-on:click="open">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " ref="menu" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item" v-bind:class="(this.$route.name === 'home' ? 'active' : '')">
                            <router-link class="nav-link" :to="{name:'home',params:{lang:currentLang}}">
                               {{translate[lang].home}}
                            </router-link>
                        </li>
                        <li class="nav-item" v-bind:class="(this.$route.name === 'about' ? 'active' : '')">
                            <router-link class="nav-link" :to="{name:'about',params:{lang:currentLang}}">
                                {{translate[lang].about}}
                            </router-link>
                        </li>
                        <li class="nav-item" v-bind:class="(this.$route.name === 'blog' ? 'active' : '')">
                            <router-link class="nav-link" :to="{name:'blog',params:{lang:currentLang}}">
                                {{translate[lang].blog}}
                            </router-link>
                        </li>
                        <li class="nav-item" v-bind:class="(this.$route.name === 'contact' ? 'active' : '')">
                            <router-link class="nav-link" :to="{name:'contact',params:{lang:currentLang}}">
                                {{translate[lang].contacts}}
                            </router-link>
                        </li>
                        <li class="nav-item d-flex align-items-center langs mx-auto" >

                            <span class="m-1" v-bind:class="(lang === 'ro' ? 'active' : '')"  v-on:click="setLang('ro')">RO</span>
                            <span class="m-1" v-bind:class="(lang === 'ru' ? 'active' : '')" v-on:click="setLang('ru')">RU</span>
                            <span class="m-1" v-bind:class="(lang === 'en' ? 'active' : '')" v-on:click="setLang('en')">EN</span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<style>
        .langs span {
           font-weight:700;
            cursor:pointer
        }

        .langs span:hover {
            color:#f48840
        }

    .langs span.active {
        color:#f48840
    }
</style>
