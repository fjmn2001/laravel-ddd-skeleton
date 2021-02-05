<template>
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <div class="top-left-part">
                <a class="logo" href="javascript:void(0)"> <b> <img src="@/assets/images/logo-M.svg" alt="home">
                </b> <span
                    style=""> <img src="@/assets/images/logo-text-erp.svg" alt="homepage" class="dark-logo"
                                   id="ima-logo-text"> </span> </a>
            </div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li class="icon-nav" style="margin-left: 5px;">
                    <a href="javascript:void(0)" class="sidebartoggler font-20 waves-effect waves-light"><i
                        class="icon-arrow-left-circle"></i></a>
                </li>
                <li class="icon-nav">
                    <a href="javascript:void(0)" class="font-20"><i class="fa fa-home"></i></a>
                </li>
                <li style="padding-top: 3px;">
                    <ul class="menu-horizontal" id="list01">
                        <li>
                            <a class="nav-link menu-link-med" id="menu-compras"
                               href="javascript:void(0)">Compras</a>
                        </li>
                        <li>
                            <a class="nav-link menu-link-med" id="menu-ventas" href="javascript:void(0)">Ventas</a>
                        </li>
                        <li>
                            <a class="nav-link" href="#">Inventario</a>
                        </li>
                        <li>
                            <a class="nav-link" href="#">Contabilidad</a>
                        </li>
                        <li>
                            <a class="nav-link" href="#">Contratos</a>
                        </li>
                        <li>
                            <a class="nav-link" href="#">Empresas</a>
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

<script>
export default {
    name: "Topbar",
    methods: {
        logout() {
            this.$store.dispatch('destroyToken').then(() => {
                this.$router.push({name: 'landing'});
            })
        }
    }
}
</script>

<style scoped>

</style>
