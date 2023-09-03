<script>
import {logout} from "@/api/api.js";

export default {
    name:"Logout",
    methods:{
        logout(){
            logout().then(res => {
                if(res.status === 200){
                    localStorage.removeItem("TOKEN")
                    this.$store.commit('logoutUser')
                    this.$router.push({name:"login"})
                }
            })
        }
    }
}
</script>

<template>
    <a v-on:click.prevent="logout" href="#" class="nav-link">
        <slot name="content"></slot>
    </a>
</template>

