function executeAsync(functionArr, timeout) {
  for (var i = 0; i < functionArr.length; i++) {
    setTimeout(functionArr[i], timeout);
  }
}

$(document).ready(function () {

  'use strict';

  var $body = $('body');


  $('.primary-menu-trigger, .overlay').click(function () {
    $body.toggleClass('primary-menu-open');
    $body.toggleClass('overflow');
  });


  var initShoppingCartLabel = function () {

    if ($body.find('*').hasClass('js-shopping-cart')) {

      var $shoppingCart = $('.shopping-cart');
      var $shoppingCartIconWidth = $shoppingCart.find('.icon > span').outerWidth();
      $shoppingCart.find('.icon').css({
        'margin-right': $shoppingCartIconWidth + 2
      });
    }
  };

  var initSlick = function () {
    if ($body.find('*').hasClass('js-hero')) {
      $('.hero').slick({
        'arrows': true,
        'prevArrow': '<a role="button" class="slick-prev"><i class="fas fa-chevron-left"></i></a>',
        'nextArrow': '<a role="button" class="slick-next"><i class="fas fa-chevron-right"></i></a>'
      });
    }
  };

  executeAsync([initSlick, initShoppingCartLabel], 50);

});


$(window).scroll(function () {
  if ($(window).scrollTop() > 0) {
    $('body').addClass('sticky-header');
  }
  else {
    $('body').removeClass('sticky-header');
  }
});