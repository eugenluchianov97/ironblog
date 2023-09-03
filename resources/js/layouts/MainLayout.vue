<script>
import Header from "./../components/Front/Header.vue";
import Footer from "./../components/Front/Footer.vue";

export default {
    name:"MainLayout",
    props:['loading'],
    components:{
        Header,Footer
    },
    data(){
        return {

        }
    },
    mounted(){

    },
    methods:{
        receiveEmit(param) {
            this.loading = false
        }
    }
}
</script>

<template>
    <div id="front">
        <div v-if="loading" id="preloader">
            <div class="jumper">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        <Header/>

        <slot v-on:toggleLoading="receiveEmit" name="content"></slot>

        <Footer/>

    </div>

</template>

