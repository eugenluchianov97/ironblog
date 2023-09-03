<script>
import AdminLayout from "./../../../layouts/AdminLayout.vue";

import {tagIndex, tagDelete, me} from "./../../../api/api.js"
export default {
    name:"Main",
    components:{
        AdminLayout
    },
    data(){
        return {
            tags:[],
            loading:true
        }
    },
    mounted() {
        this.getTags()
    },
    methods:{
        getTags(){
            tagIndex().then(res => {
                if(res.status === 200){
                    this.tags = res.data.tags
                    this.loading = false
                }
            })
        },
        deleteTag(id){
            this.$swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger mx-1',
                    cancelButton: 'btn btn-primary mx-1'
                },
                buttonsStyling: false
            }).fire({
                title: 'Attention!',
                text: "Do you want to delete this tag?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete tag',
                cancelButtonText: 'Cancel',
            }).then(async (result) => {
                if (result.isConfirmed) {
                    tagDelete(id).then(res => {
                        if(res.status === 200){
                            this.getTags()
                            this.$notify({
                                type: "success",
                                text: 'Tag deleted successfuly!!',
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
                <li class="breadcrumb-item active">Tags</li>
            </ol>
        </template>
        <template v-slot:content>
            <div class="row">
                <div class="col-12">
                    <router-link class="btn btn-primary my-3" :to="{name:'admin.tag.create'}">Create</router-link>
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
                                    <tr v-if="tags.length > 0" v-for="(tag,idx) in tags">
                                        <td>{{tag.id}}.</td>
                                        <td>{{tag.name}}</td>
                                        <td>{{tag.name_ro}}</td>
                                        <td>{{tag.name_en}}</td>
                                        <td>
                                            {{tag.created_at}}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger mx-1 my-1" v-on:click="deleteTag(tag.id)">Remove</button>
                                            <router-link class="btn btn-sm btn-warning mx-1 my-1" :to="{name:'admin.tag.edit',params:{id:tag.id}}">Edit</router-link>
                                        </td>
                                    </tr>
                                    <tr v-else >
                                        <td colspan="7">
                                            <p class="text-center">Нет тегов</p>
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
