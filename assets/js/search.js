$.datepicker.regional['ru'] = {
	closeText: 'Закрыть',
	prevText: 'Предыдущий',
	nextText: 'Следующий',
	currentText: 'Сегодня',
	monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
	monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
	dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
	dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
	dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
	weekHeader: 'Не',
	dateFormat: 'dd.mm.yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};

$.datepicker.setDefaults($.datepicker.regional['ru']);

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

function scrollToBlock(to, speed, offset) {
  if (typeof to === 'string') to = $(to);
  if (!to[0]) return;
  offset = offset || 72;
  speed = speed || 1000;
  $('html, body').stop().animate({
    scrollTop: to.offset().top - offset
  }, speed);
}

  $(function(){
    $('.menu-trigger').on('click', function(event) {
      event.preventDefault();
      $('.panel-box').toggleClass('open');
      $('body').toggleClass('lock');
      $('#navbar-collapse-1').removeClass('in');
    });
    
    $('#menuChamp').hide();
    $('#champ').mouseover(function() {
        $('#menuChamp').show();
    }).mouseout(function() {
        $('#menuChamp').hide();
    });

		$("select").chosen({
			no_results_text: "Не нашлось",
			search_contains: true,
			width: '180px'
		});

		$('.scroll-to-btn').on('click', function () {
		  var to = $(this).attr('href') || $(this).data('href');
		  scrollToBlock(to);
		  return false;
		});

		$("select[name=teams]").change(function(){
			var url = Routing.generate('player', {
				'team': $(this).val(), 'country': $(this).data('country')
			});
			window.location.href = url;
		});

		$("select[name=country][placeholder=Страна]").change(function(){
			var url = Routing.generate('player', {
				'country': $(this).val(), 'team': $(this).data('team')
			});
			window.location.href = url;
		});
    $("select[name=country][placeholder=Гражданство]").change(function(){
			var url = Routing.generate('player_all', {
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
        }
      });
      } else {
        $(".search_result, .search_result_items").hide();
      }
  });

  $(document).on("keyup", '#rus_player', function() {
    if(this.value.length >= 1){
        $.ajax({
            type: 'post',
            url: Routing.generate('news_search'),
            data: {query: this.value, form_player: 'y'},
            dataType: 'json',
            success: function(data){
                $(".player_search_result_items").empty().hide();
                if(data){
                    $(".player_search_result, .player_search_result_items").show();
                    $.each(data, function(id, name){
                        $(".player_search_result_items")
                        .append("<div class=\"player_form_search\" data-id='"+id+"'>"+name+"</div>");

                    });
                    $("body").not(".search-top").click(function(){
                      $(".player_search_result, .player_search_result_items").hide();
                    });
                    $(document).on('click', '.player_form_search', function(){
                      $("#rus_player").val($(this).text());
                      $("#rus_player_hidden").val($(this).data('id'));
                      $.ajax({
                        type: 'post',
                        url: Routing.generate('session_player_add', {'id': $(this).data('id')}),
                        success: function(response){
                            console.log(response);
                        }
                    });
                    });
                } else {
                    $(".player_search_result, .player_search_result_items").hide();
                }
                console.log(data);
           },
     error: function (xhr, ajaxOptions, thrownError) {
      }
    });
    } else {
      $(".player_search_result, .player_search_result_items").hide();
    }
});

$(document).on('click', '.tour_js', function(){
  let $this = $(this);
  let tour = $this.data('tour');
  let country = $this.data('country');
  let season = $this.data('season');
  $.ajax({
    type: 'post',
    url: Routing.generate('championships_tour', {'tour':tour, 'season': season, 'country': country}),
    dataType: 'json',
    success: function(response){
      $(".champship-table tbody").html(response.response);
      $(".tour_text span").text(tour);
      $(".tour_js").removeClass('active');
      $this.addClass('active');
      history.pushState(null, '', Routing.generate('championships', {'tour':tour, 'season': season, 'country': country}))
    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(xhr.status);
      console.log(thrownError);
    }
});
});

  $(document).on('click', "#shipplayersUpdate", function(){
    var arGames = [];
		var champ = $(this).data('champ');
    let under = $(this).data('under');
    $(".shipplayer-input").each(function(){
      var game = $(this).val();
      if(game != 0){
        arGames.push([
          $(this).data('id'),
          $(this).data('player'),
          parseInt(game)
        ]);
      }
    });
    $.ajax({
        type: 'post',
        url: Routing.generate('shipplayers_update'),
        data: {query: arGames, champ: champ, under: under},
        dataType: 'json',
        success: function(response){
          var arr = JSON.parse(response);
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

  $(document).on('click', "#nhlplayersUpdate", function(){
    let arGoalsReg = [];
    $(".nhlplayer-input.goalReg").each(function(){
      let goalReg = $(this).val();
      if(goalReg != 0){
        arGoalsReg.push([
          $(this).data('id'),
          $(this).data('player'),
          parseInt(goalReg)
        ]);
      }
    });
    let arAssistReg = [];
    $(".nhlplayer-input.assistReg").each(function(){
      let assistReg = $(this).val();
      if(assistReg != 0){
        arAssistReg.push([
          $(this).data('id'),
          $(this).data('player'),
          parseInt(assistReg)
        ]);
      }
    });
    let arGoalsPo = [];
    $(".nhlplayer-input.goalPo").each(function(){
      let goalPo = $(this).val();
      if(goalPo != 0){
        arGoalsPo.push([
          $(this).data('id'),
          $(this).data('player'),
          parseInt(goalPo)
        ]);
      }
    });
    let arAssistPo = [];
    $(".nhlplayer-input.assistPo").each(function(){
      var game = $(this).val();
      if(game != 0){
        arAssistPo.push([
          $(this).data('id'),
          $(this).data('player'),
          parseInt(game)
        ]);
      }
    });
    let arGameReg = [];
    $(".nhlplayer-input.gameReg").each(function(){
      let gameReg = $(this).val();
      if(gameReg != 0){
        arGameReg.push([
          $(this).data('id'),
          $(this).data('player'),
          parseInt(gameReg)
        ]);
      }
    });
    let arMissedReg = [];
    $(".nhlplayer-input.missedReg").each(function(){
      let missedReg = $(this).val();
      if(missedReg != 0){
        arMissedReg.push([
          $(this).data('id'),
          $(this).data('player'),
          parseInt(missedReg)
        ]);
      }
    });
    let arZeroReg = [];
    $(".nhlplayer-input.zeroReg").each(function(){
      let zeroReg = $(this).val();
      if(zeroReg != 0){
        arZeroReg.push([
          $(this).data('id'),
          $(this).data('player'),
          parseInt(zeroReg)
        ]);
      }
    });
    let arGamePo = [];
    $(".nhlplayer-input.gamePo").each(function(){
      let gamePo = $(this).val();
      if(gamePo != 0){
        arGamePo.push([
          $(this).data('id'),
          $(this).data('player'),
          parseInt(gamePo)
        ]);
      }
    });
    let arMissedPo = [];
    $(".nhlplayer-input.missedPo").each(function(){
      let missedPo = $(this).val();
      if(missedPo != 0){
        arMissedPo.push([
          $(this).data('id'),
          $(this).data('player'),
          parseInt(missedPo)
        ]);
      }
    });
    let arZeroPo = [];
    $(".nhlplayer-input.zeroPo").each(function(){
      let zeroPo = $(this).val();
      if(zeroPo != 0){
        arZeroPo.push([
          $(this).data('id'),
          $(this).data('player'),
          parseInt(zeroPo)
        ]);
      }
    });
    $.ajax({
        type: 'post',
        url: Routing.generate('nhlplayers_update'),
        data: {arGoalsReg: arGoalsReg, arAssistReg: arAssistReg, arGoalsPo: arGoalsPo, arAssistPo: arAssistPo, arGameReg: arGameReg, 
          arMissedReg: arMissedReg, arZeroReg: arZeroReg, arGamePo: arGamePo, arMissedPo: arMissedPo, arZeroPo: arZeroPo},
        dataType: 'json',
        success: function(response){
          var arr = JSON.parse(response);
          $(".nhlplayer-input").val(0);
          /*arr.forEach(function(item, i, arr) {
            $("[data-id="+item[0]+"][data-param='game']").text(item[1]);
          });*/
        },
        error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr.status);
          console.log(thrownError);
        }
    });
  });

  $(document).on('click', ".changeGameGoalPlayer", function(){
    var change = $(this).data('change');
    var id = $(this).data('id');
    var season = $(this).data('season');
    var team = $(this).data('team');
    var route = $(this).data('path');
		var turnir = $(this).data('turnir');
		var $this = $(this);
		var params = {'id': id, 'season': season, 'change': change, 'turnir': turnir};
		$(".loading[data-id="+id+"]").css('display', 'inline-block');
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
            $(".spiski.selected").removeClass('selected');
            $(".spiski[data-id="+id+"]").addClass('selected');
						if(route == 'playeradmin_editChampTotal'){
							$("[data-id="+id+"][data-param='totalgame']").text(data['game']);
            	$("[data-id="+id+"][data-param='totalgoal']").text(data['goal']);
						} else if(route == 'playeradmin_editNationCup'){
	            	$("[data-id="+id+"][data-param='cup']").text(data['goal']);
						} else if(route == 'playeradmin_editNationSupercup'){
								$("[data-id="+id+"][data-param='supercup']").text(data['goal']);
						} else if(route == 'playeradmin_editNationEurocup'){
								$("[data-id="+id+"][data-param='eurocup']").text(data['goal']);
						} else if(route == 'playeradmin_editNationSbornie'){
								$("[data-id="+id+"][data-param='sbornie']").text(data['goal']);
						} else {
            	$("[data-id="+id+"][data-param='game']").text(data['game']);
            	$("[data-id="+id+"][data-param='goal']").text(data['goal']);
              $("[data-id="+id+"][data-param='gamePo']").text(data['gamePo']);
            	$("[data-id="+id+"][data-param='goalPo']").text(data['goalPo']);
						}
            $("[data-id="+id+"][data-param='assist']").text(data['assist']);
            $("[data-id="+id+"][data-param='score']").text(data['score']);
            $("[data-id="+id+"][data-param='missed']").text(data['missed']);
            $("[data-id="+id+"][data-param='zero']").text(data['zero']);
            $("[data-id="+id+"][data-param='assistPo']").text(data['assistPo']);
            $("[data-id="+id+"][data-param='scorePo']").text(data['scorePo']);
            $("[data-id="+id+"][data-param='missedPo']").text(data['missedPo']);
            $("[data-id="+id+"][data-param='zeroPo']").text(data['zeroPo']);
						$(".loading[data-id="+id+"]").hide();
						$this.addClass('changed-player');
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
      window.location.search = newArr.join('&');
  });

  $(document).on("click", ".nhl-matches .nhl-dates span[data-date]", function(){
    var data = $(this).data('date');
    $(".nhl-matches.champs").load("/nhl/date/" + data + " .nhl-matches.champs");
  });

  $(document).on("click", ".champ-tours .nhl-dates span[data-date]", function(){
    var data = $(this).data('date');
    $(".champ-tours").load("/championships/date/underleague-usa/" + data + " .champ-tours");
  });

  $("#datepicker").datepicker();


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
	var windowWidth = $(window).width() - 120;
	var totalSumMenuWidth = 0;

		$mainMenuItems.each(function(i, nextElement){
			var $nextElement = $(nextElement);
			totalSumMenuWidth += $nextElement.outerWidth(true);

			if(totalSumMenuWidth > windowWidth){
				$nextElement.addClass("removed");
			}
		});
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
			/*$removedItemsList.css({
				left: $removedItemsLink.offset().left + "px"
			});*/
			$(".navbar-toggle-sub").mouseover(function(){
				$(".removedItemsList").show();
			});
		}

		var __sectionMenuActive = "activeDrop";
		var __sectionMenuMenuID = "menuCatalogSection";
		var __sectionMenuOpener = "menuSection";
		var __sectionMenuDrop	 = "drop";
		var __active = "activeDrop";
		var __menuID = "mainMenu";
		var __opener = "eChild";
		var __drop	 = "drop";

		var $_self = $("#" + __menuID);
		var $_eChild = $_self.children("." + __opener);

		var openChild = function(){

			var $_this = $(this);
			if(!$_this.hasClass("removed")){

				__menuFirstOpenTimeoutID = setTimeout(function(){
					if($_this.is(":hover")){
						clearTimeout(__menuFirstOpenTimeoutID);
						$_sectionMenuEChild.removeClass(__sectionMenuActive).find("." + __sectionMenuDrop).hide();
						$_eChild.removeClass(__active).find("." + __drop).hide();
						$_this.addClass(__active).find("." + __drop).css("display", "table");
						return clearTimeout(__menuTimeoutID);
					}
				}, 300);

		}
    

	}

	var closeChild = function(){
		var $_captureThis = $(this);
		__menuTimeoutID = setTimeout(function(){
			$_captureThis.removeClass(__active).find("." + __drop).hide();
		}, 500);
	}

	$_eChild.hover(openChild, closeChild);
  $mainMenu.removeClass('start_menu');
}

$(window).on("resize", function(){
	sliceMainMenu(true);
});

$(document).ready(function(event){
	sliceMainMenu(false);
});


document.addEventListener('DOMContentLoaded', () => {

    const getSort = ({ target }) => {
        const order = (target.dataset.order = -(target.dataset.order || -1));
        const index = [...target.parentNode.cells].indexOf(target);
        const collator = new Intl.Collator(['en', 'ru'], { numeric: true });
        const comparator = (index, order) => (a, b) => order * collator.compare(
            b.children[index].innerText,
            a.children[index].innerText
        );

        for(const tBody of target.closest('table').tBodies)
            tBody.append(...[...tBody.rows].sort(comparator(index, order)));

        for(const cell of target.parentNode.cells)
            cell.classList.toggle('sorted', cell === target);
    };
		const thead = document.querySelectorAll('.table_sort thead tr')[1];
		//console.log(thead);
		if(thead != undefined)
    	thead.addEventListener('click', () => getSort(event));

});

function setCookie(name, value, options = {}) {

    options = {
      path: '/',
      ...options
    };
  
    if (options.expires instanceof Date) {
      options.expires = options.expires.toUTCString();
    }
  
    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);
  
    for (let optionKey in options) {
      updatedCookie += "; " + optionKey;
      let optionValue = options[optionKey];
      if (optionValue !== true) {
        updatedCookie += "=" + optionValue;
      }
    }
  
    document.cookie = updatedCookie;
}

$(document).on('click', '.js-cookie-data-warning__close', function() {
  $(".modal-cookie").removeAttr('open');
  setCookie('site_cookie', 'y', {'max-age': 3600 * 24 * 30});
});