
(function($, D){
  $(document).ready(function(){

    $(window).bind('scroll', function () {
      if ($(window).scrollTop() > 50) {
        $('#navbar').addClass('sticky');
        $('#logo').hide();
      } else {
        $('#navbar').removeClass('sticky');
        $('#logo').show();
      }
    });
  });
})(jQuery, Drupal);
