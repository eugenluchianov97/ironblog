<script>
import AdminLayout from "./../../../layouts/AdminLayout.vue";

import {categoryIndex, categoryDelete, me} from "./../../../api/api.js"
export default {
    name:"Main",
    components:{
        AdminLayout
    },
    data(){
        return {
            categories:[],
            loading:true
        }
    },
    mounted(){
        this.getCategories()
    },
    methods:{
        getCategories(){
            categoryIndex().then(res => {
                if(res.status === 200){
                    this.categories = res.data.categories
                    this.loading = false
                }
            })
        },
        deleteCategory(id){
            this.$swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger mx-1',
                    cancelButton: 'btn btn-primary mx-1'
                },
                buttonsStyling: false
            }).fire({
                title: 'Attention!',
                text: "Do you want to delete this category?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete category',
                cancelButtonText: 'Cancel',
            }).then(async (result) => {

                if (result.isConfirmed) {
                    categoryDelete(id).then(res => {
                        if(res.status === 200){
                            this.getCategories()
                            this.$notify({
                                type: "success",
                                text: 'Category deleted successfuly!!',
                                title: "Authorization",
                            });
                        }
                    })

                }
            })
        }
    }
}
</script>

<template>
    <AdminLayout>
        <template v-slot:breadcrumbs>
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <router-link :to="{name:'admin.index'}">Home</router-link>
                </li>

                <li class="breadcrumb-item active">Categories</li>
            </ol>
        </template>

        <template v-slot:content>
            <div class="row">
                <div class="col-12">
                    <router-link class="btn btn-primary my-3" :to="{name:'admin.category.create'}">Create</router-link>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body p-0" style="overflow-x: scroll">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name RU</th>
                                    <th>Name RO</th>
                                    <th>Name EN</th>
                                    <th>Date created</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-if="!loading">
                                    <tr v-if="categories.length > 0" v-for="(category,idx) in categories">
                                        <td>{{category.id}}.</td>
                                        <td>{{category.name}}</td>
                                        <td>{{category.name_ro}}</td>
                                        <td>{{category.name_en}}</td>
                                        <td>
                                            {{category.created_at}}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger mx-1 my-1" v-on:click="deleteCategory(category.id)">Remove</button>
                                            <router-link class="btn btn-sm btn-warning mx-1 my-1" :to="{name:'admin.category.edit',params:{id:category.id}}">Edit</router-link>
                                        </td>
                                    </tr>
                                    <tr v-else >
                                        <td colspan="6">
                                            <p class="text-center">Нет категорий</p>
                                        </td>

                                    </tr>
                                </template>
                                <template v-else>
                                    <tr >
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>

                                    </tr>
                                    <tr >
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>

                                    </tr>
                                    <tr >
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>

                                    </tr>
                                    <tr >
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>
                                        <td>
                                            <div style="height:50px;width:100%;background:#eee"></div>
                                        </td>

                                    </tr>

                                </template>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </template>
    </AdminLayout>
</template>
