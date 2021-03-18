<template>
    <div id="app" class="bg-body font-weight-bold">
        <div id="wrapper">
            <topbar v-if="route.meta.requiresAuth"></topbar>
            <leftbar v-if="route.meta.requiresAuth"></leftbar>
            <router-view v-if="user"/>
        </div>
    </div>
</template>

<script>
import $ from 'jquery'
import {defineComponent, onMounted} from 'vue'
import {useRoute, useRouter} from 'vue-router'
import Topbar from "@/components/Topbar";
import Leftbar from "@/components/Leftbar";
import {useAuth} from "@/modules/auth/use/useAuth";

export default defineComponent({
    components: {Leftbar, Topbar},
    setup() {
        const {getUser, user} = useAuth();
        const route = useRoute();
        const router = useRouter();

        //jquery de Jose
        function myLegacy() {
            $('.desplegar-busqueda').click(function () {
                $(this).toggleClass('arrow-left').toggleClass('arrow-down');
            });

            // $('.des-row').click(function () {
            //     $(this).toggleClass('icon-arrow-right').toggleClass('icon-arrow-down');
            // });
            //
            // $('.inp-filter').each(function () {
            //     if ($(this).val().length !== 0) {
            //         // $(this).addClass("inp-filter-val");
            //     }
            // });


            //-------ocultar menu por partes-------------------------------

            function validateList02() {

                if ($("#list02 > li").length == 0) {
                    $('#iconList02').css('display', 'none');
                } else {
                    $('#iconList02').css('display', 'block');
                }
            }

            function mostrarMenu(minWidth) {
                let liWidthAll = 400;

                $(".menu-horizontal > li").each(function () {
                    liWidthAll = liWidthAll + $(this).width();
                });

                $('ul#list02 > li').each(function () {
                    const index = $(this).index() + 1;
                    liWidthAll = liWidthAll + (100 * index);

                    if (liWidthAll < minWidth) {
                        $(this).appendTo('#list01');

                    }
                });
            }

            function ocultarMenu(screenWidth) {
                let liWidthAll = 400;
                const lessWidth = 100;
                const minWidth = screenWidth - lessWidth;

                $(".menu-horizontal > li").each(function () {
                    liWidthAll = liWidthAll + $(this).width();

                    if (liWidthAll > minWidth) {
                        $(this).appendTo('#list02');
                    }
                });
                mostrarMenu(minWidth)
                validateList02();
            }

            ocultarMenu(screen.width);
            ocultarMenu($('body').width());

            $(window).resize(function () {
                ocultarMenu(screen.width);
            });
            window.onresize = function () {
                ocultarMenu($('body').width());
            };

            //----------------------------------------------------------------


            $('#menu-config-collapse').on('click', function () {
                $('#menu-config').toggleClass('active');
            });

            $('.chk-dep-cat').on('click', function () {
                $('.depreciar-categoria').toggleClass('collapse');
            });
        }

        onMounted(async () => {
            try {
                await getUser();
                myLegacy()
            } catch (e) {
                console.log(e);
                router.push({name: 'auth.login'})
            }
        });

        return {
            route,
            user
        }
    }
});
</script>

<style scoped>

</style>
