$(document).ready(function(){
    $('.search_keywords').bind("keyup", function() {
      if(this.value.length >= 1){
          $.ajax({
              type: 'post',
              url: "ajax/search.php",
              data: {q: this.value},
              dataType: 'json',
              success: function(data){
                  console.log(data)
                  $(".search_result_items").empty().hide();
                  if(data){
                      console.log(2)
                      $(".search_result, .search_result_items").show();
                      $.each(data, function(i, ob){
                          $(".search_result_items")
                          .append("<div>"+ob.name+" (" + ob.team +")</div>");
    
                      });
                      $("body").not(".search-top").click(function(){
                        $(".search_result, .search_result_items").hide();
                      });
                  } else {
                      console.log(3)
                      $(".search_result, .search_result_items").hide();
                  }
                  console.log(data);
             },
       error: function (xhr, ajaxOptions, thrownError) {
        }
      });
      } else {
        $(".search_result, .search_result_items").hide();
      }
    });
    
    var matchId, team, team2, img1, img2;
    
    $(document).on("click", ".teams-list div", function(){
        let $this = $(this);
        let id = $this.data('id');
        let image = $this.find('img').attr('src');
        console.log(id)
        $.ajax({
              type: 'post',
              url: "ajax/team.php",
              data: {id: id, image: image},
              dataType: 'json',
              success: function(data){
                  console.log(data)
                  if(data){
                      $(".match_images").html('');
                      for (const key in data) {
                          let id = 'matchNext_'+key;
                          $(".match_images").append("<div id='"+id+"'></div>");
                          $("#matchNext_" + key).append("<img src=" + data[key].img1 + " />");
                          $("#matchNext_" + key).append("<img src=" + data[key].img2 + " />");
                          $("#matchNext_" + key).append("<span>" + data[key].matches + "</span>");
                          $("#matchNext_" + key).append("<div class='ok_btn btn_matches'><button data-id='"+data[key].id+"' data-team='"+data[key].team+"' data-team2='"+data[key].team2+"' data-img1='"+data[key].img1+"' data-img2='"+data[key].img2+"'>Принять</button></div>");
                        }
                      matchId = data.id;
                      team = data.team;
                      team2 = data.team2;
                      img1 = data.img1;
                      img2 = data.img2;
                  }
             },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(ajaxOptions)
            }
        });
    });
    
    $(document).on("click", ".ok_btn.btn_matches button", function(){
        let matchId = $(this).data('id');
        let team = $(this).data('team');
        let team2 = $(this).data('team2');
        let img1 = $(this).data('img1');
        let img2 = $(this).data('img2');
        console.log(matchId)
        console.log(team)
        console.log(team2)
        $.ajax({
              type: 'post',
              url: "ajax/setMatch.php",
              data: {id: matchId, team: team, team2: team2},
              //dataType: 'json',
              success: function(data){
                  console.log(data)
                  $(".match_images").html('');
                  $(".ok_btn button").hide();
                  $(".matches-tour").append("<div class=\"matches-tour-images\" data-id='" + matchId + "'><img src=" + img1 + " /><img src=" + img2 + " /></div>");
             },
            error: function (xhr, ajaxOptions, thrownError) {
                
            }
        });
    });
    
    $(document).on("click", ".ok_btn.btn_player button", function(){
        let id = $(this).data('id');
        let player = $("#add_player_form [name=q]").val();
        let img = $(this).data('img');
        $.ajax({
              type: 'post',
              url: "ajax/setPlayer.php",
              data: {id: id, player: player},
              //dataType: 'json',
              success: function(data){
                  console.log(data)
                  $(".match_images").html('');
                  $(".ok_btn button").hide();
             },
            error: function (xhr, ajaxOptions, thrownError) {
                
            }
        });
    });
    
    $(document).on("submit", "#add_player_form", function(e){
        e.preventDefault(); console.log(14)
        $.ajax({
              type: 'post',
              url: "ajax/addPlayer.php",
              data: $(this).serialize(),
              dataType: 'json',
              success: function(data){
                  console.log(data)
                  if(data){
                      $(".match_images").html('');
                      for (const key in data) {
                          let id = 'matchNext_'+key;
                          $(".match_images").append("<div id='"+id+"'></div>");
                          $("#matchNext_" + key).append("<img src='/khl/images/" + data[key].image + "' />");
                          $("#matchNext_" + key).append("<div class='ok_btn btn_player'><button data-id='"+data[key].id+"' data-team='"+data[key].name+"' data-img='"+data[key].image+"'>Принять</button></div>");
                      }
                  }
             },
            error: function (xhr, ajaxOptions, thrownError) {
                
            }
        });
    });
});

function setMatch()
{
    
}