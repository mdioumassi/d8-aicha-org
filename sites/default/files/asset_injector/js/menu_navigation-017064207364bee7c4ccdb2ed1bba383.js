(function ($, Drupal) {

$(".nav li.expanded").hover(
    function(){
      $(this).addClass("open");
    },function(){
      $(this).removeClass("open");
    }
  );

}(jQuery, Drupal));