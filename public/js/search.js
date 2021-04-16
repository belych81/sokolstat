function parseUrlQuery() {
	    var data = {};
	    if(location.search) {
	        var pair = (location.search.substr(1)).split('&');
	        for(var i = 0; i < pair.length; i ++) {
	            var param = pair[i].split('=');
	            data[param[0]] = param[1];
	        }
	    }
	    return data;
	}

  $(function(){
		$("select").chosen({
			no_results_text: "Не нашлось",
			search_contains: true,
			width: '180px'
		});

		$("select[name=teams]").change(function(){
			var url = Routing.generate('player', {
				'team': $(this).val(), 'country': $(this).data('country')
			});
			window.location.href = url;
		});

		$("select[name=country]").change(function(){
			var url = Routing.generate('player', {
				'country': $(this).val(), 'team': $(this).data('team')
			});
			window.location.href = url;
		});

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

  $("#shipplayersUpdate").click(function(){
    var arGames = [];
		var champ = $(this).data('champ');
    $(".shipplayer-input").each(function(){
      var game = $(this).val();
      if(game != 0){
        arGames.push([
          $(this).data('id'),
          $(this).data('player'),
          game
        ]);
      }
    });
    $.ajax({
        type: 'post',
        url: Routing.generate('shipplayers_update'),
        data: {query: arGames, champ: champ},
        dataType: 'json',
        success: function(response){
          var arr = JSON.parse(response);
          console.log(arr);
          arr.forEach(function(item, i, arr) {
            $("[data-id="+item[0]+"][data-param='game']").text(item[1]);
          });
        },
        error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr.status);
          console.log(thrownError);
        }
    });
  });

  $(".changeGameGoalPlayer").click(function(){
    var change = $(this).data('change');
    var id = $(this).data('id');
    var season = $(this).data('season');
    var team = $(this).data('team');
    var route = $(this).data('path');
		var turnir = $(this).data('turnir');
		var params = {'id': id, 'season': season, 'change': change};
		if(turnir != undefined){
			params['turnir'] = turnir;
		}
		if(route != 'player_editSb'){
			params['team'] = team;
		}
    $.ajax({
        type: 'post',
        url: Routing.generate(route, params),
        dataType: 'json',
        success: function(data){
          console.log(id);
          console.log(data);
            $(".spiski.selected").removeClass('selected');
            $(".spiski[data-id="+id+"]").addClass('selected');
            $("[data-id="+id+"][data-param='game']").text(data['game']);
            $("[data-id="+id+"][data-param='goal']").text(data['goal']);
            $("[data-id="+id+"][data-param='assist']").text(data['assist']);
            $("[data-id="+id+"][data-param='score']").text(data['score']);
            $("[data-id="+id+"][data-param='missed']").text(data['missed']);
            $("[data-id="+id+"][data-param='zero']").text(data['zero']);
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

  $("#selectPageMatches").change(function(){
    var maxMatches = $(this).val(),
      params = parseUrlQuery(),
      newArr = [];

      params['max'] = maxMatches;
      for (key in params){
        newArr.push(key + '=' + params[key]);
      }
      console.log(newArr);
      window.location.search = newArr.join('&');
  });

});

function sliceMainMenu(resize){

	var $mainMenu = $("#subMenu");
	if(resize == true){
		$mainMenu.find(".removed").each(function(i, nextElement){
			var $nextElement = $(nextElement);
			$mainMenu.append(
				$nextElement.removeClass("removed")
			)
		});
		$mainMenu.find(".removedItemsLink").remove();
	}

	var $mainMenuItems = $mainMenu.children("li");
	var visibleMenuWidth = $mainMenu.width() - 100;
	var windowWidth = $(window).width() - 100;
	var totalSumMenuWidth = 0;
console.log(windowWidth);
console.log(visibleMenuWidth);

		$mainMenuItems.each(function(i, nextElement){
			var $nextElement = $(nextElement);
			totalSumMenuWidth += $nextElement.outerWidth(true);

			if(totalSumMenuWidth > windowWidth){
				$nextElement.addClass("removed");
			}
		});
console.log(totalSumMenuWidth);
		var $removedItems = $mainMenu.find(".removed");
		if($removedItems.length > 0){
			var $removedItemsList = $("<ul/>").addClass("removedItemsList");
			var $removedItemsLink = $("<li/>").addClass("removedItemsLink").append($(`<button type="button" class="navbar-toggle-sub">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
			</button>`));
			$removedItems.each(function(i, nextElement){
				var $nextElement = $(nextElement);
				$removedItemsList.append(
					$nextElement
				)
			});
			$mainMenu.append($removedItemsLink.append($removedItemsList));
			$removedItemsList.css({
				left: $removedItemsLink.offset().left + "px"
			});
		}

}

$(window).on("resize", function(){
	sliceMainMenu(true);
});

$(document).ready(function(event){
	sliceMainMenu(false);
});
