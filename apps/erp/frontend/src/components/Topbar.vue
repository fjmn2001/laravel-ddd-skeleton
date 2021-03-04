<template>
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <div class="top-left-part">
                <a class="log-a logo" href="javascript:void(0)">
                    <b><img src="@/assets/images/company.jpg" alt="home"
                            class="logo" @click.prevent="toggleCompaniesList"></b> <span class="dropdown">
                    <a class="btn btn-block empresas-btn font-20 waves-effect waves-light" href="#"
                       @click.prevent="toggleCompaniesList" v-html="user?.company.name">
                    </a>
                    <ul class="animated dropdown-menu  dropdown-tasks slideInUp menu-empresas"
                        :class="{show: showCompaniesList}">
                                    <li v-for="company in user?.companies" :key="company.id">
                                        <img src="@/assets/images/MAKRO-01-1024x648.jpg" class="logo">
                                        <a href="javascript:void(0);" v-html="company.name"></a>
                                    </li>
                                </ul> </span> </a>
            </div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li class="icon-nav" style="margin-left: 5px;">
                    <a href="#" @click.prevent="toggleSidebar"
                       class="sidebartoggler font-20 waves-effect waves-light"><i
                        :class="{'fa fa-bars': !showSidebar, 'icon-arrow-left-circle': showSidebar}"></i></a>
                </li>
                <li class="icon-nav">
                    <router-link :to="{name: 'home'}" class="font-20"><i class="fa fa-home"/></router-link>
                </li>
                <li style="padding-top: 3px;">
                    <ul class="menu-horizontal" id="list01">
                        <li v-for="topBarOption in topBarOptions" :key="topBarOption.name">
                            <a class="nav-link menu-link-med"
                               :class="{'topMenuSelected': topBarOption.name === topBarOptionSelected}"
                               href="#"
                               @click.prevent="getLeftBarOptions(topBarOption.name)">
                                {{ topBarOption.title }}
                            </a>
                        </li>
                    </ul>
                </li>
                <li id="iconList02" style="display: none;">
                    <ul class="nav navbar-top-links">
                        <li class="dropdown">
                            <a class="font-20 waves-effect waves-light pl-2 pr-2" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false" href="javascript:void(0);"> <i
                                class="fa fa-chevron-circle-down"></i> </a>
                            <ul class="animated dropdown-menu dropdown-menu-left dropdown-tasks slideInUp"
                                id="list02">
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-top-links navbar-right pull-right">
                <li class="dropdown">
                    <a class="font-20 waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false" href="javascript:void(0);"> <i class="icon-options"></i> </a>
                    <ul class="animated dropdown-menu dropdown-menu-right dropdown-tasks slideInUp">
                        <li>
                            <a href="javascript:void(0);"><i class="icon-user fa-fw"></i> Perfil</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><i class="icon-drawar fa-fw"></i> Bandeja de entrada</a>
                        </li>
                        <hr>
                        <li class="right-side-toggle">
                            <a class="right-side-toggler waves-effect waves-light" href="javascript:void(0)"><i
                                class="icon-settings fa-fw"></i> Ajuste de sistema</a>
                        </li>
                        <hr>
                        <li>
                            <a href="#" @click.prevent="logout"><i class="icon-power fa-fw"></i> Cerrar sesión </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script lang="ts">
import $ from 'jquery';
import {defineComponent, ref, onMounted} from 'vue'
import {useAuth} from "@/modules/auth/use/useAuth";
import {useRouter} from "vue-router";
import {useMenu} from "@/use/useMenu";

export default defineComponent({
    setup() {
        const router = useRouter();
        const {destroyToken, user} = useAuth();
        const showSidebar = ref(false);
        const showCompaniesList = ref(false);
        const {getTopBarOptions, topBarOptions, getLeftBarOptions, topBarOptionSelected} = useMenu();

        onMounted(async () => {
            getTopBarOptions();
        });

        function logout() {
            destroyToken().then(() => {
                router.push({name: 'landing'});
            })
        }

        function toggleSidebar() {
            if (showSidebar.value) {
                showSidebar.value = false
                $('body').addClass('mini-sidebar')
            } else {
                showSidebar.value = true
                $('body').removeClass('mini-sidebar')
            }
        }

        function toggleCompaniesList() {
            showCompaniesList.value = !showCompaniesList.value;
        }

        return {
            user,
            showSidebar,
            showCompaniesList,
            topBarOptions,
            topBarOptionSelected,
            getLeftBarOptions,
            toggleSidebar,
            toggleCompaniesList,
            logout
        };
    }
})
</script>

<style scoped>
.topMenuSelected {
    color: white;
}
</style>
