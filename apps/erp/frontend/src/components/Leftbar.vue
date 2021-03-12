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
            </div>
            <nav class="sidebar-nav">
                <ul id="side-menu" class="sub-menu-lateral sub-menu-compras" style="display: block;">
                    <li v-for="leftBarOption in leftBarOptions" :key="leftBarOption.name">
                        <router-link :to="{name: leftBarOption.name}" class="selected">
                            <i :class="leftBarOption.class"></i>
                            <span class="hide-menu"> {{ leftBarOption.title }}</span>
                        </router-link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
import {defineComponent} from 'vue'
import {useAuth} from "@/modules/auth/use/useAuth";
import {useMenu} from "@/use/useMenu";

export default defineComponent({
    setup() {
        const {user} = useAuth()
        const {leftBarOptions} = useMenu();

        return {
            user,
            leftBarOptions
        }
    }
})
</script>

<style scoped>

</style>
