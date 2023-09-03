import './bootstrap';

import Notifications from '@kyvg/vue3-notification'


import {createApp} from 'vue'


import VueSweetalert2 from 'vue-sweetalert2';

import Vue3Editor from "vue3-editor";

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

import { createStore } from 'vuex'

// Create a new store instance.
import store from "./store/index.js";

import App from './App.vue'
import router from './router'

createApp(App).use(Vue3Editor).use(router).use(Notifications).use(VueSweetalert2).use(store).mount("#app")
