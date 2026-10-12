/*=====================================================
Template Name   : Taxica
Description     : Online Taxi Service HTML5 Template
Author          : LunarTemp
Version         : 1.0
=======================================================*/

(function ($) {
    "use strict";

    // --------------------------
    // Multi level dropdown menu
    // --------------------------
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
        }
        $(this).next('.dropdown-menu').toggleClass('show');
        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function () {
            $('.dropdown-submenu .show').removeClass('show');
        });
        return false;
    });

    // --------------------------
    // Data-background
    // --------------------------
    $("[data-background]").each(function () {
        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
    });

    // --------------------------
    // Navbar search toggle
    // --------------------------
    $('.search-btn').on('click', function () {
        $('.search-area').toggleClass('open');
    });

    // --------------------------
    // Sidebar popup toggle
    // --------------------------
    $('.sidebar-btn').on('click', function () {
        $('.sidebar-popup, .sidebar-wrapper').addClass('open');
    });
    $('.close-sidebar-popup, .sidebar-popup').on('click', function () {
        $('.sidebar-popup, .sidebar-wrapper').removeClass('open');
    });

    // --------------------------
    // Scroll-top button & navbar fixed
    // --------------------------
    $(window).on('scroll', function () {
        $("#scroll-top").toggleClass('active', $(this).scrollTop() > 100);
        $('.navbar').toggleClass('fixed-top', $(this).scrollTop() > 50);
    });
    $("#scroll-top").on('click', function () {
        $("html, body").animate({ scrollTop: 0 }, 1500);
        return false;
    });

    // --------------------------
    // Preloader
    // --------------------------
    $(window).on('load', function () {
        $(".preloader").fadeOut("slow");
    });

    // --------------------------
    // Magnific Popup
    // --------------------------
    $(".popup-gallery").magnificPopup({
        delegate: '.popup-img',
        type: 'image',
        gallery: { enabled: true }
    });
    $(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
        type: "iframe",
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    // --------------------------
    // Countdown
    // --------------------------
    if ($('#countdown').length) {
        $('#countdown').countdown('2028/01/30', function (event) {
            $(this).html(
                '<div class="row">' +
                '<div class="col countdown-single"><h2 class="mb-0">%-D</h2><h5 class="mb-0">Day%!d</h5></div>' +
                '<div class="col countdown-single"><h2 class="mb-0">%H</h2><h5 class="mb-0">Hours</h5></div>' +
                '<div class="col countdown-single"><h2 class="mb-0">%M</h2><h5 class="mb-0">Minutes</h5></div>' +
                '<div class="col countdown-single"><h2 class="mb-0">%S</h2><h5 class="mb-0">Seconds</h5></div>' +
                '</div>'
            );
        });
    }

    // --------------------------
    // Copywrite year
    // --------------------------
    $("#date").html(new Date().getFullYear());

    // --------------------------
    // Bootstrap tooltip
    // --------------------------
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

})(jQuery);


// ========================================
// DOMContentLoaded – Hero + Booking Area
// ========================================
document.addEventListener("DOMContentLoaded", function () {

    // --------------------------
    // Hero slider – immediate
    // --------------------------
    $('.hero-slider').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        margin: 0,
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 5000,
        items: 1,
        navText: ["<i class='far fa-long-arrow-left'></i>", "<i class='far fa-long-arrow-right'></i>"]
    });

    // --------------------------
    // Booking area init – immediate
    // --------------------------
    if ($('.booking-area').length) {
        // datepicker
        if ($('.date-picker').length) $(".date-picker").datepicker();
        // timepicker
        if ($('.time-picker').length) $(".time-picker").timepicker();
        // nice select
        if ($('.select').length) $(".select").niceSelect();
    }

    // --------------------------
    // Heavy JS – delayed 1.5s
    // --------------------------
    function initHeavyJS() {
        // Testimonial slider
        if ($('.testimonial-slider').length) {
            $('.testimonial-slider').owlCarousel({
                loop: true,
                margin: 30,
                nav: false,
                dots: true,
                autoplay: true,
                responsive: { 0: { items: 1 }, 600: { items: 2 }, 1000: { items: 4 } }
            });
        }

        // Partner slider
        if ($('.partner-slider').length) {
            $('.partner-slider').owlCarousel({
                loop: true,
                margin: 25,
                nav: false,
                dots: false,
                autoplay: true,
                responsive: { 0: { items: 2 }, 600: { items: 3 }, 1000: { items: 6 } }
            });
        }

        // Counter-up
        if ($('.counter-box').length) {
            $('.counter-box').appear(function () {
                $('.counter').countTo();
            }, { accY: -100 });
        }

        // WOW animations
        new WOW().init();
    }

    // Delay heavy scripts to reduce TBT
    setTimeout(initHeavyJS, 1500);
});
