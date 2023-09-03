<script>
import {logout} from '../../api/api.js'

import Logout from "./../../components/Admin/Logout.vue"
export default {
    name:"Navbar",
    components:{
        Logout
    },
    methods:{
        open(){

            document.body.classList.toggle('sidebar-collapse')
            document.body.classList.toggle('sidebar-open')
        }
    }
}
</script>
<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#" v-on:click="open"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" >
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
</template>
