(function ($) {
  $(document).ready(function () {
    
    if ($(window).width() < 992) {
      $('.hamburger-btn__input').on('change', function () {
        $('.header-menu').slideToggle();
      });

      $('.menu-item-has-children').on('click', function () {
        var $this = $(this);
        $this.find('> .sub-menu').slideToggle();
      });
      $(document).on('click', function (e) {
        if (!$(e.target).closest(".menu-item-has-children").length) {
          $('.sub-menu').slideUp();
        }
        e.stopPropagation();
      });
    } else {
      function menu_drop_donw(menu) {
        var menu = $(menu),
          has_menu = menu.find('.menu-item-has-children');

        if ($(window).width() > 960) {
          has_menu.hover(
            function () {
              $(this).toggleClass('active').find('.sub-menu').stop(true, false).slideDown('medium');
            },
            function () {
              $(this).toggleClass('active').find('.sub-menu').stop(true, false).slideUp('medium');
            }
          );
        } else {
          has_menu.on('click', function () {
            $(this).toggleClass('active').find('.sub-menu').stop(true, false).slideToggle('medium');
          });
        }
      }

      menu_drop_donw('.header-menu__wrap');
    }

    var partnerSlider = $('.partner-slider__images');
    if (partnerSlider.length) {
      partnerSlider.slick({
        infinite:true,
        variableWidth:true,
        dots:false,
        arrows: false,
        autoplay:true,
        autoplaySpeed:0,
        speed:15000,
        cssEase:'linear',
      });
    }

    $(".anchor a, a.anchor").on("click", function (event) {
      event.preventDefault();
      var href   = $(this).find('a').attr('href'),
          target = $(this).find('a').attr('target');
      if (href == undefined){
        var href   = $(this).attr('href'),
            target = $(this).attr('target');
      }

      var id = href.substring(href.search('#'));
      if (id.indexOf('#') == '-1'){
        if (target === "_blank") {
          window.open(href, '_blank');
        } else {
          $(location).attr('href', href);
        }
      } else if ( href.indexOf(window.location.href) == '-1' && href.indexOf('http') != '-1') {
        if (target === "_blank") {
          window.open(href, '_blank');
        } else {
          $(location).attr('href', href);
        }
      } else {
        var id = href.substring(href.search('#')),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 800);
      }
    });

    // setTimeout(() => {
    //   history.replaceState('', document.title, window.location.origin + window.location.pathname + window.location.search);
    // }, 5); 

  });
})(jQuery);
