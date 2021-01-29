

    $('.desplegar-busqueda').click(function() {
        $(this).toggleClass('arrow-left').toggleClass('arrow-down');
    });

    $('.des-row').click(function() {
        $(this).toggleClass('icon-arrow-right').toggleClass('icon-arrow-down');
    });

    $('.inp-filter').each(function() {
        if($(this).val().length !== 0)
        {
           // $(this).addClass("inp-filter-val");
        }
    });



    //-------ocultar menu por partes-------------------------------

    function validateList02(){

        if($("#list02 > li").length == 0) {
            $('#iconList02').css('display','none');
        }else{
            $('#iconList02').css('display','block');
        }
    }

    function ocultarMenu(screenWidth){

        var liWidthAll = 400 ;
        var screenWidth = screenWidth;
        var lessWidth = 100;
        var minWidth = screenWidth - lessWidth;

        $(".menu-horizontal > li").each(function() {
            liWidthAll = liWidthAll + $(this).width();

            if(liWidthAll > minWidth){
                $(this).appendTo('#list02');
            }
        });
        mostrarMenu(minWidth)
        validateList02();
    }

    function mostrarMenu(minWidth){

        var liWidthAll = 400 ;
        var minWidth = minWidth;

        $(".menu-horizontal > li").each(function() {
            liWidthAll = liWidthAll + $(this).width();
        });

        $('ul#list02 > li').each(function() {
            var index = $(this).index() + 1;
            liWidthAll = liWidthAll + (100 * index);

            if(liWidthAll < minWidth){
                $(this).appendTo('#list01');

            }
        });

    }

    ocultarMenu(screen.width);
    ocultarMenu($('body').width());

    $(window).resize(function() {
        ocultarMenu(screen.width);
    });
    window.onresize = function(event) {
        ocultarMenu($('body').width());
    };

    //----------------------------------------------------------------


    $('.menu-link-med').click(function() {
        var idLi = $(this).attr('id');
        var idUl = '.sub-'+idLi;
        $('.sub-menu-lateral').css('display','none');
        $(idUl).css('display','block');
    });



    setTimeout(
        function(){
            $('.sidebartoggler i').addClass('fa fa-bars');
            $('.logo span').css('display','none');
            $('body').addClass("mini-sidebar");
            $('.scroll-sidebar').css('overflow','visible hidden');
            $('.sidebar').css('overflow','visible');

        }, 300);

        $('nav.sidebar-nav > ul').hover(
            function(){
                if ($('body.mini-sidebar').length === 1){
                    $('nav.sidebar-nav > ul li ul').css('margin-left','30px');
                    $('nav.sidebar-nav > ul li ul ').css('width','176px');
                    $('nav.sidebar-nav > ul li ul li').css('padding-left','0px');
                }
            },
            function(){
                if ($('body.mini-sidebar').length === 1) {

                    $('nav.sidebar-nav > ul li ul').css('margin-left', '-30px');
                    $('nav.sidebar-nav > ul li ul').css('width', 'auto');
                    $('nav.sidebar-nav > ul li ul li').css('padding-left', '60px');

                }
            }
        );

    $('#menu-config-collapse').on('click', function () {
        $('#menu-config').toggleClass('active');
    });

    $('.chk-dep-cat').on('click', function () {
        $('.depreciar-categoria').toggleClass('collapse');
    });

