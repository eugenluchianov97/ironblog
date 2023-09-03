<script>
import AdminLayout from "../../../layouts/AdminLayout.vue"

import {accountIndex} from "../../../api/api.js"
export default {
    name:"AdminAccountInex",
    components:{
        AdminLayout
    },
    data(){
        return {
            user:{}
        }
    },
    mounted() {
        accountIndex().then(res => {
            if(res.status === 200){
                this.user = res.data.user
            }
        })
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
                <li class="breadcrumb-item active">My account</li>
            </ol>
        </template>
        <template v-slot:content>
            <div class="row">
                <div class="col-12">
                    <router-link class="btn btn-primary my-3" :to="{name:'admin.account.edit'}">Edit</router-link>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body p-0" style="overflow-x: scroll">
                            <table class="table table-striped">

                                <tbody>
                                <tr>
                                    <th>Name </th>
                                    <td>{{user.name}}</td>
                                </tr>
                                <tr>
                                    <th>Email </th>
                                    <td>{{user.email}}</td>
                                </tr>
                                <tr>
                                    <th>Role </th>
                                    <td>{{user.role}}</td>
                                </tr>
                                <tr>
                                    <th>Posts </th>
                                    <td>{{user.posts}}</td>
                                </tr>
                                <tr>
                                    <th>Created at </th>
                                    <td>{{user.created_at}}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </template>
    </AdminLayout>

</template>
