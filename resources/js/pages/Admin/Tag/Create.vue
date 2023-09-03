<script>
import AdminLayout from "./../../../layouts/AdminLayout.vue";
import {tagStore} from "../../../api/api.js";
export default {
    name:"AdminTagCreate",
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
                name_ro:{
                    value:"",
                    errors:[]
                },
                name_en:{
                    value:"",
                    errors:[]
                }
            }
        }
    },
    methods:{
        submit(){
            const data = {
                name:this.form.name.value,
                name_ro:this.form.name_ro.value,
                name_en:this.form.name_en.value,
            }
            tagStore(data).then(res => {
                 if(res.status === 200){
                     this.$notify({
                         type: "success",
                         text: 'Tag created successfuly!!',
                         title: "Authorization",
                     });
                     this.$router.push({name:"admin.tag.index"})
                 }
                if(res.response && res.response.status === 422){
                    Object.entries(res.response.data.errors).map((item) => {
                        if(item[0] === 'name'){
                            this.form.name.errors = item[1];
                        }

                        if(item[0] === 'name_ro'){
                            this.form.name_ro.errors = item[1];
                        }

                        if(item[0] === 'name_en'){
                            this.form.name_en.errors = item[1];
                        }
                    })
                }
            });
        },
        success(res){



        },
        error(err){
            if(err.response.data.errors){
                Object.entries(err.response.data.errors).map((item) => {
                    if(item[0] === 'name'){
                        this.form.name.errors = item[1];
                    }
                    if(item[0] === 'name_ro'){
                        this.form.name_ro.errors = item[1];
                    }
                    if(item[0] === 'name_en'){
                        this.form.name_en.errors = item[1];
                    }

                })
            }
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
                    <router-link :to="{name:'admin.tag.index'}">Tags</router-link>
                </li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </template>
        <template v-slot:content>
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Tag</h3>
                        </div>

                        <form v-on:submit.prevent="submit">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name RU</label>
                                    <input v-model="form.name.value" type="text" class="form-control " :class="form.name.errors.length > 0 ? 'is-invalid' : '' " placeholder="Name">
                                    <span v-if="form.name.errors.length > 0" class="text-danger">{{form.name.errors[0]}}</span>
                                </div>

                                <div class="form-group">
                                    <label>Name RO</label>
                                    <input v-model="form.name_ro.value" type="text" class="form-control " :class="form.name_ro.errors.length > 0 ? 'is-invalid' : '' " placeholder="Name">
                                    <span v-if="form.name_ro.errors.length > 0" class="text-danger">{{form.name_ro.errors[0]}}</span>
                                </div>

                                <div class="form-group">
                                    <label>Name EN</label>
                                    <input v-model="form.name_en.value" type="text" class="form-control " :class="form.name_en.errors.length > 0 ? 'is-invalid' : '' " placeholder="Name">
                                    <span v-if="form.name_en.errors.length > 0" class="text-danger">{{form.name_en.errors[0]}}</span>
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
