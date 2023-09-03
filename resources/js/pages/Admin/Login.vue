<script>
import LoginLayout from "./../../layouts/LoginLayout.vue";

import {login} from "../../api/api.js"

export default {
    name:"Login",
    components:{
        LoginLayout
    },
    data(){
        return {
            form:{
                email:{
                    value:"",
                    errors:[]
                },
                password:{
                    value:"",
                    errors:[]
                }
            }
        }
    },
    methods:{
        submit(){
            const data = {
                email:this.form.email.value,
                password:this.form.password.value
            }
            login(data).then(res => {
                if(res.status === 200){
                    localStorage.setItem('TOKEN',res.data.token)
                    this.$store.commit('setUser',res.data.user)
                    this.$notify({
                        type: "success",
                        text: 'Login successfuly!!',

                    });
                    this.$router.push({name:'admin.index'})
                }
                if(res.response && res.response.status === 422){
                    if(res.response.data.errors){
                        Object.entries(res.response.data.errors).map((item) => {
                            if(item[0] === 'email'){
                                this.form.email.errors = item[1];
                            }
                            if(item[0] === 'password'){
                                this.form.password.errors = item[1];
                            }
                        })
                    }
                }
                if(res.response && res.response.status === 401){
                    this.$notify({
                        type: "error",
                        text: 'Invalid credentials!!',

                    });
                }
            });

        }
    }
}
</script>

<template>
    <LoginLayout>
        <template v-slot:content>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Войти в админ панель</p>

                <form v-on:submit.prevent="submit">
                    <div class="input-group">
                        <input v-on:input="form.email.errors = []" v-model="form.email.value" type="text" class="form-control" :class="form.email.errors.length > 0 ? 'is-invalid' : '' " placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                    </div>
                    <span v-if="form.email.errors.length > 0" class="text-danger">{{form.email.errors[0]}}</span>
                    <div class="input-group mt-3">
                        <input v-on:input="form.password.errors = []"  v-model="form.password.value" type="password" class="form-control" :class="form.password.errors.length > 0 ? 'is-invalid' : '' " placeholder="Пароль">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <span v-if="form.password.errors.length > 0" class="text-danger">{{form.email.errors[0]}}</span>
                    <div class="row mt-3">
                        <div class="col-8">

                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Войти</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    <router-link class="text-center" :to="{name:'reset'}">Я забыл свой пароль</router-link>
                </p>
            </div>
        </template>
    </LoginLayout>


</template>
