<script>
import AdminLayout from "./../../../layouts/AdminLayout.vue";

import {postIndex,categoryIndex, postDelete, me} from "./../../../api/api.js"

export default {
    name: "PostAdminIndex",
    components: {
        AdminLayout
    },
    data() {
        return {
            posts: [],
            last_page:null,
            current_page:null,
            from:null,
            to:null,
            total:null,
            categories:[],
            selectedCategory:"",
            search:"",
            loading:true
        }
    },
    async mounted() {
        this.getPosts()
    },
    methods: {
        getPosts(page = 1, category = false, search = false) {
            postIndex(page, category, search).then(res => {
                if(res.status === 200){
                    this.posts = res.data.posts.data;
                    this.last_page = res.data.posts.last_page;
                    this.current_page = res.data.posts.current_page;
                    this.from = res.data.posts.from;
                    this.to = res.data.posts.to;
                    this.total = res.data.posts.total;

                    this.loading = false
                }
            })
            categoryIndex().then(res => {
                if(res.status === 200){
                    this.categories = res.data.categories;


                }
            })
        },
        getByCategory(){
            this.getPosts(1, this.selectedCategory,this.search)
        },
        getBySearch(){
            this.getPosts(1, this.selectedCategory,this.search)
        },
        success(res) {
            this.posts = res.data.posts
        },
        error(err) {
        },
        deletePost(id) {
            this.$swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger mx-1',
                    cancelButton: 'btn btn-primary mx-1'
                },
                buttonsStyling: false
            }).fire({
                title: 'Attention!',
                text: "Do you want to delete this post?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete post',
                cancelButtonText: 'Cancel',
            }).then(async (result) => {

                if (result.isConfirmed) {
                    postDelete(id, this.deleteSuccess, this.deleteError)

                }
            })
        },
        deleteSuccess(res) {
            this.getPosts()
            this.$notify({
                type: "success",
                text: 'Post deleted successfuly!!',
                title: "Authorization",
            });
        },
        deleteError(err) {

        }
    },
    computed: {
        user() {
            return this.$store.state.user
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

                <li class="breadcrumb-item active">Posts</li>
            </ol>
        </template>

        <template v-slot:content>
            <div class="row">
                <div class="col-2">
                    <router-link class="btn btn-primary my-3" :to="{name:'admin.post.create'}">Create</router-link>
                </div>
                <div class="col-3">
                    <select v-on:change="getByCategory" v-model="selectedCategory" class="custom-select my-3">
                        <option value="">Все</option>
                        <option :value="category.id" v-for="category in categories">{{category.name}}</option>
                    </select>
                </div>

                <div class="col-4 ">
                    <div class="d-flex align-items-center">
                        <input v-on:keyup.enter="getBySearch" v-model="search" type="text" class="form-control my-3" placeholder="Search">
                        <button v-on:click="getBySearch" class="btn btn-primary mx-1">Find</button>
                    </div>

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
                                    <th>Title RU</th>
                                    <th>Title RO</th>
                                    <th>Title EN</th>
                                    <th>Author</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Date created</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-if="!loading">
                                    <tr v-if="posts.length > 0" v-for="(post,idx) in posts">
                                        <td>{{ post.id }}.</td>
                                        <td>{{ post.title }}</td>
                                        <td>{{ post.title_ro }}</td>
                                        <td>{{ post.title_en }}</td>
                                        <td>{{ post.user.name }}</td>

                                        <td><img style="width:50px" :src="post.image"></td>
                                        <td>{{ post.category.name }}</td>
                                        <td>{{ post.created_at }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger mx-1 my-1"
                                                    v-on:click="deletePost(post.id)">Remove
                                            </button>
                                            <router-link class="btn btn-sm btn-warning mx-1 my-1"
                                                         :to="{name:'admin.post.edit',params:{id:post.id}}">Edit
                                            </router-link>
                                        </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="9">
                                            <p class="text-center">Нет постов</p>
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
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                        Showing {{from}} to {{to}} of {{total}} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end" >
                        <ul class="pagination ">
                            <li class="paginate_button page-item previous " :class="current_page > 1 ? '' : 'disabled'">
                                <a href="#" v-on:click="getPosts(current_page - 1)" class="page-link">Previous</a>
                            </li>
                            <li v-for="index in last_page" :key="index" :class="current_page === index ? 'active' : '' " class="paginate_button page-item ">
                                <a href="#" v-on:click="getPosts(index)" class="page-link">{{index}}</a>
                            </li>

                            <li class="paginate_button page-item next" :class="current_page < last_page ? '' : 'disabled'">
                                <a href="#" v-on:click="getPosts(current_page + 1)" class="page-link">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </template>
    </AdminLayout>
</template>
