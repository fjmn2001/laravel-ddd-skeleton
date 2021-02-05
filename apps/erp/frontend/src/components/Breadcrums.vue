<template>
    <div class="div-title-table mt-4 row">
        <div
            class="align-items-center col-8 col-lg-9 col-md-8 col-sm-8 d-flex d-lg-flex d-md-flex d-sm-flex flex-column flex-lg-row flex-md-column flex-sm-column pl-2 pl-lg-4 pl-md-2">
            <h2 class="align-ítems-center d-flex d-inline mb-md-0 xtitle-table">{{ title }}</h2>
            <p class="ml-lg-4 ml-md-0 navigation pt-lg-2 pt-md-1">
                <router-link :to="{name: route.name}" class="font-weight-bolder" v-for="(route, i) in routes" :key="i">
                    <span v-if="i > 0">&nbsp;-&gt;&nbsp;</span>{{ route.title }}
                </router-link>
            </p>
        </div>
        <div class="align-items-center btn-sm col-4 col-lg-3 col-md-4 col-sm-4 d-flex justify-content-end">
            <div class="dropdown" v-if="menu.options && menu.options.length">
                <a class="btn mr-lg-2" role="button" id="dropdownMenu0" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" href="#"> <img
                    src="@/assets/images/icons/3puntos_V.svg"> </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu0">
                    <a class="dropdown-item" href="#">Pagar</a>
                    <a class="dropdown-item" href="#">Copiar</a>
                    <a class="dropdown-item" href="#">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Breadcrums",
    props: ['breadcrumb_url'],
    data() {
        return {
            title: 'Crear empresa',
            routes: [
                {url: '#', title: 'Empresa'},
                {url: '#', title: 'Crear'}
            ],
            menu: {
                name: 'ddd',
                url: '',
                options: []
            }
        };
    },
    mounted() {
        this.getBreadcrumbs()
    },

    methods: {
        getBreadcrumbs() {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.state.token;
            axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
            axios.post(this.breadcrumb_url, {
                name: this.$route.name
            }).then((response) => {
                this.title = response.data.title;
                this.routes = response.data.routes;
                this.menu = response.data.menu;
            });
        }
    }
}
</script>

<style scoped>

</style>
