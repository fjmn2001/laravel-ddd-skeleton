//css root
import './assets/css/app.scss'

//others
import {createApp} from "vue";
//import vSelect from 'vue-select'
import Select2 from './components/Select2.vue';
import App from "./App.vue";
import router from "./router";
import store from "./store";

//css overwrite
import 'bootstrap'
//import 'vue-select/dist/vue-select.css'

createApp(App)
    .use(store)
    .use(router)
    .component('select2', Select2)
    //.component('v-select', vSelect)
    .mount("#app");
