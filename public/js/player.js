$(document).ready(function(){
    let playerId = $("#playerId").val();
    $.ajax({
        type: 'post',
        url: Routing.generate('viewed_player_add', {'id':playerId}),
        dataType: 'json',
        success: function(response){
          console.log(response)
        },
        error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr.status);
          console.log(thrownError);
        }
    });
})