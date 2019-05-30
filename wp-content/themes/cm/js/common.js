jQuery(document).ready(function() {

    jQuery('.wpcf7-form-control-wrap.size #r_size input').on('change', function() {
        var plh = jQuery(this).val();
        jQuery('#id_lost').attr('placeholder', '0 ' + plh);
    });
    jQuery('.open-modal-black').on('click', function(e) {
        e.preventDefault();
        jQuery('#open_form').trigger('click');
    });
    // menu Stiky
    jQuery(window).scroll(function() {
        var scroll = jQuery(window).scrollTop();
        if (scroll >= 54) {
            jQuery(".site-header").addClass("stiky", 1000, "easeOutBounce");
            jQuery(".sfm-navicon-button").addClass("stiky", 1000, "easeOutBounce");
            jQuery(".utility-bar").css("margin-bottom", '79px');

        } else {
            jQuery(".site-header").removeClass("stiky", 1000, "easeOutBounce");
            jQuery(".sfm-navicon-button").removeClass("stiky", 1000, "easeOutBounce");
            jQuery(".utility-bar").css("margin-bottom", '0px');
        }
    });

    //menu responsive
    jQuery('.menu-toggle').on('click', function() {
        jQuery('.genesis-responsive-menu').toggleClass('on');
    });
    // element Stiky
    jQuery("._column").stick_in_parent({
        offset_top: 85
    });
    jQuery(document).ready(function() {


        var window_width = jQuery(window).width();

        if (window_width < 768) {
            jQuery("._column").trigger("sticky_kit:detach");
        } else {
            make_sticky();
        }

        jQuery(window).resize(function() {

            window_width = jQuery(window).width();

            if (window_width < 768) {
                jQuery("._column").trigger("sticky_kit:detach");
            } else {
                make_sticky();
            }

        });

        function make_sticky() {
            jQuery("._column").stick_in_parent({
                parent: '.c-row',
                offset_top: 85
            });
        }

    });

    /*Video Youtube*/
    if (jQuery('[data-video]').length) {
        jQuery('[data-video]').each(function() {
            var videoUrl = jQuery(this).attr('data-video');
            var widget = jQuery(this);

            widget.css({
                'background-image': 'url(https://img.youtube.com/vi/' + videoUrl + '/0.jpg)'
            });
        });
    }

    //magnific popup

    jQuery('.mg-popup').magnificPopup({
        delegate: 'a',
        type: 'image',
        callbacks: {
            elementParse: function(item) {
                // Function will fire for each target element
                // "item.el" is a target DOM element (if present)
                // "item.src" is a source that you may modify
                //console.log(item.el.context.className);
                if (item.el.context.className == 'video-link') {
                    item.type = 'iframe',
                        item.iframe = {
                            patterns: {
                                iframe: {
                                    markup: '<div class="mfp-iframe-scaler">' +
                                        '<div class="mfp-close"></div>' +
                                        '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                                        '</div>',

                                    srcAction: 'iframe_src',
                                },
                                youtube: {
                                    index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

                                    id: 'v=', // String that splits URL in a two parts, second part should be %id%
                                    // Or null - full URL will be returned
                                    // Or a function that should return %id%, for example:
                                    // id: function(url) { return 'parsed id'; } 

                                    src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe. 
                                },
                            }
                        }
                } else {
                    item.type = 'image',
                        item.tLoading = 'Loading image #%curr%...',
                        item.mainClass = 'mfp-img-mobile',
                        item.image = {
                            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
                        }
                }

            }
        },
        gallery: {
            enabled: false,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
    });

    jQuery('.youtube-popup').magnificPopup({
        delegate: 'a',
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false,
        gallery: {
            enabled: false,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
    });
    /************ slider video ****************/
    jQuery('.c-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: false,
        dots: true,
        //centerMode: true,
        //centerPadding: '150px',
        autoplay: true,
        autoplaySpeed: 2000,
        swipeToSlide: true,
        prevArrow: "<span class='arrow-circle sli-prev'><i class='fa fa-angle-left'></i></span>",
        nextArrow: "<span class='arrow-circle sli-next'><i class='fa fa-angle-right'></i></span>",
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    jQuery('.c-slider').each(function() {
        var c_slider = jQuery(this);
        c_slider.find('.sli-next').on('click', function() {
            c_slider.find('.slick-dots li:nth-child(1)').trigger('click');
        });
    });
    //page animate
    jQuery.fn.isInViewport = function() {
        var elementTop = jQuery(this).offset().top;
        var elementBottom = elementTop + jQuery(this).outerHeight();

        var viewportTop = jQuery(window).scrollTop();
        var viewportBottom = viewportTop + jQuery(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    jQuery(window).on('resize scroll', function() {
        jQuery('.to-top-animate').each(function() {
            var title_animate = jQuery(this);
            if (jQuery(this).isInViewport()) {
                title_animate.addClass("on");
            } else {
                title_animate.removeClass("on");
            }
        });
    });
    jQuery('.to-top-animate').each(function() {
        var title_animate = jQuery(this);
        if (jQuery(this).isInViewport()) {
            title_animate.addClass("on");
        } else {
            title_animate.removeClass("on");
        }
    });
    //* magnific popup */
    jQuery('.open-contact a').magnificPopup({
        type: 'inline',
        midClick: true,
    });
    jQuery('#open_form').magnificPopup({
        type: 'inline',
        midClick: true,
    });

    /* accordion */
    jQuery('#accordion .acd-header').each(function() {
        var acd_show = jQuery(this).attr('data-target');
        var parent_item = jQuery(this).parent();
        parent_item.attr('data-id', acd_show);
        if (parent_item.hasClass('on')) {
            jQuery(acd_show).hide(300);
        }
        jQuery(this).on('click', function() {
            jQuery('#accordion .item-accordion:not([data-id="' + acd_show + '"])').removeClass('on');
            jQuery('#accordion .acd-body:not(' + acd_show + ')').hide(300);
            parent_item.toggleClass('on');
            jQuery(acd_show).toggle(300);
        });
    });

    // custom input file
    jQuery('[data-open-file]').each(function() {
        var data_file = jQuery(this).attr('data-open-file');
        jQuery(this).on('click', function() {
            jQuery(data_file).click();
        });
    });
    jQuery('[data-file] input[type="file"]').each(function() {
        var Nafile = this.files.length;
        if (Nafile == 0) {
            jQuery(this).parent().parent().append('<span id="n_file">Ningún archivo elegido</span>');
        }
    });
    jQuery('[data-file] input[type="file"]').on('change', function() {
        var Nfile = this.files[0].name;
        jQuery(this).parent().parent().find('#n_file').text(Nfile);
    });

    // change radios
    jQuery('[data-radios] input[type="radio"]').each(function() {
        var txt_value = jQuery(this).val();
        txt_value = '0 ' + txt_value
        var t_input = jQuery(this).parent().parent().attr('data-radios');
        jQuery(this).on('change', function() {
            jQuery(t_input).attr('placeholder', txt_value);
        });

    });

    // AOS animation init
    if (jQuery('[data-aos]').length > 0) {
        AOS.init();
    }

    //map animation 
    function shakeIt() {
        jQuery('.pin-loc').each(function(i) {
            var $t = jQuery(this);
            setTimeout(function() {
                jQuery('.pin-loc').removeClass('on');
                $t.addClass('on');
            }, 6000 * i);
        });
    }
    shakeIt();
    setInterval(function() {
        shakeIt();
        jQuery('.pin-loc').removeClass('on');
    }, jQuery('.pin-loc').length * 6000);

    // Scrooling links/buttons to anywhere
    if (jQuery('[data-scroll-to]').length > 0) {
        console.log('scroll-to');
        jQuery('[data-scroll-to]').each(function(idx, el) {
            jQuery(el).click(function(e) {
                e.preventDefault();
                var target = jQuery(this).attr('data-scroll-to');
                if (target && jQuery(target).length > 0) {
                    var el_top = jQuery(target).offset().top - 85;
                    if (el_top < 0) {
                        el_top = 0;
                    }
                    jQuery('html, body').animate({
                        scrollTop: el_top
                    }, 600);
                }
            });
        });
    }

    /* countDownDate */
    var c_date = jQuery('#time');
    if (c_date) {
        var in_date = c_date.attr('data-date');
        // Set the date we're counting down to
        var countDownDate = new Date(in_date).getTime();
        // console.log(in_date);
        // var countDownDate = new Date("Jan 5, 2019 15:37:25").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="clock"
            c_date.html("<div class='count'>" + days + "<span>Días</span></div>" + "<div class='count'>" + hours + "<span>Horas</span></div>" + "<div class='count'>" + minutes + "<span>Minutos</span></div>" + "<div class='count'>" + seconds + "<span>Segundos</span></div>");

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                c_date.html("<div class='count'>0<span>Días</span></div>" + "<div class='count'>0<span>Horas</span></div>" + "<div class='count'>0<span>Minutos</span></div>" + "<div class='count'>0<span>Segundos</span></div>");
            }
        }, 1000);
    }

    jQuery('.page-template-courses-template .site-inner .widget-wrap h3').click(function () {
        jQuery(this).parent().find('div').slideToggle( 'slow', function(){
          console.log('slow');
       });
    })

});