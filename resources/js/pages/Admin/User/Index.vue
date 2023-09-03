<script>
import AdminLayout from "./../../../layouts/AdminLayout.vue";

import {userIndex, userDelete, me} from "./../../../api/api.js"
export default {
    name:"AdminUserList",
    components:{
        AdminLayout
    },
    data(){
        return {
            users:[],
            loading:true
        }
    },
    async mounted(){
        if(this.loggedUser.role !== 'super_admin'){
            this.$notify({
                type: "error",
                text: 'Permission denied!',
            });
            this.$router.push({name:'admin.index'})
        }
        this.getUsers()
    },
    methods:{
        getUsers(){
            userIndex().then(res => {
                if(res.status === 200){
                    this.users = res.data.users;
                    this.loading = false
                }
            })
        },
        deleteUser(id){
            this.$swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger mx-1',
                    cancelButton: 'btn btn-primary mx-1'
                },
                buttonsStyling: false
            }).fire({
                title: 'Attention!',
                text: "Do you want to delete this user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete user',
                cancelButtonText: 'Cancel',
            }).then(async (result) => {
                if (result.isConfirmed) {
                    userDelete(id).then(res => {
                         if(res.status === 200){
                             this.getUsers()
                             this.$notify({
                                 type: "success",
                                 text: 'User deleted successfuly!!',
                             });
                         }
                    })

                }
            })
        },

        activeEditBtn(user){
            if(user.role === 'super_admin' && this.loggedUser.role === 'super_admin'){
                return true;
            }
            if((user.role === 'admin' || user.role === 'user') && this.loggedUser.role === 'super_admin'){
                return true;
            }
            if( user.role === 'user' && this.loggedUser.role === 'admin'){
                return true;
            }
            if( user.role === 'admin' && this.loggedUser.role === 'admin' && user.id === this.loggedUser.id ){
                return true;
            }

            return false
        },
        activeDeleteBtn(user){

            if(user.role === 'admin' && this.loggedUser.role === 'super_admin'){
                return true;
            }
            if(user.role === 'user' && (this.loggedUser.role === 'super_admin' || this.loggedUser.role === 'admin')){
                return true;
            }
            return false
        }
    },
    computed: {
        loggedUser () {
            return this.$store.state.user
        },
        loggedIn(){
            return this.$store.state.loggedIn
        },

    }
}
</script>

<template>
    <AdminLayout >
        <template v-slot:breadcrumbs>
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <router-link :to="{name:'admin.index'}">Home</router-link>
                </li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </template>
        <template v-slot:content>
            <div class="row">
                <div class="col-12">
                    <router-link class="btn btn-primary my-3" :to="{name:'admin.user.create'}">Create</router-link>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Date created</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-if="!loading">
                                    <tr v-if="users.length > 0" v-for="(user,idx) in users">
                                        <td>{{user.id}}.</td>
                                        <td>{{user.name}}</td>
                                        <td>{{user.email}}</td>
                                        <td>{{user.role}}</td>
                                        <td>{{user.created_at}}</td>
                                        <td>
                                            <button :class="activeDeleteBtn(user) ? '' : 'disabled' "  class=" btn btn-sm btn-danger mx-1 my-1" v-on:click="activeDeleteBtn(user) && deleteUser(user.id)">Remove</button>
                                            <router-link :class="activeEditBtn(user) ? '' : 'disabled' " class="btn btn-sm btn-warning mx-1 my-1" :to="{name:'admin.user.edit',params:{id:user.id}}">Edit</router-link>
                                        </td>
                                    </tr>
                                    <tr v-else >
                                        <td colspan="6">
                                            <p class="text-center">Нет пользователей</p>
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
