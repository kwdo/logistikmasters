jQuery(document).ready(function($) {

  // Nav Sidebar

  $(".js-link-sidebar").on('click', function() {
    $(".js-link-sidebar").toggleClass("active");
    $(".js-sidebar").toggleClass("open");
    $("html").toggleClass("fixed");
    return false;
  });

  $(".js-link-nav-side").on('click', function() {
    $(this).next().toggleClass("active");
    return false;
  });


  // Search

  $(".js-link-search").on('click', function() {
    $(this).toggleClass("active");
    $(".js-nav-main").toggleClass("inactive");
    $(".js-search").toggleClass("active");
    $('#search').focus();
    return false;
  });


  // Scrolling Mobile Headings

   // not entirely happy with this, will research more for a CSS only solution that actually works
  if($(window).width() <= 767) {
      $(".marquee").marquee({
        duration: 9000,
        gap: 50,
        delayBeforeStart: 0,
        direction: 'left',
        duplicated: true
    });
  }


  // Equal Height Elements

  $(".js-plus-item").matchHeight();
  $(".js-themes-item").matchHeight();

  $(".js-hero-heading").matchHeight({byRow: false});
  $(".js-shop-heading").matchHeight();
  $(".js-plus-heading").matchHeight();
  $(".js-item__heading--small").matchHeight();
  $(".js-news-grid-col").matchHeight();
  $(".js-plus-grid").matchHeight();

  $(".js-related-themes-item").matchHeight();

  $(".js-item").matchHeight();
  $(".js-vr-termin-item__content").matchHeight();
  $(".js-item-title").matchHeight();
  $(".js-termine-item").matchHeight();
  $(".js-termine-item__title").matchHeight();
  $(".js-home-footer-col").matchHeight();
  $(".js-branchengiide-item").matchHeight();
  $(".js-branchenguide-start-item-img").matchHeight();
  $(".js-stellenanzeige-buchen-item h2").matchHeight();
  $(".js-stellenanzeige-buchen-item-content").matchHeight();

  $(".js-verkehrsrundschau-main-title").matchHeight();

  
  var allCaptions = $('.vr-termin-item__content p');
  if( allCaptions.length && typeof($clamp) != 'undefined' ) {
    for(var i=0; i<allCaptions.length; i++){
      $clamp(allCaptions[i], {clamp: 8});
    }
  }
  
  var allHeadings = $('.vr-item__heading');
  if( allHeadings.length && typeof($clamp) != 'undefined' ) {
    for(var i=0; i<allHeadings.length; i++){
      $clamp(allHeadings[i], {clamp: 3});
    }
  }
  
  var allHeadingsSmall = $('.vr-item__heading--small');
  if( allHeadingsSmall.length && typeof($clamp) != 'undefined' ) {
    for(var i=0; i<allHeadingsSmall.length; i++){
      $clamp(allHeadingsSmall[i], {clamp: 4});
    }
  }
  // Carousels

  $(".js-action-gallery").owlCarousel({
    margin:0,
    items:1,
    nav: true,
    loop: true
  });
  $(".js-logo-slide").owlCarousel({
    margin:10,
    items:5,
    nav: true,
    loop: true,
    navText: [" "," "],
    responsive:{
      1920:{
        items:5
      },
      1366:{
        items:5
      },
      1024:{
        items:5
      },
      768:{
        items:3
      },
      0:{
        items:2
      }
    }
  });

  $(".js-media-gallery").owlCarousel({
    margin:0,
    items:1,
    nav: true,
    navText: ["vorheriges","nächstes"],
    loop: true
  });

  $(".js-media-image-gallery").owlCarousel({
    margin:20,
    items:3,
    nav: true,
    responsive:{
      0:{
        items:3
      },
      768:{
        items:4
      }
    }
  });


          
  /*
      SAME HEIGHT BLOCKS
      Usage:
      1) add .js-same-height-parent class to parent of same-height blocks;
      2) add .js-same-height class to same-height blocks.
      Script will find all blocks inside parent and set their height equial to block with maximum height.
  */
  function same_height() {

      $('.js-same-height-parent').each(function() {
          var same_height = $(this).find('.js-same-height');

          function same_height_main() {
              // reset height
              same_height.outerHeight('auto');

              // detect mobile/desktop
              var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
              if (w <= 991) {
                  // autoheight for phone
                  same_height.outerHeight('auto'); 
              } else {
                  // same height for tablet and desktop
                  var max_height = Math.max.apply(null, same_height.map(function () { return $(this).outerHeight(); }).get());
                  same_height.outerHeight(max_height);
              };
          };
          same_height_main();

      });
  };
  same_height();



  $(window).resize(function() {
    same_height();   // re-calculate max height
  });

  if( $('#js-vr-detail-slider').length ) {

    $('#js-vr-detail-slider').lightSlider({
      item: 1,
      gallery: true,
      useCSS: true,
      cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
      easing: 'linear', //'for jquery animation',////
      speed: 400, //ms'
      auto: false,
      keyPress: true,
      loop: true,
      thumbItem:7,
      responsive: [
      {
        breakpoint: 991,
        settings: {
          gallery: false
        }
      }
    ]

    });

  }

  if( $('#js-vr-mediathek-detail-slider').length ){

    var medSlider = $('#js-vr-mediathek-detail-slider').lightSlider({
      item: 1,
      gallery: true,
      useCSS: true,
      cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
      easing: 'linear', //'for jquery animation',////
      speed: 400, //ms'
      auto: false,
      keyPress: true,
      loop: true,
      thumbItem:3,
      controls: false,
      responsive: [
      {
        // breakpoint: 767,
        // settings: {
        //   thumbItem:2
        // }

        breakpoint: 991,
        settings: {
          gallery: false
        }
      }
    ]
    });

    $('.vr-mediathek-details-slider-controls-button__left').on('click',function(){
        medSlider.goToPrevSlide();
    })
    $('.vr-mediathek-details-slider-controls-button__right').on('click',function(){
        medSlider.goToNextSlide();
    })

  }
  
});
