<script>
import Logout from "@/components/Admin/Logout.vue";

export default {
    name:"Aside",
    components: {Logout},
    data(){
        return {

        }
    },
    mounted(){
    },
    computed: {
        user () {
            return this.$store.state.user
        }
    },
    methods:{
        close(){
            document.body.classList.toggle('sidebar-collapse')
            document.body.classList.remove('sidebar-open')
        }
    }
}
</script>

<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
<!--                    <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
                </div>
                <div class="info">
                    <a href="#" class="d-block"></a>
                    <router-link class="d-block" :to="{name:'admin.account'}">
                        {{user.name}}
                    </router-link>
                </div>
                <div class="position-absolute" style="right:0">
                    <a href="#"><i class="fas fa-arrow-left" v-on:click="close"></i></a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <router-link class="nav-link" :class="this.$route.name === 'admin.index' ? 'active' : '' " :to="{name:'admin.index'}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>

                    </li>

                    <li class="nav-item" v-if="user.role === 'admin' || user.role === 'super_admin'">
                        <router-link class="nav-link" :class="this.$route.name === 'admin.user.index' ? 'active' : '' " :to="{name:'admin.user.index'}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </router-link>

                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :class="this.$route.name === 'admin.category.index' ? 'active' : '' " :to="{name:'admin.category.index'}">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Categories
                            </p>
                        </router-link>

                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :class="this.$route.name === 'admin.tag.index' ? 'active' : '' " :to="{name:'admin.tag.index'}">
                            <i class="nav-icon fas fa-tag"></i>
                            <p>
                                Tags
                            </p>
                        </router-link>

                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :class="this.$route.name === 'admin.post.index' ? 'active' : '' " :to="{name:'admin.post.index'}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Posts
                            </p>
                        </router-link>

                    </li>

                    <li class="nav-item">
                        <Logout>
                            <template v-slot:content>
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p class="text">Logout</p>
                            </template>


                        </Logout>


                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

