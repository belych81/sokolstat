$(function(){

  //Живой поиск
$('.search_keywords').bind("keyup", function() {
    if(this.value.length >= 1){
        $.ajax({
            type: 'post',
            url: Routing.generate('news_search'),
            data: {query: this.value},
            dataType: 'json',
            success: function(data){
                $(".search_result_items").empty().hide();
                if(data){
                    $(".search_result, .search_result_items").show();
                    $.each(data, function(translit, name){
                        $(".search_result_items").append("<a href='/player/"+translit+"'>"+name+"</a>");

                    });
                    $("body").not(".search-top").click(function(){
                      $(".search_result, .search_result_items").hide();
                    });
                } else {
                    $(".search_result, .search_result_items").hide();
                }
                console.log(data);
           },
     error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
    } else {
      $(".search_result, .search_result_items").hide();
    }
});

$(".changeGameGoalPlayer").click(function(){
  var change = $(this).data('change');
  var id = $(this).data('id');
  var season = $(this).data('season');
  var team = $(this).data('team');
  var route = $(this).data('path');
  $.ajax({
      type: 'post',
      url: Routing.generate(route, {'id': id, 'season': season,
        'team': team, 'change': change}),
      dataType: 'json',
      success: function(data){
          $("#lastPlayer").text(data['name']);
          $("[data-id="+id+"][data-param='game']").text(data['game']);
          $("[data-id="+id+"][data-param='goal']").text(data['goal']);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
      }
});
});
});
