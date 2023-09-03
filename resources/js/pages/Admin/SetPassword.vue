<script>
import LoginLayout from "./../../layouts/LoginLayout.vue";

import {setPassword} from "../../api/api.js"

export default {
    name:"SetPassword",
    components:{
        LoginLayout
    },
    data(){
        return {
            form:{
                password:{
                    value:"",
                    errors:[]
                },
                code:{
                    value:"",
                    errors:[]
                }
            }
        }
    },
    methods:{
        submit(){
            const data = {
                password:this.form.password.value,
                code:this.form.code.value,
            }

            setPassword(data).then(res =>{
                if (res.status === 200){
                    this.$notify({
                        type: "success",
                        text: 'Пароль успешно обновлен!',

                    });
                    this.$router.push({name:'login'})
                }

                if(res.response && res.response.status === 422){
                    this.$notify({
                        type: "error",
                        text: 'Код просрочен, получите новый!',

                    });
                    this.$router.push({name:'reset'})
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
                <p class="login-box-msg">Обновить пароль</p>

                <form v-on:submit.prevent="submit">
                    <div class="input-group">
                        <input v-on:input="form.code.errors = []" v-model="form.code.value" autocomplete="off" type="text" class="form-control" :class="form.code.errors.length > 0 ? 'is-invalid' : '' " placeholder="Code">
                    </div>
                    <span v-if="form.code.errors.length > 0" class="text-danger">{{form.email.errors[0]}}</span>
                    <br>
                    <div class="input-group">
                        <input v-on:input="form.password.errors = []" v-model="form.password.value" type="password" class="form-control" :class="form.password.errors.length > 0 ? 'is-invalid' : '' " placeholder="Password">

                    </div>
                    <span v-if="form.password.errors.length > 0" class="text-danger">{{form.password.errors[0]}}</span>
                    <div class="row mt-3">
                        <div class="col-4">

                        </div>
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary btn-block">Обновить</button>
                        </div>
                    </div>
                </form>
            </div>
        </template>
    </LoginLayout>


</template>
