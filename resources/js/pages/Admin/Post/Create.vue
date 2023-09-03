<script>
import AdminLayout from "./../../../layouts/AdminLayout.vue";
import {postStore, postCategories, postTags, me} from "../../../api/api.js";
export default {
    name:"AdminPostCreate",
    components:{
        AdminLayout
    },
    data(){
        return {
            form:{
                title:{
                    value:"",
                    errors:[]
                },
                title_ro:{
                    value:"",
                    errors:[]
                },
                title_en:{
                    value:"",
                    errors:[]
                },
                content:{
                    value:"",
                    errors:[]
                },
                content_ro:{
                    value:"",
                    errors:[]
                },
                content_en:{
                    value:"",
                    errors:[]
                },
                image:{
                    value:"",
                    errors:[]
                },
                categoryId:{
                    value:"",
                    errors:[]
                },
                tags:{
                    value:[],
                    errors:[]
                },

            },
            categories:[],
            tags:[],
            previewPicture:false,
            fileName:"Choose file",
            customToolbar: [["bold", "italic", "underline"], [{ list: "ordered" }, { list: "bullet" }]],
        }
    },
    async mounted(){
        // await me().then(res => {
        //     if (res.status === 200) {return this.$store.commit('setUser', res.data.user)} else { this.$router.push({name:"login"})}
        // })

        postCategories().then((res) => {
            this.categories = res.data.categories
        })

        postTags().then((res) => {
            if(res.status === 200){
                this.tags = res.data.tags
            }
        })
    },
    methods:{
        submit(){
            let data = new FormData();
            data.append('image', this.form.image.value);
            data.append('title', this.form.title.value);
            data.append('title_ro', this.form.title_ro.value);
            data.append('title_en', this.form.title_en.value);
            data.append('content', this.form.content.value);
            data.append('content_ro', this.form.content_ro.value);
            data.append('content_en', this.form.content_en.value);
            data.append('category_id', this.form.categoryId.value);
            data.append('tags', this.form.tags.value);


            postStore(data).then(res => {
               if(res.status === 200){
                   this.$notify({
                       type: "success",
                       text: 'Post created successfuly!!',
                   });
                   this.$router.push({name:"admin.post.index"})
               }
               if(res.response.status === 422){
                   Object.entries(res.response.data.errors).map((item) => {

                       if(item[0] === 'title'){
                           this.form.title.errors = item[1];
                       }
                       if(item[0] === 'title_ro'){
                           this.form.title_ro.errors = item[1];
                       }
                       if(item[0] === 'title_en'){
                           this.form.title_en.errors = item[1];
                       }
                       if(item[0] === 'content'){
                           this.form.content.errors = item[1];
                       }
                       if(item[0] === 'content_ro'){
                           this.form.content_ro.errors = item[1];
                       }
                       if(item[0] === 'content_en'){
                           this.form.content_en.errors = item[1];
                       }
                       if(item[0] === 'category_id'){
                           this.form.categoryId.errors = item[1];
                       }
                       if(item[0] === 'image'){
                           this.form.image.errors = item[1];
                       }

                   })
               }

            }).catch((err) => {
                console.log('here 2', err)
            })
        },
        handleFileUpload(e){
            this.previewPicture = true
            let el = this.$refs.prev;

            this.form.image.value = e.target.files[0];
            this.fileName = e.target.files[0].name;

            let fr = new FileReader();
            fr.addEventListener("load", function () {

                el.style.backgroundImage = "url(" + fr.result + ")";
                el.style.backgroundSize = "cover";
                el.style.height = "200px";
                el.style.width = "300px";

            }, false);

            fr.readAsDataURL(e.target.files[0]);
            // this.previewPicture = true

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
                    <router-link :to="{name:'admin.post.index'}">Posts</router-link>
                </li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </template>
        <template v-slot:content>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Post</h3>
                        </div>

                        <form v-on:submit.prevent="submit" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name RU</label>
                                    <input v-model="form.title.value" type="text" class="form-control " :class="form.title.errors.length > 0 ? 'is-invalid' : '' " placeholder="Name">
                                    <span v-if="form.title.errors.length > 0" class="text-danger">{{form.title.errors[0]}}</span>
                                </div>
                                <div class="form-group">
                                    <label>Name RO</label>
                                    <input v-model="form.title_ro.value" type="text" class="form-control " :class="form.title_ro.errors.length > 0 ? 'is-invalid' : '' " placeholder="Name">
                                    <span v-if="form.title_ro.errors.length > 0" class="text-danger">{{form.title_ro.errors[0]}}</span>
                                </div>
                                <div class="form-group">
                                    <label>Name EN</label>
                                    <input v-model="form.title_en.value" type="text" class="form-control " :class="form.title_en.errors.length > 0 ? 'is-invalid' : '' " placeholder="Name">
                                    <span v-if="form.title_en.errors.length > 0" class="text-danger">{{form.title_en.errors[0]}}</span>
                                </div>
                                <div class="form-group">
                                    <label>Content RU</label>
                                    <VueEditor class="is-invalid border-danger" v-model="form.content.value" :editorToolbar="customToolbar"></VueEditor>
                                    <span v-if="form.content.errors.length > 0" class="text-danger">{{form.content.errors[0]}}</span>
                                </div>
                                <div class="form-group">
                                    <label>Content RO</label>
                                    <VueEditor class="is-invalid border-danger" v-model="form.content_ro.value" :editorToolbar="customToolbar"></VueEditor>
                                    <span v-if="form.content_ro.errors.length > 0" class="text-danger">{{form.content_ro.errors[0]}}</span>
                                </div>

                                <div class="form-group">
                                    <label>Content EN</label>
                                    <VueEditor class="is-invalid border-danger" v-model="form.content_en.value" :editorToolbar="customToolbar"></VueEditor>
                                    <span v-if="form.content_en.errors.length > 0" class="text-danger">{{form.content_en.errors[0]}}</span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input accept="image/*" type="file" class="custom-file-input" :class="form.image.errors.length > 0 ? 'is-invalid' : '' " v-on:change="handleFileUpload($event)">
                                            <label class="custom-file-label" for="exampleInputFile">{{fileName}}</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>

                                    </div>
                                    <div class="mt-1" ref="prev"></div>
                                    <span v-if="form.image.errors.length > 0" class="text-danger">{{form.image.errors[0]}}</span>
                                </div>

                                <div class="form-group">
                                    <label>Category</label>
                                    <select v-model="form.categoryId.value" class="custom-select" :class="form.categoryId.errors.length > 0 ? 'is-invalid' : '' ">
                                        <option value="" disabled>Не выбранно</option>
                                        <option :value="category.id" v-for="category in categories">{{category.name}}</option>
                                    </select>
                                    <span v-if="form.categoryId.errors.length > 0" class="text-danger">{{form.categoryId.errors[0]}}</span>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Tags</label>
                                        <select multiple="" name="artists[]" v-model="form.tags.value" class="custom-select">
                                            <option :value="tag.id" v-for="tag in tags">{{tag.name}}</option>
                                        </select>
                                    </div>
                                    <span v-if="form.categoryId.errors.length > 0" class="text-danger">{{form.categoryId.errors[0]}}</span>
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
