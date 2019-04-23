$(document).ready(function(){
   var url = $(location).attr("href");
   var parts = url.split("/");
   var page_num = parts[parts.length-1];
   var get_last_number = $('#page').text().split("z");
   var quantity = get_last_number[get_last_number.length - 1];

   var ul ='';
   var li ='';
   var content ='';

   for (var i = 1; i <= quantity; i++) {
       if (page_num <= i || page_num === 'quiz') {
           content += ul = $("ul#loadbar");
           content += li = ul.append('<li class="bit"></li>');
           content += $(".bit").eq(page_num -1).addClass('active');
       } else {
           content += ul = $("ul#loadbar");
           content += li = ul.append('<li class="bit"></li>');
           content += $(".bit").eq(page_num -1).addClass('active');
       }
   }
});