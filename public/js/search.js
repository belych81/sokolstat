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
                          $(".search_result_items")
                          .append("<a href='/"+translit+"'>"+name+"</a>");

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
          console.log(id);
          console.log(data);
            $(".spiski.selected").removeClass('selected');
            $(".spiski[data-id="+id+"]").addClass('selected');
            $("[data-id="+id+"][data-param='game']").text(data['game']);
            $("[data-id="+id+"][data-param='goal']").text(data['goal']);
        },
        error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr.status);
          console.log(thrownError);
        }
  });
  });

  $(".letters-list li").click(function(){
    var letter = $(this).text();
    $.ajax({
        type: 'post',
        url: Routing.generate('team_get_by_letter', {'letter':letter}),
        dataType: 'json',
        success: function(data){
            var newHtml = "";
            console.log(data.teams);
            for(var i=0, cnt=data.teams.length; i < cnt; i++){
              var detailUrl = Routing.generate('team_show', {
                'code': data.teams[i][1]});

              newHtml += "<li><a href='"+ detailUrl +"' class='spiski'>"
                + data.teams[i][0] + "</a></li>";
            }
            $(".clubs-list").html(newHtml);
        },
        error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr.status);
          console.log(thrownError);
        }
      });
  });

  $(".tab input:first").prop('checked', true);

  $(".tabs .tab input").each(function(){
    if($(this).prop('checked')){
      var className = this.className;
      $(".tab-content."+ className).show();
    }
  });

  $(".tab input").change(function(){
    var className = $(this).attr('class');
    console.log(className);
    $(".tab-content").hide();
    $(".tab-content."+className).show();
  });

});
