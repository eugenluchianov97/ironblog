<script>
import AdminLayout from "./../../../layouts/AdminLayout.vue";
import {userStore, userRoles, me} from "../../../api/api.js";
export default {
    name:"AdminUserCreate",
    components:{
        AdminLayout
    },
    data(){
        return {
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
                },
                role:{
                    value:"user",
                    errors:[]
                }
            },
            roles: []
        }
    },
    async mounted(){
        if(this.user.role !== 'super_admin'){
            this.$notify({
                type: "warning",
                text: 'Permission denied!',
            });
            this.$router.push({name:'admin.index'})
        }
        userRoles().then((res) => {
            this.roles = res.data.roles
        })

    },
    methods:{
        submit(){
            const data = {
                name:this.form.name.value,
                email:this.form.email.value,
                password:this.form.password.value,
                role:this.form.role.value,
            }

            userStore(data).then((res => {
                if(res.status === 200){
                    this.$notify({
                        type: "success",
                        text: 'User created successfuly!!',
                    });
                    this.$router.push({name:"admin.user.index"})
                }

                if(res.response && res.response.status === 422){
                    if(res.response.data.errors){
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
                            if(item[0] === 'role'){
                                this.form.role.errors = item[1];
                            }

                        })
                    }
                }
            }))
        }
    },
    computed: {
        user () {
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
                <li class="breadcrumb-item">
                    <router-link :to="{name:'admin.user.index'}">Users</router-link>
                </li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </template>
        <template v-slot:content>
            <div class="row">
                <div class="col-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create User</h3>
                        </div>

                        <form v-on:submit.prevent="submit">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-on:input="form.name.errors = []" v-model="form.name.value" type="text" class="form-control " :class="form.name.errors.length > 0 ? 'is-invalid' : '' " placeholder="Name">
                                    <span v-if="form.name.errors.length > 0" class="text-danger">{{form.name.errors[0]}}</span>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input v-on:input="form.email.errors = []" autocomplete="nope" v-model="form.email.value" type="email" class="form-control " :class="form.email.errors.length > 0 ? 'is-invalid' : '' " placeholder="Email">
                                    <span v-if="form.email.errors.length > 0" class="text-danger">{{form.email.errors[0]}}</span>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input v-on:input="form.password.errors = []" autocomplete="new-password" v-model="form.password.value" type="password" class="form-control " :class="form.password.errors.length > 0 ? 'is-invalid' : '' " placeholder="Password">
                                    <span v-if="form.password.errors.length > 0" class="text-danger">{{form.password.errors[0]}}</span>
                                </div>

                                <div class="form-group">
                                    <label>Role</label>
                                    <select v-model="form.role.value" class="custom-select">
                                        <option :value="role" v-for="role in roles">{{role}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </AdminLayout>
</template>
