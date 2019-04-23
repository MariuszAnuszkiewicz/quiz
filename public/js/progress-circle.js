$(document).ready(function() {
    var gird = $('#grid');
    var result = gird.data("percentage");
    var dasharray = (430 + (4 * (result + 6.8))) ;
    $('#circle').animate({
        fill: "#223fa3",
        stroke: "#000",
        "stroke-dasharray": dasharray,
    },{
        duration: 2000,
        progress: function (animate, progress) {
        $('#text').text(Math.round(progress * result) + "%");

    }});
});