<script>
import MainLayout from "../../layouts/MainLayout.vue";

import {contactsSend} from '../../api/api.js'

import img from "./../../images/main.jpg";

import translate from "./../../translates/front/contacts.js"
export default  {
    name:"Contact",
    components:{MainLayout},
    data(){
       return {
           img:img,
           translate:translate,
           loading:true,
           form:{
               name:{
                   value:"",
                   errors:[]
               },
               email:{
                   value:"",
                   errors:[]
               },
               subject:{
                   value:"",
                   errors:[]
               },
               message:{
                   value:"",
                   errors:[]
               }
           }
       }
    },
    mounted(){
        setTimeout(() => {
            this.loading = false
        },1000)
    },
    methods:{
        submit(){
            let data = {
                name:this.form.name.value,
                email:this.form.email.value,
                subject:this.form.subject.value,
                message:this.form.message.value,
            }

            contactsSend(data).then(res => {
                if(res.status === 200){
                    this.form.name.value = '';
                    this.form.email.value = '';
                    this.form.subject.value = '';
                    this.form.message.value = '';

                    this.$notify({
                        type: "success",
                        text: 'Send successfuly!!',
                    });
                }
                if(res.response.status === 422){
                    Object.entries(res.response.data.errors).map((item) => {
                        if(item[0] === 'name'){
                            this.form.name.errors = item[1];
                            this.$notify({
                                type: "error",
                                text: this.form.name.errors[0],
                            });
                        }
                        if(item[0] === 'email'){
                            this.form.email.errors = item[1];
                            this.$notify({
                                type: "error",
                                text: this.form.email.errors[0],
                            });
                        }
                        if(item[0] === 'subject'){
                            this.form.subject.errors = item[1];
                            this.$notify({
                                type: "error",
                                text: this.form.subject.errors[0],
                            });
                        }
                        if(item[0] === 'message'){
                            this.form.message.errors = item[1];
                            this.$notify({
                                type: "error",
                                text: this.form.message.errors[0],
                            });

                        }

                    })
                }
            })
        }
    },
    computed: {
        lang(){
            return this.$store.state.lang
        }
    },
}
</script>

<template>

    <MainLayout :loading="loading">
        <template v-slot:content>

            <div class="heading-page header-text">
                <section class="page-heading" v-bind:style="{ 'background-image': 'url(' + img + ')' }">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-content">
                                    <h4>{{translate[lang].title}}</h4>
                                    <h2>{{translate[lang].h2}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <section class="contact-us">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="down-contact">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="sidebar-item contact-form">
                                            <div class="sidebar-heading">
                                                <h2>{{translate[lang].send}}</h2>
                                            </div>
                                            <div class="content">
                                                <form id="contact" v-on:submit.prevent="submit">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12">
                                                            <fieldset>
                                                                <input v-on:input="() =>{form.name.errors = []}" v-model="form.name.value" :class="(form.name.errors.length > 0) ? 'invalid': ''" type="text" id="name" :placeholder="translate[lang].name">

                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <fieldset>
                                                                <input v-on:input="() =>{form.email.errors = []}" v-model="form.email.value" :class="(form.email.errors.length > 0) ? 'invalid': ''" type="text" id="email" :placeholder="translate[lang].email">
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12">
                                                            <fieldset>
                                                                <input v-on:input="() =>{form.subject.errors = []}" v-model="form.subject.value" :class="(form.subject.errors.length > 0) ? 'invalid': ''" type="text" id="subject" :placeholder="translate[lang].subject">
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <fieldset>
                                                                <textarea v-on:input="() =>{form.message.errors = []}" v-model="form.message.value" :class="(form.message.errors.length > 0) ? 'invalid': ''" rows="6" id="message" :placeholder="translate[lang].message"></textarea>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <fieldset>
                                                                <button type="submit" id="form-submit" class="main-button">{{translate[lang].sendMessage}}</button>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="sidebar-item contact-information">
                                            <div class="sidebar-heading">
                                                <h2>{{translate[lang].contactInfo}}</h2>
                                            </div>
                                            <div class="content">
                                                <ul>
                                                    <li>
                                                        <h5>+37368804144</h5>
                                                        <span>{{translate[lang].phoneNumber}}</span>
                                                    </li>
                                                    <li>
                                                        <h5>eugenluchianov97@gmail.com</h5>
                                                        <span>{{translate[lang].emailAddress}}</span>
                                                    </li>
                                                    <li>
                                                        <h5>{{translate[lang].moldova}}</h5>
                                                        <span>{{translate[lang].streetAddress}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </template>
    </MainLayout>
</template>

<style>
.contact-us .contact-form input.invalid {
    border:1px solid #f14444
}

.contact-us .contact-form textarea.invalid {
    border:1px solid #f14444
}
</style>
