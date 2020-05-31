
(function($, D){
  $(document).ready(function(){

    $(window).bind('scroll', function () {
      if ($(window).scrollTop() > 50) {
        $('#navbar').addClass('sticky');
      } else {
        $('#navbar').removeClass('sticky');
      }
    });
  });
})(jQuery, Drupal);
