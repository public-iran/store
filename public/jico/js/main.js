(function ($) {
    "use strict";
    /*--
    Commons Variables
    -----------------------------------*/
    var windows = $(window);

    /*--
        Menu Sticky
    -----------------------------------*/
    var sticky = $('.header-sticky');

    windows.on('scroll', function() {
        var scroll = windows.scrollTop();
        if (scroll < 300) {
            sticky.removeClass('is-sticky');
        }else{
            sticky.addClass('is-sticky');
        }
    });
    /*--
        Mobile Menu
    -----------------------------------*/
    $('#mobile-menu-trigger').on('click', function(){
        $('#offcanvas-mobile-menu').removeClass('inactive').addClass('active');
    });


    $('#offcanvas-menu-close-trigger').on('click', function(){
        $('#offcanvas-mobile-menu').removeClass('active').addClass('inactive');
    });
    /*--
        Offcanvas Menu
    -----------------------------------*/
    var $offCanvasNav = $('.offcanvas-navigation'),
        $offCanvasNavSubMenu = $offCanvasNav.find('.submenu2');

    /*Add Toggle Button With Off Canvas Sub Menu*/
    $offCanvasNavSubMenu.parent().prepend('<span class="menu-expand"><i></i></span>');

    /*Close Off Canvas Sub Menu*/
    $offCanvasNavSubMenu.slideUp();

    /*Category Sub Menu Toggle*/
    $offCanvasNav.on('click', 'li a, li .menu-expand', function(e) {
        var $this = $(this);
        if ( ($this.parent().attr('class').match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/)) && ($this.attr('href') === '#' || $this.hasClass('menu-expand')) ) {
            e.preventDefault();
            if ($this.siblings('ul:visible').length){
                $this.parent('li').removeClass('active');
                $this.siblings('ul').slideUp();
            } else {
                $this.parent('li').addClass('active');
                $this.closest('li').siblings('li').removeClass('active').find('li').removeClass('active');
                $this.closest('li').siblings('li').find('ul:visible').slideUp();
                $this.siblings('ul').slideDown();
            }
        }
    });

    /*--
        - Background Image
    ------------------------------------------*/
    var $backgroundImage = $('.bg-image');
    $backgroundImage.each(function() {
        var $this = $(this),
            $bgImage = $this.data('bg');
        $this.css('background-image', 'url('+$bgImage+')');
    });

    /*------------------------------
        Nice Select Active
    ---------------------------------*/
// $('select').niceSelect();

    /*--
        Sliders
    -----------------------------------*/
// Hero Slider
    $('.hero-slider').slick({
        infinite: true,
        fade: true,
        dots: true,
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    dots: true,
                    arrows: false,
                }
            },
        ]
    });
// Testimonial Slider
    $('.testimonial-slider').slick({
        infinite: true,
        fade: true,
        dots: true,
        arrows: false,
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    dots: true,
                    arrows: false,
                }
            },
        ]
    });
// Blog Slider
    $('.blog-slider').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
// Project Slider
    $('.product-slider').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        rows: 2,
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 1501,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    $('.product-slider-five').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        rows: 2,
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 1501,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    $('.list-product-slider').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        appendArrows: ".on-sale-nav",
        rows: 3,
        prevArrow: '<button class="slick-prev slick-btn"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next slick-btn"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 1501,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    $('.list-product-slider-two').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        appendArrows: ".latest-nav",
        rows: 3,
        prevArrow: '<button class="slick-prev slick-btn"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next slick-btn"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 1501,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    $('.list-product-slider-three').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        appendArrows: ".top-rated-nav",
        rows: 3,
        prevArrow: '<button class="slick-prev slick-btn"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next slick-btn"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 1501,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    $('.list-product-slider-four').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        appendArrows: ".top-rated-nav-two",
        rows: 3,
        prevArrow: '<button class="slick-prev slick-btn"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next slick-btn"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 1501,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    $('.product-slider-two').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 1501,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    $('.product-slider-three').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 1501,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    $('.countdown-product-slider').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 1501,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
// Blog Gallery Slider
    $('.blog-gallery-slider').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    arrows: false,
                    dots: false,
                }
            },
        ]
    });

    /*-----------------------------------
        Single Product Slide Menu Active
    --------------------------------------*/
    $('.product-details-images').each(function(){
        var $this = $(this);
        var $thumb = $this.siblings('.product-details-thumbs');
        $this.slick({
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            dots: false,
            infinite: true,
            centerMode: false,
            centerPadding: 0,
            asNavFor: $thumb,
        });
    });
    $('.product-details-thumbs').each(function(){
        var $this = $(this);
        var $details = $this.siblings('.product-details-images');
        $this.slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            dots: false,
            infinite: true,
            focusOnSelect: true,
            centerMode: true,
            centerPadding: 0,
            prevArrow: '<span class="slick-prev"><i class="fa fa-angle-right"></i></span>',
            nextArrow: '<span class="slick-next"><i class="fa fa-angle-left"></i></span>',
            asNavFor: $details,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                    }
                }
            ]

        });
    });
    /* Product Details 2 Images Slider */
    $('.product-details-images-2').each(function(){
        var $this = $(this);
        var $thumb = $this.siblings('.product-details-thumbs-2');
        $this.slick({
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            dots: false,
            infinite: true,
            centerMode: false,
            centerPadding: 0,
            asNavFor: $thumb,
        });
    });
    $('.product-details-thumbs-2').each(function(){
        var $this = $(this);
        var $details = $this.siblings('.product-details-images-2');
        $this.slick({
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            vertical:true,
            verticalSwiping:true,
            dots: false,
            infinite: true,
            focusOnSelect: true,
            centerMode: false,
            centerPadding: 0,
            prevArrow: '<span class="slick-prev"><i class="fa fa-angle-up"></i></span>',
            nextArrow: '<span class="slick-next"><i class="fa fa-angle-down"></i></span>',
            asNavFor: $details,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 2,
                    }
                }
            ]
        });
    });
    $('.slider-lg-image-box').slick({
        infinite: true,
        arrows: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-right"></i></button>',
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-left"></i></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });

    /*----------------------------------
        8. Instafeed active
    ------------------------------------*/
    if($('#Instafeed').length) {
        var feed = new Instafeed({
            get: 'user',
            userId: 6665768655,
            accessToken: '6665768655.1677ed0.313e6c96807c45d8900b4f680650dee5',
            target: 'Instafeed',
            resolution: 'low_resolution',
            limit: 6,
            template: '<li><a href="{{link}}" target="_new"><img src="{{image}}" /></a></li>',
        });
        feed.run();
    }

    /*-----------------------------------
        Price slider Active
    ----------------------------------*/
    $('#price-range').slider({
        range: true,
        min: 0,
        max: 1000,
        values: [ 0, 900 ],
        slide: function( event, ui ) {
            $('#price-amount').val(  ui.values[ 0 ]  + ' تومان ' + ' - ' + ui.values[ 1 ]   +  '  تومان '  );
        }
    });
    $('#price-amount').val( $('#price-range').slider( 'values', 0 ) + ' تومان ' + ' - ' +
         $('#price-range').slider('values', 1 ) + '  تومان ' );

    /*-----------------------------------
        Count Down Active
    ----------------------------------*/
    $('[data-countdown]:not(.pro-countdown-1)').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<div class="single-countdown-box"><span>%D</span>روز</div><div class="single-countdown-box"><span>%H</span>ساعت</div><div class="single-countdown-box"><span>%M</span>دقیقه</div><div class="single-countdown-box"><span>%S</span>ثانیه</div>'));
        });
    });
    $('[data-countdown].pro-countdown-1').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<div class="single-countdown-box-1"><span>%D</span>Day</div><div class="single-countdown-box-1"><span>%H</span>Hours</div><div class="single-countdown-box-1"><span>%M</span>Mins</div><div class="single-countdown-box-1"><span>%S</span>Secs</div>'));
        });
    });

    /*------------------------
        Sticky Sidebar Active
    -------------------------*/
    $('#sticky-sidebar').theiaStickySidebar({
        // Settings
        additionalMarginTop: 120
    })

    /*-----
        Quantity
    --------------------------------*/
    $('.pro-qty').prepend('<button class="dec qtybtn">-</button>');
    $('.pro-qty').append('<button class="inc qtybtn">+</button>');
    $('.qtybtn').on('click', function() {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });
    /* -------------------------
        Venobox Active
    * --------------------------*/
    $('.venobox').venobox({
        border: '10px',
        titleattr: 'data-title',
        numeratio: true,
        infinigall: true
    });
    /* --------------------------------------------------------
        FAQ Accordion
    * -------------------------------------------------------*/
    $('.card-header a').on('click', function() {
        $('.card').removeClass('actives');
        $(this).parents('.card').addClass('actives');
    });

    /*-----
        Shipping Form Toggle
    --------------------------------*/
    $('[data-shipping]').on('click', function(){
        if( $('[data-shipping]:checked').length > 0 ) {
            $('#shipping-form').slideDown();
        } else {
            $('#shipping-form').slideUp();
        }
    })

    /*-----
        Payment Method Select
    --------------------------------*/
    $('[name="payment-method"]').on('click', function(){

        var $value = $(this).attr('value');

        $('.single-method p').slideUp();
        $('[data-method="'+$value+'"]').slideDown();

    })

    /*------------------------------
        Nice Select Active
    ---------------------------------*/
    $('select').niceSelect();

    /*----------------------------------
        ScrollUp Active
    -----------------------------------*/
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

    /*--
        MailChimp
    -----------------------------------*/
    $('#mc-form').ajaxChimp({
        language: 'en',
        callback: mailChimpResponse,
        // ADD YOUR MAILCHIMP URL BELOW HERE!
        url: 'http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef'

    });
    function mailChimpResponse(resp) {

        if (resp.result === 'success') {
            $('.mailchimp-success').html('' + resp.msg).fadeIn(900);
            $('.mailchimp-error').fadeOut(400);

        } else if(resp.result === 'error') {
            $('.mailchimp-error').html('' + resp.msg).fadeIn(900);
        }
    }

    /*--
        Conatact Map
    -----------------------------------*/
    if($('.contact-map').length){
        function initialize() {
            var mapOptions = {
                zoom: 14,
                scrollwheel: false,
                center: new google.maps.LatLng(40.730610, -73.935242)
            };
            var map = new google.maps.Map(document.getElementById('contact-map'), mapOptions);
            var marker = new google.maps.Marker({
                position: map.getCenter(),
                map: map,
                animation: google.maps.Animation.BOUNCE
            });

        }
        google.maps.event.addDomListener(window, 'load', initialize);
    }

})(jQuery);