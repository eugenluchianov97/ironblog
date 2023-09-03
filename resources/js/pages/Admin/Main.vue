<script>
import AdminLayout from "./../../layouts/AdminLayout.vue";
import {main} from "@/api/api.js";
export default {
    name:"Main",
    components:{
        AdminLayout
    },
    data(){
         return {
             users:0,
             posts:0,
             tags:0,
             categories:0
         }
    },
    mounted(){
        main().then(res =>{
            if(res.status === 200){
                console.log(res)
                this.users = res.data.users;
                this.posts = res.data.posts;
                this.tags = res.data.tags;
                this.categories = res.data.categories;
            }
        })
    },
}
</script>

<template>
 <AdminLayout>
     <template v-slot:content>
         <div class="row">
             <div class="col-lg-3 col-6">
                 <div class="small-box bg-info">
                     <div class="inner">
                         <h3>{{users}}</h3>
                         <p>Users</p>
                     </div>
                     <div class="icon">
                         <i class="fa fa-users"></i>
                     </div>
                     <router-link  class="small-box-footer" :to="{name:'admin.user.index'}">More info <i class="fas fa-arrow-circle-right"></i></router-link>

                 </div>

             </div>

             <div class="col-lg-3 col-6">

                 <div class="small-box bg-success">
                     <div class="inner">
                         <h3>{{posts}}</h3>
                         <p>Posts</p>
                     </div>
                     <div class="icon">
                         <i class="fa fa-newspaper"></i>
                     </div>
                     <router-link  class="small-box-footer" :to="{name:'admin.post.index'}">More info <i class="fas fa-arrow-circle-right"></i></router-link>

                 </div>
             </div>

             <div class="col-lg-3 col-6">

                 <div class="small-box bg-warning">
                     <div class="inner">
                         <h3>{{tags}}</h3>
                         <p>Tags</p>
                     </div>
                     <div class="icon">
                         <i class="fa fa-tags"></i>
                     </div>
                     <router-link  class="small-box-footer" :to="{name:'admin.tag.index'}">More info <i class="fas fa-arrow-circle-right"></i></router-link>


                 </div>
             </div>

             <div class="col-lg-3 col-6">

                 <div class="small-box bg-danger">
                     <div class="inner">
                         <h3>{{categories}}</h3>
                         <p>Categories</p>
                     </div>
                     <div class="icon">
                         <i class="fa fa-table"></i>
                     </div>
                     <router-link  class="small-box-footer" :to="{name:'admin.category.index'}">More info <i class="fas fa-arrow-circle-right"></i></router-link>

                 </div>
             </div>

         </div>
     </template>
 </AdminLayout>
</template>

