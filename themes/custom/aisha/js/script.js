(function($, D){
  $(document).ready(function(){
//$("#block-aisha-account-menu ul li a span").css({"font-size":"35px", "color":"#FFF"});
   // $("body").addClass("w3-pale-green");
    var href = $("#btn-play a").attr('href');

    $("#btn-play a").attr('href').each(function(){
    //  alert($(this));
    });
    $("#btn-play span").click(function () {

     // window.location.href = href;
    });
  });
})(jQuery, Drupal);
