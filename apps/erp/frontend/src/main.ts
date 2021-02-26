import Vue from 'vue'

Vue.config.productionTip = false
Vue.component('v-select', vSelect)

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
