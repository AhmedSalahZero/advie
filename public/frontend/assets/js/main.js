/*
Template Name: Katha
Template URI: https://themes.crazyenter.com/static/katha
Author: crazyEnter
Author URI: https://crazyenter.com
Version: 1.0.0
*/

(function ($) {
    "use strict";
    
    /*[ ================ Preloader ================ ]*/
    $(window).on('load', function(){
            $('.spinner').fadeOut('slow', function(){
            $(this).remove();
        });
    });

    /*[ ================ Fancybox ================ ]*/
    $('[data-fancybox="images"]').fancybox({
      onInit : function(instance) {
        // Change color on start
        var color = instance.group[instance.currIndex].opts.$orig.data('color');

        if (color) {
          instance.$refs.bg.css('background-color', color);
        }
      }, 
      beforeShow : function(instance, current) {
        // Change color when navigating the gallery
        var color = current.opts.$orig.data('color') || '';

         instance.$refs.bg.css('background-color', color);
      }
    });

    /*[ ================ Mobile Menu ================ ]*/
    $(".navbar-nav > li > a").on("click", function(){
        $(".navbar-collapse").collapse("hide");
    });

    /*[ ================ Search Option ================ ]*/
    // search function variable
    var menuSearch = $('.header-search');
    var bodyTag = $('body');
    var closeButton = $('.close-button');
    var searchField = $('.search-field');

    // search functions
    menuSearch.on('click', function (e) {
        e.stopPropagation();
        bodyTag.addClass('active-search');
    });

    /* remove search animation by body click */
    closeButton.on('click', function (e) {
       bodyTag.removeClass('active-search');
    });

    bodyTag.on('click', function (e) {
        $(this).removeClass('active-search');
    });
    searchField.on('click', function(e){
        e.stopPropagation();
    });

    /*[ ================ Banner Slider ================ ]*/
    var owlBanner = $(".banner-slider");
    owlBanner.owlCarousel({
        items: 1,
        autoplay: true,
        loop: true,
        mouseDrag: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        nav: false,
        dots: true
    });
    owlBanner.on("translate.owl.carousel", function(){
        $(".main-banner h3").removeClass("animated fadeInDown").css("opacity", "0");
        $(".main-banner h1").removeClass("animated fadeInUp").css("opacity", "0");
        $(".main-banner h5").removeClass("animated zoomIn").css("opacity", "0");
        $(".banner-button").removeClass("animated fadeInDown").css("opacity", "0");
    });
    owlBanner.on("translated.owl.carousel", function(){
        $(".main-banner h3").addClass("animated fadeInDown").css("opacity", "1");
        $(".main-banner h1").addClass("animated fadeInUp").css("opacity", "1");
        $(".main-banner h5").addClass("animated zoomIn").css("opacity", "1");
        $(".banner-button").addClass("animated fadeInDown").css("opacity", "1");
    });

    /*[ ================ Slider Service  ================ ]*/    
    $('.services-grid').owlCarousel({
        autoplay: true,
        center: true,
        mouseDrag: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        loop: true,
        nav: false,
        dots: false, 
        items:3, 
        smartSpeed: 700,
        autoplayTimeout: 6000, 
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 3
            }
        }
    });

    /*[ ================ Offcanvas Menu  ================ ]*/
    var menuLine = $('.menu-line');
    var bodySelector = $('body');
    var closeBtn = $('.close-btn');
    var hamburgerMenu = $('.hamburger-menu');

    // Offcanvas Menu On/Off
    menuLine.on('click', function (e) {
        e.stopPropagation();
        bodySelector.addClass('offcanvas-menu');
    });

    /* remove offcanvas menu by body click */
    closeBtn.on('click', function (e) {
       bodySelector.removeClass('offcanvas-menu');
    });

    bodySelector.on('click', function (e) {
        $(this).removeClass('offcanvas-menu');
    });
    hamburgerMenu.on('click', function(e){
        e.stopPropagation();
    });

    /*[ ================ Fixed Header ================ ]*/
    $(window).on('scroll', function(event) {
        var window_width = $(window).width();
        var scrollValue = $(window).scrollTop();
        if (window_width > 991) {
            if (scrollValue >= 160) {
                $('header').addClass('affix animated fadeIn');
            } else {
                $('header').removeClass('affix animated fadeIn');
            }
        }
    });

    /*[ ================ ScrollSpy ================ ]*/
    $('body').scrollspy({ target: 'header', offset: 100 });
    
    /*[ ================ SmoothScroll ================ ]*/
    var scroll = new SmoothScroll();
    var smoothScrollWithoutHash = function(selector, settings) {
        /**
         * If smooth scroll element clicked, animate scroll
         */
        var clickHandler = function(event) {
            var toggle = event.target.closest(selector);
            if (!toggle || toggle.tagName.toLowerCase() !== 'a') return;
            var anchor = document.querySelector(toggle.hash);
            if (!anchor) return;
            event.preventDefault(); // Prevent default click event
            scroll.animateScroll(anchor, toggle, settings || {}); // Animate scroll
        };
        window.addEventListener('click', clickHandler, false);
    };
    // Run function
    smoothScrollWithoutHash('a[href*="#"]');

    /*[ ================ Portfolio Isotop ================ ]*/
    var $grid = $('.portfolio-list');
    $grid.isotope({
      itemSelector: '.single-port',
      percentPosition: true,
      masonry: {
        // use outer width of grid-sizer for columnWidth
        columnWidth: '.col-xl-3'
      }
    });

    // filter items on button click
    $('.port-navigation li').on( 'click', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
    });

    //  add portfolio navigation class
    $('.port-navigation li').on('click', function(){
        $('.port-navigation li').removeClass("active");
        $(this).addClass("active");
    });

    // layout Isotope after each image loads
    $grid.imagesLoaded().progress( function() {
        $grid.isotope('layout');
    });
    
    /*[ ================ Testimonials List ================ ]*/    
    $('.testimonail-list').owlCarousel({
        items: 1, 
        loop: false,
        nav: false,
        dots: true, 
        autoplay: true,
        smartSpeed: 700,
        autoplayTimeout: 6000
    });

    /*[ ================ Team Member ================ ]*/    
    $('.team-list').owlCarousel({
        items: 4, 
        loop: true,
        nav: false,
        dots: true, 
        autoplay: true,
        margin: 10,
        smartSpeed: 700,
        autoplayTimeout: 6000, 
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 4
            }
        }
    });

    /*[ ================ Blog List ================ ]*/
    $('.blog-list').owlCarousel({
        items: 3, 
        loop: true,
        nav: false,
        dots: true, 
        autoplay: true,
        margin: 30,
        smartSpeed: 900,
        autoplayTimeout: 6000, 
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });

    /*[ ================ Partners List ================ ]*/
    $('.partner-list').owlCarousel({
        items: 4, 
        mouseDrag: true,
        loop: true,
        nav: false,
        dots: false, 
        margin: 30,
        autoplay: true,
        smartSpeed: 700,
        autoplayTimeout: 6000, 
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });

    /*[ ================ Wow Js ================ ]*/
    new WOW().init();

    /*[ ================ Scroll Top ================ ]*/
    $('.go-top').hide();
    var windowSize = $(window).width();
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 1000 && windowSize > 760) {
            $('.go-top').fadeIn();
        } else {
            $('.go-top').fadeOut();
        }
    });
    // On Click Function
    $('.go-top').on('click', function() {
        $('html, body').animate({
            scrollTop: $('body').offset().top
        }, 2000);
    });

}(jQuery));	