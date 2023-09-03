import {createStore} from "vuex";

import config from "../config.js";
 const store =  createStore({
    state () {
        return {
            user: {},
            loggedIn:false,
            lang:localStorage.getItem('lang')|| config.lang
        }
    },
    mutations: {
        setUser (state,userObj) {
            state.user = userObj;
            state.loggedIn =  true;
        },
        logoutUser (state) {
            state.user = {};
            state.loggedIn =  false
        },
        setLang(state,lang){
            state.lang = lang;

            localStorage.setItem('lang',lang)

        }
    }
})


export default store;
