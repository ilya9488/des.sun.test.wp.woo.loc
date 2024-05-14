(function ($) {
  $(document).ready( function readyWooMinicart() {

    // hide / show - cart
    $(document).on("click", "#wmc_count_btn", function () {
      $('.cu_wmc-content').toggleClass('show');
    })
    $(document).on("click", ".cu_wmc-close, .cu_wmc-content-bg", function () {
      $('.cu_wmc-content').removeClass('show');
    });

    // add to cart
    $(document.body).on('added_to_cart', function () {
      $.ajax({
        type: "POST",
        url: myajax.url,
        data: {
          action: "update_mini_cart_on_add_to_cart"
        },
        success: function(response) {
          const cu_wmc_content = $('.wmc-cart-wrapper.wmc-mini-cart-shortcode .cu_wmc-content')
          const cu_wmc_content_bg = $('.wmc-cart-wrapper.wmc-mini-cart-shortcode .cu_wmc-content-bg')
          if(cu_wmc_content){
            cu_wmc_content.remove();
            cu_wmc_content_bg.remove();
          }
          $('.wmc-cart-wrapper.wmc-mini-cart-shortcode').append(response.data.mini_cart_content);
          $('.wmc-count').html(response.data.mini_cart_count);
          $('.wmc-cart__subtotal').html(response.data.mini_cart_subtotal);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }); 
    $(document).on("click", ".add_to_cart_button", function () {
      // fuse
      $(document.body).trigger('added_to_cart');
    })// /.add to cart


    // Reducing the amount of goods
    $(document).on("click", ".qty-minus", function(){
      var inputId = $(this).data('id');
      var input = $('#' + inputId);
      var currentValue = parseInt(input.val(), 10);
      var minValue = parseInt(input.attr('min'), 10);

      if (currentValue > minValue) {
        input.val(currentValue - 1).trigger('change');
      }
    });

    // An increase in the amount of goods
    $(document).on("click", ".qty-plus", function(){
      var inputId = $(this).data('id');
      var input = $('#' + inputId);
      var currentValue = parseInt(input.val(), 10);
      var maxValue = parseInt(input.attr('max'), 10);

      if (currentValue < maxValue) {
          input.val(currentValue + 1).trigger('change');
      }
    });
    
    $(document).on("focusout", "input.qty", function () {
      var value = $(this).val();
      var minValue = parseInt($(this).attr('min'), 10);
      // We check whether an empty value
      if (!value) {
        $(this).val(minValue);
        $(this).trigger('change');
      }
    });

    $(document).on("keypress", "input.qty", function (e) {
      // Allow only the input of numbers
      var charCode = (e.which) ? e.which : e.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        e.preventDefault();
      }
    });

    // quantity cahange
    $(document).on("input change", "input.qty", function () {
      const value = parseInt($(this).val(), 10);
      const minValue = parseInt($(this).attr('min'), 10);
      if (value < minValue) {
        $(this).val(minValue);
        $(this).value = minValue;
        $(this).trigger('change');
      }
      if (value >= minValue) {
        const $thisbutton = $(this);
        const cart_item_key = $(this)
          .attr("name")
          .replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
        const item_quantity = $(this).val();
        const currentVal = parseFloat(item_quantity);
  
        $.ajax({
          type: "POST",
          url: myajax.url,
          data: {
            action: "my_cart_qty",
            cart_item_key: cart_item_key,
            quantity: currentVal,
          },
          success: function (response) {  
            // .wmc-price-qty
            const productId = response.data.product_id;
  
            const updatedQuantity = response.data.updated_quantity;
            $('.wmc-item-qty-'+productId).html(updatedQuantity);
  
            const totalPrice = response.data.total_price;
            $('.subtotal .woocommerce-Price-amount.amount').remove();
            $('.subtotal').append(totalPrice);
            $('.wmc-cart__subtotal .woocommerce-Price-amount.amount').remove();
            $('.wmc-cart__subtotal').append(totalPrice);
  
            const totalQuantity = response.data.total_quantity;
            $('.wmc-count').html(totalQuantity);
  
            let progress_percent = response.data.progress_percent;
            const price_difference = response.data.price_difference;
            // console.log(response.data);
            
            $('.mwc-price-difference').html(price_difference)
            if(progress_percent >= 100){ 
              progress_percent = 100;
              $('.have-free-shipping').show()
              $('.have-no-free-shipping').hide()
              $('.wmc-percent').css('width', progress_percent + '%');
            }else{
              $('.have-free-shipping').hide()
              $('.have-no-free-shipping').show()
              $('.wmc-percent').css('width', progress_percent + '%');
            }
  
          },
        });
      }

    });
    
    // remove item
    $(document).on("click", ".remove_from_cart_button", function (e) {
      e.preventDefault();
      
      const $this = $(this);
      const cart_item_key = $this.data("cart_item_key");
      const product_id = $this.data("product_id");
      const products__item = $('.wmc-products__item.'+product_id);
      products__item.addClass('removed')
    
      $.ajax({
        type: "POST",
        url: myajax.url,
        data: {
          action: "remove_from_cart",
          cart_item_key: cart_item_key,
          product_id: product_id
        },
        success: function (response) {
          const idRemoveItem = response.data.id_remove_item;
          $('.wmc-products__item.'+idRemoveItem).remove();
          // .wmc-price-qty
          const productId = response.data.product_id;
          const updatedQuantity = response.data.updated_quantity;
          $('.wmc-item-qty-'+productId).html(updatedQuantity);
          const totalPrice = response.data.total_price;
          $('.subtotal .woocommerce-Price-amount.amount').remove();
          $('.subtotal').append(totalPrice);
          $('.wmc-cart__subtotal .woocommerce-Price-amount.amount').remove();
          $('.wmc-cart__subtotal').append(totalPrice);
          const totalQuantity = response.data.total_quantity;
          $('.wmc-count').html(totalQuantity);

          let progress_percent = response.data.progress_percent;
          const price_difference = response.data.price_difference;
          // console.log(response.data);
          
          $('.mwc-price-difference').html(price_difference)
          if(progress_percent >= 100){ 
              progress_percent = 100;
              $('.have-free-shipping').show()
              $('.have-no-free-shipping').hide()
              $('.wmc-percent').css('width', progress_percent + '%');
            }else{
              $('.have-free-shipping').hide()
              $('.have-no-free-shipping').show()
              $('.wmc-percent').css('width', progress_percent + '%');
          }
          
          const html_empty_cart = response.data.html_empty_cart;
          $('.wmc-count').html(html_empty_cart);
          if(totalQuantity === 0){
            const cu_wmc_content_has_items = $('.wmc-cart-wrapper .cu_wmc-content-has-items')
            const cu_wmc_content_empty = $('.wmc-cart-wrapper .cu_wmc-content-empty')
            cu_wmc_content_has_items.addClass('hide')
            cu_wmc_content_empty.removeClass('hide')
          }
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });

  });
})(jQuery);