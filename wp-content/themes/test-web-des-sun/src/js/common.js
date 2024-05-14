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

  });
})(jQuery);