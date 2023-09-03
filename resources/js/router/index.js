import { createWebHistory, createRouter } from "vue-router";

/** Front **/
import Home from "../pages/Front/Home.vue";
import Blog from "../pages/Front/Blog.vue";
import Contact from "../pages/Front/Contact.vue";
import About from "../pages/Front/About.vue";
import PostSingle from "../pages/Front/PostSingle.vue";
/** Admin **/
import Login from "./../pages/Admin/Login.vue";
import Register from "./../pages/Admin/Register.vue";
import Main from "./../pages/Admin/Main.vue";
import ResetPassword from "./../pages/Admin/ResetPassword.vue";
import SetPassword from "./../pages/Admin/SetPassword.vue";

import AdminCategoryIndex from "./../pages/Admin/Category/Index.vue"
import AdminCategoryCreate from "./../pages/Admin/Category/Create.vue"
import AdminCategoryEdit from "./../pages/Admin/Category/Edit.vue"

import AdminTagIndex from "./../pages/Admin/Tag/Index.vue"
import AdminTagCreate from "./../pages/Admin/Tag/Create.vue"
import AdminTagEdit from "./../pages/Admin/Tag/Edit.vue"


import AdminUserIndex from "./../pages/Admin/User/Index.vue"
import AdminUserCreate from "./../pages/Admin/User/Create.vue"
import AdminUserEdit from "./../pages/Admin/User/Edit.vue"

import AdminPostIndex from "./../pages/Admin/Post/Index.vue"
import AdminPostCreate from "./../pages/Admin/Post/Create.vue"
import AdminPostEdit from "./../pages/Admin/Post/Edit.vue"
import AdminAccountIndex from "./../pages/Admin/Account/Index.vue"
import AdminAccountEdit from "./../pages/Admin/Account/Edit.vue"

import Page404 from "./../pages/Front/404.vue"


import {me} from "@/api/api.js";

import store from "./../store/index.js"



const routes = [
    {
        path: "/:lang( |ro|en)?",
        name: "home",
        component: Home,
    },
    {
        path: "/:lang( |ro|en)?/blog",
        name: "blog",
        component: Blog,
    },
    {
        path: "/:lang( |ro|en)?/blog/:id",
        name: "blog.show",
        component: PostSingle,
    },
    {
        path: "/:lang( |ro|en)?/contact",
        name: "contact",
        component: Contact,
    },
    {
        path: "/:lang( |ro|en)?/login",
        name: "login",
        component: Login,
    },
    {
        path: "/:lang( |ro|en)?/reset-password",
        name: "reset",
        component: ResetPassword,
    },
    {
        path: "/:lang( |ro|en)?/set-password",
        name: "set-password",
        component: SetPassword,
    },
    {
        path: "/:lang?/register",
        name: "register",
        component: Register,
    },
    {
        path: "/:lang( |ro|en)?/about",
        name: "about",
        component: About,
    },
    {
        path: "/admin",
        name: "admin.index",
        component: Main,
        meta:{guarded:true}
    },
    {
        path: "/admin/my-account",
        name: "admin.account",
        component: AdminAccountIndex,
        meta:{guarded:true}
    },
    {
        path: "/admin/my-account/edit",
        name: "admin.account.edit",
        component: AdminAccountEdit,
        meta:{guarded:true}
    },
    /** Tag **/
    {
        path: "/admin/categories",
        name:"admin.category.index",
        component: AdminCategoryIndex,
        meta:{guarded:true}
    },

    {
        path: "/admin/categories/:id/edit",
        name:"admin.category.edit",
        component: AdminCategoryEdit,
        meta:{guarded:true}
    },
    {
        path: "/admin/categories/create",
        name:"admin.category.create",
        component: AdminCategoryCreate,
        meta:{guarded:true}
    },
    /** Tag **/
    {
        path: "/admin/tags",
        name:"admin.tag.index",
        component: AdminTagIndex,
        meta:{guarded:true}

    },

    {
        path: "/admin/tags/:id/edit",
        name:"admin.tag.edit",
        component: AdminTagEdit,
        meta:{guarded:true}
    },
    {
        path: "/admin/tags/create",
        name:"admin.tag.create",
        component: AdminTagCreate,
        meta:{guarded:true}
    },
    /** User **/
    {
        path: "/admin/users",
        name:"admin.user.index",
        component: AdminUserIndex,
        meta:{guarded:true}

    },

    {
        path: "/admin/users/:id/edit",
        name:"admin.user.edit",
        component: AdminUserEdit,
        meta:{guarded:true}
    },
    {
        path: "/admin/users/create",
        name:"admin.user.create",
        component: AdminUserCreate,
        meta:{guarded:true}
    },
    /** Post **/
    {
        path: "/admin/posts",
        name:"admin.post.index",
        component: AdminPostIndex,
        meta:{guarded:true}

    },

    {
        path: "/admin/posts/:id/edit",
        name:"admin.post.edit",
        component: AdminPostEdit,
        meta:{guarded:true}
    },
    {
        path: "/admin/posts/create",
        name:"admin.post.create",
        component: AdminPostCreate,
        meta:{guarded:true}
    },
    { path: "/:lang( |ro|en)?/404", name:'Page404', component: Page404 },
    { path: "/:any(.*)", redirect: "/404" },


];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        // always scroll to top
        return { top: 0 }
    },
});

router.beforeEach(async (to, from, next) => {
    if (to.meta.guarded) {
        const token = localStorage.getItem('TOKEN');
        /** если токена нет **/
        if (!token) {
            /** можно попасть только на страницу логина **/
            if (to.name === 'login') {
                return next();
            } else {
                /** иначе насильно перенаправить на логин **/
                return next({name: 'login'});
            }
        }
        else{
            if(!store.state.loggedIn){
                await me().then(res => {
                    if (res.status === 200) {
                        store.commit('setUser', res.data.user)
                    } else {
                        return next({name: 'login'})
                    }
                })
            }

        }

        /** если есть токен и маршрут логин то сразу ведем в админку**/
        if (to.name === 'login' && token) {

            return next({name: 'admin.index'})
        }



    }


    next();
})

export default router;
