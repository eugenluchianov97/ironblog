<script>
import LoginLayout from "./../../layouts/LoginLayout.vue";

import {resetPassword} from "../../api/api.js"

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
                }
            }
        }
    },
    methods:{
        submit(){
            const data = {
                email:this.form.email.value,
            }

            resetPassword(data).then(res =>{
                if (res.status === 200){
                    this.$notify({
                        type: "success",
                        text: 'На вашу почту был отправлен код для обновления пароля!',

                    });
                    this.$router.push({name:'set-password'})
                }
            })

        }
    }
}
</script>

<template>
    <LoginLayout>
        <template v-slot:content>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Восстановить пароль</p>

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
                    <div class="row mt-3">
                        <div class="col-4">

                        </div>
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary btn-block">Обновить пароль</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    <router-link class="text-center" :to="{name:'login'}">Войти</router-link>
                </p>
            </div>
        </template>
    </LoginLayout>


</template>
