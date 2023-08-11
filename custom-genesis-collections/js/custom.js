jQuery(document).ready(function ($) {
    $(window).on("resize orientationchange", function () {
        // Slider Leadership
        $(".module_leadership .slider_slick").each(function () {
            var $carousel = $(this);
            if ($(window).width() > 1024) {
                if ($carousel.hasClass("slick-initialized")) {
                    $carousel.slick("unslick");
                }
            } else {
                if (
                    !$carousel.hasClass("slick-initialized") && this.querySelectorAll(".card_profile").length >= 2) {
                    $carousel.slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        mobileFirst: true,
                        infinite: false,
                        speed: 500,
                        arrows: false,
                        centerMode: false,
                        autoplay: false,
                        responsive: [
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 1,
                                },
                            },
                        ],
                    });
                }
            }
        });
    });
    // Popup Video Modal js Created By: RubicoTech
    $(".btn-video").on("click", function () {
        var videoUrl = $(this).attr("data-videoUrl") + "?autoplay=1";
        var videoType = $(this).attr("data-videoType");
        $(".lightbox-wrapper").fadeIn(1000);

        if (videoType == "youtube" || videoType == "vimeo") {
            //	if ($(window).width() > 960) {
            jQuery(".video-iframe").attr("src", videoUrl);
            jQuery(".video-iframe").attr("title", videoType);

            jQuery(".video-iframe").show();
            jQuery(".video-html5").hide();
        } else {
            jQuery(".video-html5").show();
            jQuery(".video-iframe").hide();
            jQuery(".video-html5").get(0).pause();
            jQuery(".video-html5 .mp4video").attr("src", videoUrl);
            jQuery(".video-html5 .mp4video").attr("type", videoType);
            jQuery(".video-html5").get(0).load();
            jQuery(".video-html5").get(0).play();
        }
    });
    $("#close-btn").on("click", function () {
        $(".lightbox-wrapper").fadeOut(500);
        $(".lightbox-wrapper iframe").attr("src", "");
        $(".lightbox-wrapper .video-html5").get(0).pause();
    });
    // Search Opener
    $(".search-opener").on("click", function () {
        $(this).toggleClass("active");
        $(".search-wrapper").toggleClass("active-search");
        // body overlay
        // $("body").toggleClass("body-overlay");
    });
    $("body").on("click", function (e) {
        if ($(e.target).parent().find("#masthead").length === 1) {
            $(".search-open-with-item .search-opener").removeClass("active");
            $(".search-wrap .search-inner-wrap").removeClass("active-search");
            // body overlay
            $("body").removeClass("body-overlay");
        }
    });
    // Accordion
    $(".only-first-opened .wrap_accordion.first_opened .accor_set:first-child .accor_content").show(500);
    $(".only-first-opened .wrap_accordion.first_opened .accor_set:first-child").addClass("active");
    $(".all-opened .wrap_accordion.first_opened .accor_set .accor_content").show(500);
    $(".all-opened .wrap_accordion.first_opened .accor_set").addClass("active");
    $(".all-closed .accordion_right .accor_set > a").on("click", function () {
        if ($(this).parents("section").hasClass("close-others")) {
            $(this).parent(".accor_set").toggleClass("active");
            $(this).siblings(".accor_content").slideToggle(500);
            $(this).parent().siblings().children(".accor_content").slideUp(500);
            $(this).parent().siblings().removeClass("active");
        } else {
            $(this).parent(".accor_set").toggleClass("active");
            $(this).siblings(".accor_content").slideToggle(500);
        }
    });
    $(".only-first-opened .accordion_right .accor_set > a").on(
        "click",
        function () {
            if ($(this).parents("section").hasClass("close-others")) {
                $(this).parent(".accor_set").toggleClass("active");
                $(this).siblings(".accor_content").slideToggle(500);
                $(this).parent().siblings().children(".accor_content").slideUp(500);
                $(this).parent().siblings().removeClass("active");
            } else {
                $(this).parent(".accor_set").toggleClass("active");
                $(this).siblings(".accor_content").slideToggle(500);
            }
        }
    );
    $(".all-opened .accordion_right .accor_set > a").on("click", function () {
        if ($(this).parents("section").hasClass("close-others")) {
            $(this).parent(".accor_set").toggleClass("active");
            $(this).siblings(".accor_content").slideToggle(500);
            $(this).parent().siblings().children(".accor_content").slideUp(500);
            $(this).parent().siblings().removeClass("active");
        } else {
            $(this).parent(".accor_set").toggleClass("active");
            $(this).siblings(".accor_content").slideToggle(500);
        }
    });
    // Set Time Out for Admin
    $(window).on("resize orientationchange", function () {
        // SetTimeOut for Tabs and Eyebrow Animation
        setTimeout(function () {
            // Slider Leadership
            $(".module_leadership .slider_slick").each(function () {
                var $carousel = $(this);
                if ($(window).width() > 1024) {
                    if ($carousel.hasClass("slick-initialized")) {
                        $carousel.slick("unslick");
                    }
                } else {
                    if (
                        !$carousel.hasClass("slick-initialized") &&
                        this.querySelectorAll(".card_profile").length >= 2
                    ) {
                        $carousel.slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true,
                            mobileFirst: true,
                            infinite: false,
                            speed: 500,
                            arrows: false,
                            centerMode: false,
                            autoplay: false,
                            responsive: [
                                {
                                    breakpoint: 767,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 1,
                                    },
                                },
                            ],
                        });
                    }
                }
            });
        }, 100);
    });
    // Slider in Lightbox
    $(".card_profile.btn-modal").on("click", function ($event) {
        $event.preventDefault();
        $(".dialog-model").show();
        var dialogModel = document.querySelector(".dialog-model .slick_wrap");
        var cardProfileOriginal = $event.currentTarget.closest(
            ".slider_slick.slider_lightbox"
        );
        var cardProfile = cardProfileOriginal.cloneNode(true);

        var currentCardProfileEle = $($event.target).parents(".card_profile")[0];
        var parentElement = currentCardProfileEle.parentElement;
        var initialSlide = 0;
        for (var index = 0; index < parentElement.children.length; index++) {
            if (parentElement.children.item(index) === currentCardProfileEle) {
                initialSlide = index;
            }
        }

        if ($(cardProfileOriginal).hasClass("slick-initialized")) {
            var skipKeys = ["appendArrows", "appendDots", "customPaging"];
            var options = {};
            var slickOptions = $(cardProfileOriginal).slick("getSlick").options;
            for (var optionKey of Object.keys(slickOptions)) {
                if (skipKeys.includes(optionKey)) {
                    continue;
                }

                options[optionKey] = slickOptions[optionKey];
            }

            $(cardProfileOriginal).slick("unslick");
            cardProfile = cardProfileOriginal.cloneNode(true);
            options.initialSlide = initialSlide;
            $(cardProfileOriginal).slick(options);
        }

        dialogModel.innerHTML = cardProfile.outerHTML;
        var sliderGroup = $(".dialog-model .slider_lightbox");
        sliderGroup.removeClass("slider_slick");

        sliderGroup.slick({
            arrows: true,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            accessibility: true,
            autoplay: false,
            autoplaySpeed: 3000,
            dots: true,
            mobileFirst: true,
            centerMode: false,
            initialSlide: initialSlide,
        });
    });
    $(".btn_exit").on("click", function ($event) {
        $event.preventDefault();
        $(".dialog-model").hide();
    });
    window.dispatchEvent(new UIEvent("resize"));
});

// Fixed header for home page
jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 30) {
        jQuery("header.site-header").addClass("header-with-bg");
    } else {
        jQuery("header.site-header").removeClass("header-with-bg");
    }
});

/* =====================================================
JS for Example =====================================*/
jQuery(document).ready(function ($) {
    // Generic Slider
    $(".slider_generic").each((index, element) => {
        if ($(element).find(".slider-info").length > 1) {
            $(element)
                .not(".slick-initialized")
                .slick({
                    dots: true,
                    infinite: true,
                    speed: 500,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: false,
                    mobileFirst: true,
                    accessibility: true,
                    autoplay: true,
                    autoplaySpeed:
                        $(element).find(".slider-info").first().data("time") || 8000,
                    arrows: false,
                });
        }
    });
    // Brand (Image Carousel)
    $(".brand-carousel").each(function (index, element) {
        var slider = $(element);
        if (slider.not(".slick-initialized")) {
            var slideScrollNum = parseInt(slider.data("slides-to-scroll")) || 1;
            slider.slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 3,
                slidesToScroll: slideScrollNum,
                centerMode: false,
                mobileFirst: true,
                accessibility: true,
                autoplay: true,
                autoplaySpeed: $(element).find(".brand-items").first().data("time") || 8000,
                arrows: false,
            });
        }
    });
    $(".brand-carousel-mob").each((index, element) => {
        if ($(element).find(".brand-items").length > 3) {
            $(element).not(".slick-initialized").slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesPerRow: 1,
                rows: 3,
                centerMode: false,
                mobileFirst: true,
                accessibility: true,
                autoplay: true,
                autoplaySpeed: $(element).find(".brand-items").first().data("time") || 8000,
                arrows: false,
            });
        }
    });
    // Featured Carousel
    $(".carousel-featured").not(".slick-initialized").each((index, element) => {
        $(element).slick({
            vertical: true,
            verticalSwiping: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            centerMode: true,
            infinite: true,
            adaptiveHeight: true,
            autoplay: true,
            autoplaySpeed: 2000,
            pauseOnHover: false,
            pauseOnFocus: false,
            speed: 500,
        });
    });
    $(".wrap-info-featured").not(".slick-initialized").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        centerMode: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: false,
        pauseOnFocus: false,
        speed: 500,
    });
    // Stat Carousel
    $(".info-callout-slider").each((index, element) => {
        if ($(element).find(".item").length > 2) {
            $(element)
                .not(".slick-initialized")
                .slick({
                    dots: true,
                    infinite: true,
                    autoplaySpeed: $(element).find(".item").first().data("time") || 8000,
                    speed: 500,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: false,
                    mobileFirst: true,
                    autoplay: true,
                    arrows: false,
                    responsive: [
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
                            },
                        },
                    ],
                });
        }
    });
    // Testimonial Slider
    $(".slider_testimonials").each((index, element) => {
        if ($(element).find(".testimonial-info").length > 1) {
            $(element).not(".slick-initialized").slick({
                arrows: false,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                accessibility: true,
                autoplay: true,
                autoplaySpeed: $(element).find(".testimonial-info").first().data("time") || 8000,
                dots: true,
                mobileFirst: true,
                centerMode: false,
            });
        }
    });
    // Animation on Scroll
    AOS.init();
    // For Admin Section
    $(window).on("load resize orientationchange", function () {
        setTimeout(function () {
            // Generic Slider
            $(".slider_generic").each((index, element) => {
                if ($(element).find(".slider-info").length > 1) {
                    $(element)
                        .not(".slick-initialized")
                        .slick({
                            dots: true,
                            infinite: true,
                            speed: 500,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: false,
                            mobileFirst: true,
                            accessibility: true,
                            autoplay: true,
                            autoplaySpeed:
                                $(element).find(".slider-info").first().data("time") || 8000,
                            arrows: false,
                        });
                }
            });
            // Stat Carousel
            $(".info-callout-slider").each((index, element) => {
                if ($(element).find(".item").length > 2) {
                    $(element)
                        .not(".slick-initialized")
                        .slick({
                            dots: true,
                            infinite: true,
                            autoplaySpeed:
                                $(element).find(".item").first().data("time") || 8000,
                            speed: 500,
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            centerMode: false,
                            mobileFirst: true,
                            autoplay: true,
                            arrows: false,
                        });
                }
            });
            // Featured Carousel
            $(".carousel-featured").not(".slick-initialized").slick({
                vertical: true,
                verticalSwiping: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: false,
                centerMode: true,
                infinite: true,
                adaptiveHeight: true,
                autoplay: true,
                autoplaySpeed: 2000,
                pauseOnHover: false,
                pauseOnFocus: false,
                speed: 500,
            });
            $(".wrap-info-featured").not(".slick-initialized").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                centerMode: false,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 5000,
                pauseOnHover: false,
                pauseOnFocus: false,
                speed: 500,
            });
            // Testimonial Slider
            $(".slider_testimonials").each((index, element) => {
                if ($(element).find(".testimonial-info").length > 1) {
                    $(element).not(".slick-initialized").slick({
                        arrows: false,
                        infinite: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        accessibility: true,
                        autoplay: true,
                        autoplaySpeed: $(element).find(".testimonial-info").first().data("time") || 8000,
                        dots: true,
                        mobileFirst: true,
                        centerMode: false,
                    });
                }
            });
            // Brand (Image Carousel)
            $(".brand-carousel").each(function (index, element) {
                var slider = $(element);
                if (slider.not(".slick-initialized")) {
                    var slideScrollNum = parseInt(slider.data("slides-to-scroll")) || 1;
                    slider.slick({
                        dots: true,
                        infinite: true,
                        speed: 500,
                        slidesToShow: 3,
                        slidesToScroll: slideScrollNum,
                        centerMode: false,
                        mobileFirst: true,
                        accessibility: true,
                        autoplay: true,
                        autoplaySpeed: $(element).find(".brand-items").first().data("time") || 8000,
                        arrows: false,
                    });
                }
            });
            $(".brand-carousel-mob").each((index, element) => {
                if ($(element).find(".brand-items").length > 3) {
                    $(element).not(".slick-initialized").slick({
                        dots: true,
                        infinite: true,
                        speed: 500,
                        slidesPerRow: 1,
                        rows: 3,
                        centerMode: false,
                        mobileFirst: true,
                        accessibility: true,
                        autoplay: true,
                        autoplaySpeed:
                            $(element).find(".brand-items").first().data("time") || 8000,
                        arrows: false,
                    });
                }
            });
            // Background Height for Leadership
            var matchHeight = (function () {
                function init() {
                    eventListeners();
                    matchHeight();
                }

                function eventListeners() {
                    jQuery(window).on("resize", function () {
                        matchHeight();
                    });
                }

                function matchHeight() {
                    var groupName = jQuery("[data-match-height]");
                    var groupHeights = [];
                    groupName.css("min-height", "auto");
                    groupName.each(function () {
                        groupHeights.push(jQuery(this).outerHeight());
                    });
                    var maxHeight = Math.max.apply(null, groupHeights);
                    groupName.css("min-height", maxHeight);
                }

                return {
                    init: init,
                };
            })();
            matchHeight.init();
        }, 100);
    });
});

jQuery(document).ready(function () {
    // navigation for mobile and iPad
    if (jQuery(window).width() <= 1000) {
        jQuery(".top-navigation .drawer-navigation ul > li .sub-menu").after(
            "<span class='opener-label-menu'><i class='gbi gbicon-angle-down'></i></span>"
        );
        jQuery(".top-navigation .drawer-navigation ul > li .sub-menu").before(
            "<span class='inner-back-label hide-nav'><i class='gbi gbicon-angle-down'></i></span>"
        );
        jQuery(".top-navigation .drawer-navigation .opener-label-menu").click(
            function () {
                jQuery(this).parents().eq(0).addClass("show-nav");
                jQuery(this).parents().eq(0).siblings().addClass("hide-nav");
                jQuery(this).prev().addClass("show-nav");
                jQuery(".opener-label-menu").addClass("hide-nav");
                jQuery(this).prev().prev().addClass("show-nav");
            }
        );
        jQuery(".top-navigation .drawer-navigation .inner-back-label").click(
            function () {
                jQuery(this).parents().eq(0).removeClass("show-nav");
                jQuery(this).parents().eq(0).siblings().removeClass("hide-nav");
                jQuery(this).removeClass("show-nav");
                jQuery(this).next().removeClass("show-nav");
                jQuery(".opener-label-menu").removeClass("hide-nav");
                jQuery(this).prev().prev().removeClass("show-nav");
            }
        );
    }
    // Background Height for Leadership
    var matchHeight = (function () {
        function init() {
            eventListeners();
            matchHeight();
        }

        function eventListeners() {
            jQuery(window).on("resize", function () {
                matchHeight();
            });
        }

        function matchHeight() {
            var groupName = jQuery("[data-match-height]");
            var groupHeights = [];
            groupName.css("min-height", "auto");
            groupName.each(function () {
                groupHeights.push(jQuery(this).outerHeight());
            });
            var maxHeight = Math.max.apply(null, groupHeights);
            groupName.css("min-height", maxHeight);
        }

        return {
            init: init,
        };
    })();
    matchHeight.init();
});

// ********************************************************************//
// ************************ People Attributes Start ******************//
// ******************************************************************//
jQuery(document).ready(function ($) {
    $(".pa-btn").on("click", function () {
        $(".pa-modal").show();
        $("body").addClass("scroll-hide");
        if ($(window).width() > 768) {
            $("html,body").animate(
                {
                    scrollTop: $(".module_pepole-attribute").offset().top + 20,
                },
                "slow"
            );
        }
        let targetModal = $(this).attr("data-modal-target");
        $(targetModal).addClass("pa-show_modal");
    });

    $(".pa-btn-wrapper button").on("click", function () {
        $("body").removeClass("scroll-hide");
        $(".pa-modal_container").removeClass("pa-show_modal");
        setTimeout(function () {
            $(".pa-modal").hide();
        }, 500);
    });
});
// ********************************************************************//
// ************************ People Attributes End ********************//
// ******************************************************************//

// ********************************************************************//
// ******************** Text media with scroll Start *****************//
// ******************************************************************//
jQuery(document).ready(function ($) {
    $(".tmws_intro-wrapper").css("top", $("#masthead").height() + 70);
});
// ********************************************************************//
// ******************** Text media with scroll end *******************//
// ******************************************************************//

// CTF7 Class Injector - required for CT7 v5.6.3
jQuery(document).ready(function ($) {
    $('span[data-name="how-did-you-hear-about-us"]').addClass(
        "how-did-you-hear-about-us"
    );
    $('span[data-name="interested-in"]').addClass("interested-in");
});
