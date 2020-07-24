(function($, D){
  $(document).ready(function(){
    $("body").addClass("w3-pale-green");

    $("#btn-play span").click(function () {
      var href = $("#btn-play a").attr('href');
      window.location.href = href;
    });
  });
})(jQuery, Drupal);
