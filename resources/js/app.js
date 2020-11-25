/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from "vue";

// Vue-multiselect
import Multiselect from "vue-multiselect";
Vue.component("multiselect", Multiselect);

// v-calendar
import VCalendar from "v-calendar";
Vue.use(VCalendar);

// tooltip
import Tooltip from "vue-directive-tooltip";
import "vue-directive-tooltip/dist/vueDirectiveTooltip.css";
Vue.use(Tooltip, {
    delay: 0,
    triggers: ["hover", "focus"],
    offset: 5
});

// Axios
window.axios = require("axios");
// axios.defaults.baseURL = "http://localhost:8080/project-2/public/";
axios.defaults.baseURL = "https://bkacad.xyz/";

// Vue-router
import VueRouter from "vue-router";
Vue.use(VueRouter);

import routes from "./routes.js";

const router = new VueRouter({
    base: "bkacad.xyz",
    // base: "bkacad.xyz",
    routes,
    mode: "history",
    scrollBehavior(to, from, savedPosition) {
        if (to.params.ma_cau_hinh) {
            document.getElementById("form_update_cau_hinh").scrollIntoView({
                behavior: "smooth",
                block: "end",
                inline: "nearest"
            });
        } else if (to.params.ma_nguoi_dung) {
            document.getElementById("form_update_profile").scrollIntoView({
                behavior: "smooth",
                block: "end",
                inline: "nearest"
            });
        } else if (to.params.ma_lab) {
            document.getElementById("form_update_lab").scrollIntoView({
                behavior: "smooth",
                block: "end",
                inline: "nearest"
            });
        }
    }
});

// Vuex
import store from "./store/store.js";

// Vue good table
import VueGoodTablePlugin from "vue-good-table";
import "vue-good-table/dist/vue-good-table.css";
Vue.use(VueGoodTablePlugin);

// Vue nofify
import Notifications from "vue-notification";
Vue.use(Notifications);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "navbar-component",
    require("./layout/NavbarComponent.vue").default
);
Vue.component(
    "sidebar-component",
    require("./layout/SidebarComponent.vue").default
);
Vue.component(
    "footer-component",
    require("./layout/FooterComponent.vue").default
);
Vue.component("login-component", require("./views/LoginComponent.vue").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
    store
});
