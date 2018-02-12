$(document).ready(function () {

  var $body = $('body');

  var initShoppingCartLabel = function () {
    if ($body.find('*').hasClass('js-shopping-cart')) {

      var $shoppingCart = $('.shopping-cart');

      var $shoppingCartIconMargin = $shoppingCart.find('.icon').css('margin-right');

      var $shoppingCartIconWidth = $shoppingCart.find('.icon > span').outerWidth();

      $shoppingCart.find('.icon').css({
        'margin-right': $shoppingCartIconWidth + 2
      });
    }
  };


  $('.primary-menu-trigger, .overlay').click(function () {
    $body.toggleClass('primary-menu-open');
    $body.toggleClass('overflow');
  });


  initShoppingCartLabel();




});


$(window).scroll(function () {
  if ($(window).scrollTop() > 0) {
    $('body').addClass('sticky-header');
  }
  else {
    $('body').removeClass('sticky-header');
  }
});