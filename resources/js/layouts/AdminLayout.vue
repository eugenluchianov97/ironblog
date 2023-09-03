<script>
import Aside from "./../components/Admin/Aside.vue";
import Navbar from "./../components/Admin/Navbar.vue";


import {me} from '../api/api.js'
export default {

    name:"AdminLayout",
    components:{
        Aside,Navbar
    },
    data(){
        return {
            loading:true,
            isMounted:false
        }
    },
    async mounted(){
        this.isMounted =true

    },
    computed: {
        user () {
            return this.$store.state.user
        },
        loggedIn(){
            return this.$store.state.loggedIn
        },

    }
}
</script>

<template>
    <div class="hold-transition sidebar-mini" >
        <div class="wrapper">
            <div v-if="!isMounted" class="preloader w-100 flex-column justify-content-center align-items-center">
<!--                <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
                <div class="spinner-border text-secondary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <template v-else>
                <!-- Navbar -->
                <Navbar/>
                <!-- /.navbar -->

                <!-- Main Sidebar Container -->
                <Aside/>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6">
                                    <slot name="breadcrumbs"></slot>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <div class="container-fluid">
                            <slot v-if="isMounted" name="content"></slot>
                        </div>
                    </div>
                </div>

                <aside class="control-sidebar control-sidebar-dark">

                </aside>

            </template>


        </div>
    </div>
</template>
