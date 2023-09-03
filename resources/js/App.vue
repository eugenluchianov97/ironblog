<script>

import config from "./config.js"

export default {
    name:"App",
    mounted(){
        if(localStorage.getItem('lang') === null){
            localStorage.setItem('lang',config.lang)
        }
    }
}
</script>

<template>
    <router-view> </router-view>
    <notifications />
</template>
