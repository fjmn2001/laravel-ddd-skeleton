<template>

  <div class="div-title-table justify-content-between row">
    <div class="col-8 col-lg-9 col-md-8 d-flex d-lg-flex d-md-flex d-sm-flex flex-column flex-lg-row flex-md-column flex-sm-column pl-3 pl-lg-4 pl-md-3 pt-md-2">
      <h2 class="d-inline mb-md-0 xtitle-table" style="margin-left: 7px;">{{ title }}</h2>
      <p class="ml-lg-4 ml-md-2 ml-sm-2 navigation pt-lg-2 pt-md-1">
        <router-link :to="{name: route.name}" class="font-weight-bolder" v-for="(route, i) in routes" :key="i">
          <i class="fa fa-long-arrow-right i-navigation" v-if="i > 0"></i>{{ route.title }}
        </router-link>
      </p>
    </div>
    <div class="align-items-center btn-sm col-4 col-lg-3 col-md-4 col-sm-4 d-flex justify-content-end">
      <router-link class="btn btn-blue-deg btn-sm mr-1 mr-lg-5" :to="{name: menu.name}"
                   style="padding-left: 16px; padding-right: 16px;" v-if="menu.name">{{ menu.title }}
      </router-link>
      <div class="dropdown" v-if="menu.options && menu.options.length">
        <a class="btn mr-lg-2" role="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"> <img src="@/assets/images/icons/3puntos_V.svg"> </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu0">
          <a class="dropdown-item" href="#" :id="option.id" v-for="option in menu.options"
             :key="option.id">{{ option.title }}</a>
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
            title: '',
            routes: [],
            menu: {}
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
                name: this.$route.name,
                params: this.$route.params
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
