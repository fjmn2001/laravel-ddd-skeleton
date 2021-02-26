//css root
import './assets/css/app.scss'

//others
import {createApp} from "vue";
//import vSelect from 'vue-select'
import App from "./App.vue";
import router from "./router";
import store from "./store";

//css overwrite
import 'bootstrap'
//import 'vue-select/dist/vue-select.css'

createApp(App)
    .use(store)
    .use(router)
    //.component('v-select', vSelect)
    .mount("#app");
