(function ($) {
  $(document).ready(function readyComon() {

    const search_togler = $('#search_togler')
    const header_search_form = $('#header_search_form')
    const header_search_form_close = $('#header_search_form .close')
    function showHeaderSearchForm() {
      search_togler[0].classList.toggle('active')
      header_search_form[0].classList.toggle('active')
    }
    search_togler.on('click', function(){
      showHeaderSearchForm();
    })
    header_search_form_close.on('click', function(){
      showHeaderSearchForm();
    })

    // Burger Menu
    const header = $('#header')[0];
    const menu_btn = $('#menu_btn')[0];
    const collapse_menu = $('#collapse_menu')[0];
    menu_btn.addEventListener('click', ()=> {
      header.classList.toggle('active')
      menu_btn.classList.toggle('active')
      collapse_menu.classList.toggle('active')
    })
    // global collapse/hide all .active
    const collapse_menu_bg = $('#collapse_menu_bg')[0];
    collapse_menu_bg.addEventListener('click', ()=> {
      const activeElements = document.querySelectorAll('.active');
      activeElements.forEach(function(element) {
        element.classList.remove('active');
      });
    })

    // Featured Products Slider
    let featuredProductsSliderInterval_i = 0;
    const featuredProductsSliderInterval = setInterval(function() {
      featuredProductsSliderInterval_i++;
      const featuredProductsSlider = $('.featured-products__slider');
      if (featuredProductsSlider.length && $.fn.slick) {
        featuredProductsSlider.slick({
          infinite:false,
          slidesToShow: 3,
          dots: false,
          speed: 300,
          cssEase:'linear',
          nextArrow: '<button class="featured-products__next"><svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.724609 13.7375L6.46211 8L0.72461 2.2625L2.49961 0.5L9.99961 8L2.49961 15.5L0.724609 13.7375Z" fill="#777777"/></svg></button>',
          prevArrow: '<button class="featured-products__prev"><svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.27539 2.2625L3.53789 8L9.27539 13.7375L7.50039 15.5L0.000390679 8L7.50039 0.5L9.27539 2.2625Z" fill="#777777"/></svg></button>',
          responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 900,
              settings: {
                slidesToShow: 1
              }
            }
          ]
        });
        clearInterval(featuredProductsSliderInterval);
      }
      if(featuredProductsSliderInterval_i === 20){
        clearInterval(featuredProductsSliderInterval);
      }
    }, 200);


    // Video play - global each - all blocks
    $('.play-button').on('click', function() {
      var id = $(this).data('id');
      var video = $('#video-' + id).get(0);
      if (video.paused) {
        video.play();
        video.classList.add('play')
        $('#video-' + id).show();
      } else {
        video.pause();
        video.classList.remove('play')
      }
    });

    
  });
})(jQuery);