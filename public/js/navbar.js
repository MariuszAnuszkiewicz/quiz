$(document).ready(function(){
  var $nav = $('.btn-result-nav');
  var $toggle = $('.toggle');
  var url = $(location).attr("href");
  var parts = url.split("/");
  var last_part = parts[parts.length-1];

  if (last_part === 'result') {
      $toggle.show();
  } else {
      $toggle.hide();
  }
  $toggle.on('click', function() {
     $nav.slideToggle('slow');
  });
});
