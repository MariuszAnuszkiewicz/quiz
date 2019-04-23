$(document).ready(function(){
    var $checkboxes = $('#qForm input[type="checkbox"]');
    $checkboxes.on('click', function(e){
        var count = $checkboxes.filter(':checked').length;
        if (count > 1) {
            e.preventDefault();
        }
    });
});
