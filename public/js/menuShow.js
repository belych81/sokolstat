$(document).ready(function()
{
    $('.menu-trigger').on('click', function(event) {
        event.preventDefault();
        $('.panel-box').toggleClass('open');
        $('#navbar-collapse-1').removeClass('in');
    });
    
    $('#menuChamp').hide();
    $('#champ').mouseover(function() {
        $('#menuChamp').show();
    }).mouseout(function() {
        $('#menuChamp').hide();
    });
});



