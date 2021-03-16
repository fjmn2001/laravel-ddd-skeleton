<template>
    <aside class="sidebar" role="navigation" style="overflow: visible;">
        <div class="scroll-sidebar" style="overflow: hidden;">
            <div class="user-profile">
                <div class="dropdown user-pro-body">
                    <div class="profile-image">
                        <img src="@/assets/images/user.jpg" alt="user-img" class="img-circle">
                    </div>
                    <p class="profile-text m-t-15 font-16"><a href="javascript:void(0);" v-html="user?.name"></a></p>
                </div>
                <!--  --------------------Start loading user------------------------------------ -->
                <!--                <div class="dropdown user-pro-body">-->
                <!--                    <div class="profile-image">-->
                <!--                        <div class="preloader-ima-user-sider"></div>-->
                <!--                        <div class="preloader-text-user-sider"></div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!-- ----------------------------End   ------------------------------- -->
            </div>

            <nav class="sidebar-nav">
                <ul id="side-menu" class="sub-menu-lateral sub-menu-compras" style="display: block;"
                    v-show="!loadingLeftBar">
                    <li v-for="leftBarOption in leftBarOptions" :key="leftBarOption.name">
                        <router-link :to="{name: leftBarOption.name}"
                                     :class="{selected: isSelected(leftBarOption.name)}">
                            <i :class="leftBarOption.class"></i>
                            <span class="hide-menu"> {{ leftBarOption.title }}</span>
                        </router-link>
                    </li>
                </ul>
                <!--  --------------------Start loading menu------------------------------------ -->
                <ul class="sub-menu-lateral sub-menu-compras" v-show="loadingLeftBar">
                    <li class="pre-loader-sider-li">
                        <div class="pre-loader-sider-icon"></div>
                        <div class="pre-loader-sider-text"></div>
                    </li>
                    <li class="pre-loader-sider-li">
                        <div class="pre-loader-sider-icon"></div>
                        <div class="pre-loader-sider-text"></div>
                    </li>
                    <li class="pre-loader-sider-li">
                        <div class="pre-loader-sider-icon"></div>
                        <div class="pre-loader-sider-text"></div>
                    </li>
                    <li class="pre-loader-sider-li">
                        <div class="pre-loader-sider-icon"></div>
                        <div class="pre-loader-sider-text"></div>
                    </li>
                </ul>
                <!-- ----------------------------End   ------------------------------- -->
            </nav>
        </div>
    </aside>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import {useAuth} from "@/modules/auth/use/useAuth";
import {useMenu} from "@/use/useMenu";
import {useRoute} from "vue-router";

export default defineComponent({
    setup() {
        const {user} = useAuth()
        const {leftBarOptions, loadingLeftBar} = useMenu();
        const route = useRoute();

        function isSelected(name: string): boolean {
            return !!route.name && name.indexOf(route.name.toString()) !== -1;
        }

        return {
            user,
            leftBarOptions,
            loadingLeftBar,
            isSelected
        }
    }
})
</script>

<style scoped>

</style>
