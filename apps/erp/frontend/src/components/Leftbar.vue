<template>
    <aside class="sidebar" role="navigation" style="overflow: visible;">
        <div class="scroll-sidebar" style="overflow: hidden;">
            <div class="user-profile">
                <div class="dropdown user-pro-body">
                    <div class="profile-image">
                        <img src="@/assets/images/user.jpg" alt="user-img" class="img-circle">
                    </div>
                    <p class="profile-text m-t-15 font-16"><a href="javascript:void(0);">José Pereira</a></p>
                </div>
            </div>
            <nav class="sidebar-nav">
                <ul id="side-menu" class="sub-menu-lateral sub-menu-compras" style="display: block;">
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="fa-fw icon-people"></i> <span class="hide-menu">Proveedores</span></a>
                    </li>
                    <li class="" style="padding-left: 0px;">
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="icon-basket-loaded fa-fw"></i> <span class="hide-menu">Compras<span
                            class="label label-rounded label-info pull-right">4</span></span></a>
                        <ul aria-expanded="false" style="height: 0px; margin-left: -30px;" class="collapse">
                            <li>
                                <a href="#">Proveedores</a>
                            </li>
                            <li>
                                <a href="#">Pedidos</a>
                                <ul aria-expanded="false" class="collapse" style="height: 0px;">
                                    <li>
                                        <a href="#">Directo</a>
                                    </li>
                                    <li>
                                        <a href="#">En línea</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Compras</a>
                            </li>
                            <li>
                                <a href="#">Pagos</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="fa-fw  icon-shield"></i> <span class="hide-menu">Seguros</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="fa-fw  icon-credit-card "></i> <span class="hide-menu">Transacciones</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="fa-fw   icon-docs"></i> <span class="hide-menu">Documentos</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="fa-fw  icon-chart "></i> <span class="hide-menu">Reportes</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="fa-fw  icon-settings "></i> <span class="hide-menu">Configuración</span></a>
                    </li>
                </ul>
                <ul id="side-menu" class="sub-menu-lateral sub-menu-ventas" style="display: none">
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="fa-fw icon-people"></i> <span class="hide-menu">Clientes</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="fa-fw  icon-bag"></i> <span class="hide-menu">Ventas</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="fa-fw   icon-notebook "></i> <span class="hide-menu">Cobros</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="fa-fw   icon-docs"></i> <span class="hide-menu">Documentos</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="fa-fw  icon-chart "></i> <span class="hide-menu">Reportes</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="fa-fw  icon-settings "></i> <span class="hide-menu">Configuración</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
export default {
    name: "Leftbar"
}
</script>

<style scoped>

</style>
