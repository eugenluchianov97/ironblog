<script>
import AdminLayout from "../../../layouts/AdminLayout.vue"

import {accountIndex, accountStore, userRoles, userShow, userUpdate} from "../../../api/api.js"
export default {
    name:"AdminAccountEdit",
    components:{
        AdminLayout
    },
    data(){
        return {
            id:this.$route.params.id,
            userId:null,
            userRole:null,
            form:{
                name:{
                    value:"",
                    errors:[]
                },
                email:{
                    value:"",
                    errors:[]
                },
                password:{
                    value:"",
                    errors:[]
                }
            },
            roles: []
        }
    },
    mounted() {
        accountIndex().then(res => {
            if(res.status === 200){
                if(res.status === 200){
                    this.form.name.value = res.data.user.name
                    this.form.email.value = res.data.user.email
                    this.userId = res.data.user.id
                    /** если админ пытается редактирвоать дургого админа **/

                }
            }
        })
        userRoles().then((res) => {
            this.roles = res.data.roles
        })
    },
    methods:{
        submit(){
            const data = {
                name:this.form.name.value,
                email:this.form.email.value,
                password:this.form.password.value
            }

            console.log(this.userId)

            accountStore(this.userId,data).then(res => {
                console.log("res = ",res);
                if(res.status === 200){
                    /** если пользовтель изменяет сам себя **/
                    if(res.data.user.id === this.userId){
                        this.$store.commit('setUser',res.data.user)
                    }

                    this.$notify({
                        type: "success",
                        text: 'User updated successfuly!!',
                    });
                    this.$router.push({name:"admin.account"})
                }
                if(res.response && res.response.status === 422){
                    Object.entries(res.response.data.errors).map((item) => {
                        if(item[0] === 'name'){
                            this.form.name.errors = item[1];
                        }
                        if(item[0] === 'email'){
                            this.form.email.errors = item[1];
                        }
                        if(item[0] === 'password'){
                            this.form.password.errors = item[1];
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
                <li class="breadcrumb-item">
                    <router-link :to="{name:'admin.account'}">My account</router-link>
                </li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </template>
        <template v-slot:content>
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit User</h3>
                        </div>

                        <form v-on:submit.prevent="submit" >
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-on:input="form.name.errors = []" v-model="form.name.value" type="text" class="form-control " :class="form.name.errors.length > 0 ? 'is-invalid' : '' " placeholder="Name">
                                    <span v-if="form.name.errors.length > 0" class="text-danger">{{form.name.errors[0]}}</span>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input v-on:input="form.email.errors = []" v-model="form.email.value" type="email" class="form-control " :class="form.email.errors.length > 0 ? 'is-invalid' : '' " placeholder="Email">
                                    <span v-if="form.email.errors.length > 0" class="text-danger">{{form.email.errors[0]}}</span>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input v-on:input="form.password.errors = []" v-model="form.password.value" autocomplete="nope" type="password" class="form-control " :class="form.password.errors.length > 0 ? 'is-invalid' : '' " placeholder="Password">
                                    <span v-if="form.password.errors.length > 0" class="text-danger">{{form.password.errors[0]}}</span>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </AdminLayout>

</template>
