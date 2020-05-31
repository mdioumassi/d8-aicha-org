(function($, D){

    $(document).ready(function(){

        if( $('.type--carousel').length ){

            $('.type--carousel').each(function(){
                var carousel = $(this);
                var slider = carousel.find('.content'),
                    sliderNav = carousel.find('.labels');

                $(slider).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    // fade: true,
                    asNavFor: sliderNav,
                    adaptiveHeight: true,
                    infinite: false,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                infinite: true
                            }
                        }
                    ]
                });
                $(sliderNav).slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    asNavFor: slider,
                    arrows: false,
                    dots: false,
                    //centerMode: true,
                    focusOnSelect: true,
                    centerPadding: 0,
                    variableWidth: true,
                    infinite: false,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3,
                                variableWidth: false,
                                centerMode: true,
                                infinite: true
                            }
                        }
                    ]
                });
            });


        }

        var menu = $('header .menu'),
            menuTop = menu.offset().top;

        if( $('.path-frontpage').length ){
            $('header .menu [data-drupal-link-system-path]').on('click',function(){
                var link = $(this),
                    anchor = link.attr('href').replace('/','');
                $('html, body').animate({scrollTop: $(anchor).offset().top}, 500);
            });
        }

        $(window).on('scroll', function(){
            var scrollTop = $(document).scrollTop(),
                windwowHeight = $(window).height();
            if( menuTop <= scrollTop ){
                menu.addClass('is-fixed');
            }else{
                menu.removeClass('is-fixed');
            }
            if( $('.path-frontpage').length ){
                $('header .menu [data-drupal-link-system-path="<front>"]').each(function(){
                    var link = $(this),
                        path = link.attr('href'),
                        anchor = path.replace('/','');
                    if( $(anchor).length ){
                        console.log(anchor);
                        var anchorTop = $(anchor).offset().top,
                            anchorHeight = $(anchor).outerHeight();
                        if( anchorTop - 100 <= scrollTop + windwowHeight / 2 && (anchorTop + anchorHeight) >= scrollTop + windwowHeight / 2){
                            menu.find('a[href="'+path+'"]').addClass('active');
                        }else{
                            menu.find('a[href="'+path+'"]').removeClass('active');
                        }
                    }
                });
            }
        });

    });

})(jQuery, Drupal);
