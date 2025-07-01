(self["webpackChunk"] = self["webpackChunk"] || []).push([["custom"],{

/***/ "./assets/js/search.js":
/*!*****************************!*\
  !*** ./assets/js/search.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
__webpack_require__(/*! core-js/modules/es.string.search.js */ "./node_modules/core-js/modules/es.string.search.js");
__webpack_require__(/*! core-js/modules/es.function.bind.js */ "./node_modules/core-js/modules/es.function.bind.js");
__webpack_require__(/*! core-js/modules/es.parse-int.js */ "./node_modules/core-js/modules/es.parse-int.js");
__webpack_require__(/*! core-js/modules/es.object.keys.js */ "./node_modules/core-js/modules/es.object.keys.js");
__webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
__webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
__webpack_require__(/*! core-js/modules/es.array.join.js */ "./node_modules/core-js/modules/es.array.join.js");
__webpack_require__(/*! core-js/modules/es.array.find.js */ "./node_modules/core-js/modules/es.array.find.js");
__webpack_require__(/*! core-js/modules/web.timers.js */ "./node_modules/core-js/modules/web.timers.js");
__webpack_require__(/*! core-js/modules/es.array.index-of.js */ "./node_modules/core-js/modules/es.array.index-of.js");
__webpack_require__(/*! core-js/modules/es.array.sort.js */ "./node_modules/core-js/modules/es.array.sort.js");
__webpack_require__(/*! core-js/modules/es.date.to-string.js */ "./node_modules/core-js/modules/es.date.to-string.js");
__webpack_require__(/*! core-js/modules/es.array.is-array.js */ "./node_modules/core-js/modules/es.array.is-array.js");
__webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
__webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
__webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
__webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
__webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
__webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
__webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");
__webpack_require__(/*! core-js/modules/es.array.slice.js */ "./node_modules/core-js/modules/es.array.slice.js");
__webpack_require__(/*! core-js/modules/es.regexp.to-string.js */ "./node_modules/core-js/modules/es.regexp.to-string.js");
__webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
__webpack_require__(/*! core-js/modules/es.symbol.to-primitive.js */ "./node_modules/core-js/modules/es.symbol.to-primitive.js");
__webpack_require__(/*! core-js/modules/es.date.to-primitive.js */ "./node_modules/core-js/modules/es.date.to-primitive.js");
__webpack_require__(/*! core-js/modules/es.number.constructor.js */ "./node_modules/core-js/modules/es.number.constructor.js");
__webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
__webpack_require__(/*! core-js/modules/es.array.filter.js */ "./node_modules/core-js/modules/es.array.filter.js");
__webpack_require__(/*! core-js/modules/es.object.get-own-property-descriptor.js */ "./node_modules/core-js/modules/es.object.get-own-property-descriptor.js");
__webpack_require__(/*! core-js/modules/es.object.get-own-property-descriptors.js */ "./node_modules/core-js/modules/es.object.get-own-property-descriptors.js");
__webpack_require__(/*! core-js/modules/es.object.define-properties.js */ "./node_modules/core-js/modules/es.object.define-properties.js");
$.datepicker.regional['ru'] = {
  closeText: 'Закрыть',
  prevText: 'Предыдущий',
  nextText: 'Следующий',
  currentText: 'Сегодня',
  monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
  monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
  dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
  dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
  dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
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
  if (location.search) {
    var pair = location.search.substr(1).split('&');
    for (var i = 0; i < pair.length; i++) {
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
$(function () {
  $('.menu-trigger').on('click', function (event) {
    event.preventDefault();
    $('.panel-box').toggleClass('open');
    $('body').toggleClass('lock');
    $('#navbar-collapse-1').removeClass('in');
  });
  $('#menuChamp').hide();
  $('#champ').mouseover(function () {
    $('#menuChamp').show();
  }).mouseout(function () {
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
  $("select[name=teams]").change(function () {
    var url = Routing.generate('player', {
      'team': $(this).val(),
      'country': $(this).data('country')
    });
    window.location.href = url;
  });
  $("select[name=country][placeholder=Страна]").change(function () {
    var url = Routing.generate('player', {
      'country': $(this).val(),
      'team': $(this).data('team')
    });
    window.location.href = url;
  });
  $("select[name=country][placeholder=Гражданство]").change(function () {
    var url = Routing.generate('player_all', {
      'country': $(this).val(),
      'team': $(this).data('team')
    });
    window.location.href = url;
  });

  //Живой поиск
  $('.search_keywords').bind("keyup", function () {
    if (this.value.length >= 1) {
      $.ajax({
        type: 'post',
        url: Routing.generate('news_search'),
        data: {
          query: this.value
        },
        dataType: 'json',
        success: function success(data) {
          $(".search_result_items").empty().hide();
          if (data) {
            $(".search_result, .search_result_items").show();
            $.each(data, function (translit, name) {
              $(".search_result_items").append("<a href='/" + translit + "'>" + name + "</a>");
            });
            $("body").not(".search-top").click(function () {
              $(".search_result, .search_result_items").hide();
            });
          } else {
            $(".search_result, .search_result_items").hide();
          }
          console.log(data);
        },
        error: function error(xhr, ajaxOptions, thrownError) {}
      });
    } else {
      $(".search_result, .search_result_items").hide();
    }
  });
  $(document).on("keyup", '#rus_player', function () {
    if (this.value.length >= 1) {
      $.ajax({
        type: 'post',
        url: Routing.generate('news_search'),
        data: {
          query: this.value,
          form_player: 'y'
        },
        dataType: 'json',
        success: function success(data) {
          $(".player_search_result_items").empty().hide();
          if (data) {
            $(".player_search_result, .player_search_result_items").show();
            $.each(data, function (id, name) {
              $(".player_search_result_items").append("<div class=\"player_form_search\" data-id='" + id + "'>" + name + "</div>");
            });
            $("body").not(".search-top").click(function () {
              $(".player_search_result, .player_search_result_items").hide();
            });
            $(document).on('click', '.player_form_search', function () {
              $("#rus_player").val($(this).text());
              $("#rus_player_hidden").val($(this).data('id'));
              $.ajax({
                type: 'post',
                url: Routing.generate('session_player_add', {
                  'id': $(this).data('id')
                }),
                success: function success(response) {
                  console.log(response);
                }
              });
            });
          } else {
            $(".player_search_result, .player_search_result_items").hide();
          }
          console.log(data);
        },
        error: function error(xhr, ajaxOptions, thrownError) {}
      });
    } else {
      $(".player_search_result, .player_search_result_items").hide();
    }
  });
  $(document).on('click', '.tour_js', function () {
    var $this = $(this);
    var tour = $this.data('tour');
    var country = $this.data('country');
    var season = $this.data('season');
    $.ajax({
      type: 'post',
      url: Routing.generate('championships_tour', {
        'tour': tour,
        'season': season,
        'country': country
      }),
      dataType: 'json',
      success: function success(response) {
        $(".champship-table tbody").html(response.response);
        $(".tour_text span").text(tour);
        $(".tour_js").removeClass('active');
        $this.addClass('active');
        history.pushState(null, '', Routing.generate('championships', {
          'tour': tour,
          'season': season,
          'country': country
        }));
      },
      error: function error(xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
      }
    });
  });
  $(document).on('click', "#shipplayersUpdate", function () {
    var arGames = [];
    var champ = $(this).data('champ');
    var under = $(this).data('under');
    $(".shipplayer-input").each(function () {
      var game = $(this).val();
      if (game != 0) {
        arGames.push([$(this).data('id'), $(this).data('player'), parseInt(game)]);
      }
    });
    $.ajax({
      type: 'post',
      url: Routing.generate('shipplayers_update'),
      data: {
        query: arGames,
        champ: champ,
        under: under
      },
      dataType: 'json',
      success: function success(response) {
        var arr = JSON.parse(response);
        arr.forEach(function (item, i, arr) {
          $("[data-id=" + item[0] + "][data-param='game']").text(item[1]);
        });
      },
      error: function error(xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
      }
    });
  });
  $(document).on('click', "#nhlplayersUpdate", function () {
    var arGoalsReg = [];
    $(".nhlplayer-input.goalReg").each(function () {
      var goalReg = $(this).val();
      if (goalReg != 0) {
        arGoalsReg.push([$(this).data('id'), $(this).data('player'), parseInt(goalReg)]);
      }
    });
    var arAssistReg = [];
    $(".nhlplayer-input.assistReg").each(function () {
      var assistReg = $(this).val();
      if (assistReg != 0) {
        arAssistReg.push([$(this).data('id'), $(this).data('player'), parseInt(assistReg)]);
      }
    });
    var arGoalsPo = [];
    $(".nhlplayer-input.goalPo").each(function () {
      var goalPo = $(this).val();
      if (goalPo != 0) {
        arGoalsPo.push([$(this).data('id'), $(this).data('player'), parseInt(goalPo)]);
      }
    });
    var arAssistPo = [];
    $(".nhlplayer-input.assistPo").each(function () {
      var game = $(this).val();
      if (game != 0) {
        arAssistPo.push([$(this).data('id'), $(this).data('player'), parseInt(game)]);
      }
    });
    var arGameReg = [];
    $(".nhlplayer-input.gameReg").each(function () {
      var gameReg = $(this).val();
      if (gameReg != 0) {
        arGameReg.push([$(this).data('id'), $(this).data('player'), parseInt(gameReg)]);
      }
    });
    var arMissedReg = [];
    $(".nhlplayer-input.missedReg").each(function () {
      var missedReg = $(this).val();
      if (missedReg != 0) {
        arMissedReg.push([$(this).data('id'), $(this).data('player'), parseInt(missedReg)]);
      }
    });
    var arZeroReg = [];
    $(".nhlplayer-input.zeroReg").each(function () {
      var zeroReg = $(this).val();
      if (zeroReg != 0) {
        arZeroReg.push([$(this).data('id'), $(this).data('player'), parseInt(zeroReg)]);
      }
    });
    var arGamePo = [];
    $(".nhlplayer-input.gamePo").each(function () {
      var gamePo = $(this).val();
      if (gamePo != 0) {
        arGamePo.push([$(this).data('id'), $(this).data('player'), parseInt(gamePo)]);
      }
    });
    var arMissedPo = [];
    $(".nhlplayer-input.missedPo").each(function () {
      var missedPo = $(this).val();
      if (missedPo != 0) {
        arMissedPo.push([$(this).data('id'), $(this).data('player'), parseInt(missedPo)]);
      }
    });
    var arZeroPo = [];
    $(".nhlplayer-input.zeroPo").each(function () {
      var zeroPo = $(this).val();
      if (zeroPo != 0) {
        arZeroPo.push([$(this).data('id'), $(this).data('player'), parseInt(zeroPo)]);
      }
    });
    $.ajax({
      type: 'post',
      url: Routing.generate('nhlplayers_update'),
      data: {
        arGoalsReg: arGoalsReg,
        arAssistReg: arAssistReg,
        arGoalsPo: arGoalsPo,
        arAssistPo: arAssistPo,
        arGameReg: arGameReg,
        arMissedReg: arMissedReg,
        arZeroReg: arZeroReg,
        arGamePo: arGamePo,
        arMissedPo: arMissedPo,
        arZeroPo: arZeroPo
      },
      dataType: 'json',
      success: function success(response) {
        var arr = JSON.parse(response);
        $(".nhlplayer-input").val(0);
        /*arr.forEach(function(item, i, arr) {
          $("[data-id="+item[0]+"][data-param='game']").text(item[1]);
        });*/
      },
      error: function error(xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
      }
    });
  });
  $(document).on('click', ".changeGameGoalPlayer", function () {
    var change = $(this).data('change');
    var id = $(this).data('id');
    var season = $(this).data('season');
    var team = $(this).data('team');
    var route = $(this).data('path');
    var turnir = $(this).data('turnir');
    var $this = $(this);
    var params = {
      'id': id,
      'season': season,
      'change': change,
      'turnir': turnir
    };
    $(".loading[data-id=" + id + "]").css('display', 'inline-block');
    if (turnir != undefined) {
      params['turnir'] = turnir;
    }
    if (route != 'player_editSb') {
      params['team'] = team;
    }
    $.ajax({
      type: 'post',
      url: Routing.generate(route, params),
      dataType: 'json',
      success: function success(data) {
        $(".spiski.selected").removeClass('selected');
        $(".spiski[data-id=" + id + "]").addClass('selected');
        if (route == 'playeradmin_editChampTotal') {
          $("[data-id=" + id + "][data-param='totalgame']").text(data['game']);
          $("[data-id=" + id + "][data-param='totalgoal']").text(data['goal']);
        } else if (route == 'playeradmin_editNationCup') {
          $("[data-id=" + id + "][data-param='cup']").text(data['goal']);
        } else if (route == 'playeradmin_editNationSupercup') {
          $("[data-id=" + id + "][data-param='supercup']").text(data['goal']);
        } else if (route == 'playeradmin_editNationEurocup') {
          $("[data-id=" + id + "][data-param='eurocup']").text(data['goal']);
        } else if (route == 'playeradmin_editNationSbornie') {
          $("[data-id=" + id + "][data-param='sbornie']").text(data['goal']);
        } else {
          $("[data-id=" + id + "][data-param='game']").text(data['game']);
          $("[data-id=" + id + "][data-param='goal']").text(data['goal']);
          $("[data-id=" + id + "][data-param='gamePo']").text(data['gamePo']);
          $("[data-id=" + id + "][data-param='goalPo']").text(data['goalPo']);
        }
        $("[data-id=" + id + "][data-param='assist']").text(data['assist']);
        $("[data-id=" + id + "][data-param='score']").text(data['score']);
        $("[data-id=" + id + "][data-param='missed']").text(data['missed']);
        $("[data-id=" + id + "][data-param='zero']").text(data['zero']);
        $("[data-id=" + id + "][data-param='assistPo']").text(data['assistPo']);
        $("[data-id=" + id + "][data-param='scorePo']").text(data['scorePo']);
        $("[data-id=" + id + "][data-param='missedPo']").text(data['missedPo']);
        $("[data-id=" + id + "][data-param='zeroPo']").text(data['zeroPo']);
        $(".loading[data-id=" + id + "]").hide();
        $this.addClass('changed-player');
      },
      error: function error(xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
      }
    });
  });
  $(".letters-list li").click(function () {
    var letter = $(this).text();
    $.ajax({
      type: 'post',
      url: Routing.generate('team_get_by_letter', {
        'letter': letter
      }),
      dataType: 'json',
      success: function success(data) {
        var newHtml = "";
        for (var i = 0, cnt = data.teams.length; i < cnt; i++) {
          var detailUrl = Routing.generate('team_show', {
            'code': data.teams[i][1]
          });
          newHtml += "<li><a href='" + detailUrl + "' class='spiski'>" + data.teams[i][0] + "</a></li>";
        }
        $(".clubs-list").html(newHtml);
      },
      error: function error(xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
      }
    });
  });
  $("#selectPageMatches").change(function () {
    var maxMatches = $(this).val(),
      params = parseUrlQuery(),
      newArr = [];
    params['max'] = maxMatches;
    for (key in params) {
      newArr.push(key + '=' + params[key]);
    }
    window.location.search = newArr.join('&');
  });
  $(document).on("click", ".nhl-matches .nhl-dates span[data-date]", function () {
    var data = $(this).data('date');
    $(".nhl-matches.champs").load("/nhl/date/" + data + " .nhl-matches.champs");
  });
  $(document).on("click", ".champ-tours .nhl-dates span[data-date]", function () {
    var data = $(this).data('date');
    $(".champ-tours").load("/championships/date/underleague-usa/" + data + " .champ-tours");
  });
  $("#datepicker").datepicker();
});
function sliceMainMenu(resize) {
  var $mainMenu = $("#subMenu");
  if (resize == true) {
    $mainMenu.find(".removed").each(function (i, nextElement) {
      var $nextElement = $(nextElement);
      $mainMenu.append($nextElement.removeClass("removed"));
    });
    $mainMenu.find(".removedItemsLink").remove();
  }
  var $mainMenuItems = $mainMenu.children("li");
  var visibleMenuWidth = $mainMenu.width() - 100;
  var windowWidth = $(window).width() - 120;
  var totalSumMenuWidth = 0;
  $mainMenuItems.each(function (i, nextElement) {
    var $nextElement = $(nextElement);
    totalSumMenuWidth += $nextElement.outerWidth(true);
    if (totalSumMenuWidth > windowWidth) {
      $nextElement.addClass("removed");
    }
  });
  var $removedItems = $mainMenu.find(".removed");
  if ($removedItems.length > 0) {
    var $removedItemsList = $("<ul/>").addClass("removedItemsList");
    var $removedItemsLink = $("<li/>").addClass("removedItemsLink").append($("<button type=\"button\" class=\"navbar-toggle-sub\">\n\t\t\t\t\t<span class=\"icon-bar\"></span>\n\t\t\t\t\t<span class=\"icon-bar\"></span>\n\t\t\t\t\t<span class=\"icon-bar\"></span>\n\t\t\t</button>"));
    $removedItems.each(function (i, nextElement) {
      var $nextElement = $(nextElement);
      $removedItemsList.append($nextElement);
    });
    $mainMenu.append($removedItemsLink.append($removedItemsList));
    /*$removedItemsList.css({
    	left: $removedItemsLink.offset().left + "px"
    });*/
    $(".navbar-toggle-sub").mouseover(function () {
      $(".removedItemsList").show();
    });
  }
  var __sectionMenuActive = "activeDrop";
  var __sectionMenuMenuID = "menuCatalogSection";
  var __sectionMenuOpener = "menuSection";
  var __sectionMenuDrop = "drop";
  var __active = "activeDrop";
  var __menuID = "mainMenu";
  var __opener = "eChild";
  var __drop = "drop";
  var $_self = $("#" + __menuID);
  var $_eChild = $_self.children("." + __opener);
  var openChild = function openChild() {
    var $_this = $(this);
    if (!$_this.hasClass("removed")) {
      __menuFirstOpenTimeoutID = setTimeout(function () {
        if ($_this.is(":hover")) {
          clearTimeout(__menuFirstOpenTimeoutID);
          $_sectionMenuEChild.removeClass(__sectionMenuActive).find("." + __sectionMenuDrop).hide();
          $_eChild.removeClass(__active).find("." + __drop).hide();
          $_this.addClass(__active).find("." + __drop).css("display", "table");
          return clearTimeout(__menuTimeoutID);
        }
      }, 300);
    }
  };
  var closeChild = function closeChild() {
    var $_captureThis = $(this);
    __menuTimeoutID = setTimeout(function () {
      $_captureThis.removeClass(__active).find("." + __drop).hide();
    }, 500);
  };
  $_eChild.hover(openChild, closeChild);
  $mainMenu.removeClass('start_menu');
}
$(window).on("resize", function () {
  sliceMainMenu(true);
});
$(document).ready(function (event) {
  sliceMainMenu(false);
});
document.addEventListener('DOMContentLoaded', function () {
  var getSort = function getSort(_ref) {
    var target = _ref.target;
    var order = target.dataset.order = -(target.dataset.order || -1);
    var index = _toConsumableArray(target.parentNode.cells).indexOf(target);
    var collator = new Intl.Collator(['en', 'ru'], {
      numeric: true
    });
    var comparator = function comparator(index, order) {
      return function (a, b) {
        return order * collator.compare(b.children[index].innerText, a.children[index].innerText);
      };
    };
    var _iterator = _createForOfIteratorHelper(target.closest('table').tBodies),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var tBody = _step.value;
        tBody.append.apply(tBody, _toConsumableArray(_toConsumableArray(tBody.rows).sort(comparator(index, order))));
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
    var _iterator2 = _createForOfIteratorHelper(target.parentNode.cells),
      _step2;
    try {
      for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
        var cell = _step2.value;
        cell.classList.toggle('sorted', cell === target);
      }
    } catch (err) {
      _iterator2.e(err);
    } finally {
      _iterator2.f();
    }
  };
  var thead = document.querySelectorAll('.table_sort thead tr')[1];
  //console.log(thead);
  if (thead != undefined) thead.addEventListener('click', function () {
    return getSort(event);
  });
});
function setCookie(name, value) {
  var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
  options = _objectSpread({
    path: '/'
  }, options);
  if (options.expires instanceof Date) {
    options.expires = options.expires.toUTCString();
  }
  var updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);
  for (var optionKey in options) {
    updatedCookie += "; " + optionKey;
    var optionValue = options[optionKey];
    if (optionValue !== true) {
      updatedCookie += "=" + optionValue;
    }
  }
  document.cookie = updatedCookie;
}
$(document).on('click', '.js-cookie-data-warning__close', function () {
  $(".modal-cookie").removeAttr('open');
  setCookie('site_cookie', 'y', {
    'max-age': 3600 * 24 * 30
  });
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_modules_es_object_define-property_js-node_modules_core-js_module-38e327","vendors-node_modules_core-js_modules_es_array_filter_js-node_modules_core-js_modules_es_array-ce2536"], () => (__webpack_exec__("./assets/js/search.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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UUFBUSxDQUFDeUosTUFBTSxHQUFHSixhQUFhO0FBQ25DO0FBRUFuTyxDQUFDLENBQUM4RSxRQUFRLENBQUMsQ0FBQ3pDLEVBQUUsQ0FBQyxPQUFPLEVBQUUsZ0NBQWdDLEVBQUUsWUFBVztFQUNuRXJDLENBQUMsQ0FBQyxlQUFlLENBQUMsQ0FBQ3dPLFVBQVUsQ0FBQyxNQUFNLENBQUM7RUFDckNiLFNBQVMsQ0FBQyxhQUFhLEVBQUUsR0FBRyxFQUFFO0lBQUMsU0FBUyxFQUFFLElBQUksR0FBRyxFQUFFLEdBQUc7RUFBRSxDQUFDLENBQUM7QUFDNUQsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL3NlYXJjaC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyIkLmRhdGVwaWNrZXIucmVnaW9uYWxbJ3J1J10gPSB7XG5cdGNsb3NlVGV4dDogJ9CX0LDQutGA0YvRgtGMJyxcblx0cHJldlRleHQ6ICfQn9GA0LXQtNGL0LTRg9GJ0LjQuScsXG5cdG5leHRUZXh0OiAn0KHQu9C10LTRg9GO0YnQuNC5Jyxcblx0Y3VycmVudFRleHQ6ICfQodC10LPQvtC00L3RjycsXG5cdG1vbnRoTmFtZXM6IFsn0K/QvdCy0LDRgNGMJywn0KTQtdCy0YDQsNC70YwnLCfQnNCw0YDRgicsJ9CQ0L/RgNC10LvRjCcsJ9Cc0LDQuScsJ9CY0Y7QvdGMJywn0JjRjtC70YwnLCfQkNCy0LPRg9GB0YInLCfQodC10L3RgtGP0LHRgNGMJywn0J7QutGC0Y/QsdGA0YwnLCfQndC+0Y/QsdGA0YwnLCfQlNC10LrQsNCx0YDRjCddLFxuXHRtb250aE5hbWVzU2hvcnQ6IFsn0K/QvdCyJywn0KTQtdCyJywn0JzQsNGAJywn0JDQv9GAJywn0JzQsNC5Jywn0JjRjtC9Jywn0JjRjtC7Jywn0JDQstCzJywn0KHQtdC9Jywn0J7QutGCJywn0J3QvtGPJywn0JTQtdC6J10sXG5cdGRheU5hbWVzOiBbJ9Cy0L7RgdC60YDQtdGB0LXQvdGM0LUnLCfQv9C+0L3QtdC00LXQu9GM0L3QuNC6Jywn0LLRgtC+0YDQvdC40LonLCfRgdGA0LXQtNCwJywn0YfQtdGC0LLQtdGA0LMnLCfQv9GP0YLQvdC40YbQsCcsJ9GB0YPQsdCx0L7RgtCwJ10sXG5cdGRheU5hbWVzU2hvcnQ6IFsn0LLRgdC6Jywn0L/QvdC0Jywn0LLRgtGAJywn0YHRgNC0Jywn0YfRgtCyJywn0L/RgtC9Jywn0YHQsdGCJ10sXG5cdGRheU5hbWVzTWluOiBbJ9CS0YEnLCfQn9C9Jywn0JLRgicsJ9Ch0YAnLCfQp9GCJywn0J/RgicsJ9Ch0LEnXSxcblx0d2Vla0hlYWRlcjogJ9Cd0LUnLFxuXHRkYXRlRm9ybWF0OiAnZGQubW0ueXknLFxuXHRmaXJzdERheTogMSxcblx0aXNSVEw6IGZhbHNlLFxuXHRzaG93TW9udGhBZnRlclllYXI6IGZhbHNlLFxuXHR5ZWFyU3VmZml4OiAnJ1xufTtcblxuJC5kYXRlcGlja2VyLnNldERlZmF1bHRzKCQuZGF0ZXBpY2tlci5yZWdpb25hbFsncnUnXSk7XG5cbmZ1bmN0aW9uIHBhcnNlVXJsUXVlcnkoKSB7XG4gICAgdmFyIGRhdGEgPSB7fTtcbiAgICBpZihsb2NhdGlvbi5zZWFyY2gpIHtcbiAgICAgICAgdmFyIHBhaXIgPSAobG9jYXRpb24uc2VhcmNoLnN1YnN0cigxKSkuc3BsaXQoJyYnKTtcbiAgICAgICAgZm9yKHZhciBpID0gMDsgaSA8IHBhaXIubGVuZ3RoOyBpICsrKSB7XG4gICAgICAgICAgICB2YXIgcGFyYW0gPSBwYWlyW2ldLnNwbGl0KCc9Jyk7XG4gICAgICAgICAgICBkYXRhW3BhcmFtWzBdXSA9IHBhcmFtWzFdO1xuICAgICAgICB9XG4gICAgfVxuICAgIHJldHVybiBkYXRhO1xufVxuXG5mdW5jdGlvbiBzY3JvbGxUb0Jsb2NrKHRvLCBzcGVlZCwgb2Zmc2V0KSB7XG4gIGlmICh0eXBlb2YgdG8gPT09ICdzdHJpbmcnKSB0byA9ICQodG8pO1xuICBpZiAoIXRvWzBdKSByZXR1cm47XG4gIG9mZnNldCA9IG9mZnNldCB8fCA3MjtcbiAgc3BlZWQgPSBzcGVlZCB8fCAxMDAwO1xuICAkKCdodG1sLCBib2R5Jykuc3RvcCgpLmFuaW1hdGUoe1xuICAgIHNjcm9sbFRvcDogdG8ub2Zmc2V0KCkudG9wIC0gb2Zmc2V0XG4gIH0sIHNwZWVkKTtcbn1cblxuICAkKGZ1bmN0aW9uKCl7XG4gICAgJCgnLm1lbnUtdHJpZ2dlcicpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGV2ZW50KSB7XG4gICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgJCgnLnBhbmVsLWJveCcpLnRvZ2dsZUNsYXNzKCdvcGVuJyk7XG4gICAgICAkKCdib2R5JykudG9nZ2xlQ2xhc3MoJ2xvY2snKTtcbiAgICAgICQoJyNuYXZiYXItY29sbGFwc2UtMScpLnJlbW92ZUNsYXNzKCdpbicpO1xuICAgIH0pO1xuICAgIFxuICAgICQoJyNtZW51Q2hhbXAnKS5oaWRlKCk7XG4gICAgJCgnI2NoYW1wJykubW91c2VvdmVyKGZ1bmN0aW9uKCkge1xuICAgICAgICAkKCcjbWVudUNoYW1wJykuc2hvdygpO1xuICAgIH0pLm1vdXNlb3V0KGZ1bmN0aW9uKCkge1xuICAgICAgICAkKCcjbWVudUNoYW1wJykuaGlkZSgpO1xuICAgIH0pO1xuXG5cdFx0JChcInNlbGVjdFwiKS5jaG9zZW4oe1xuXHRcdFx0bm9fcmVzdWx0c190ZXh0OiBcItCd0LUg0L3QsNGI0LvQvtGB0YxcIixcblx0XHRcdHNlYXJjaF9jb250YWluczogdHJ1ZSxcblx0XHRcdHdpZHRoOiAnMTgwcHgnXG5cdFx0fSk7XG5cblx0XHQkKCcuc2Nyb2xsLXRvLWJ0bicpLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcblx0XHQgIHZhciB0byA9ICQodGhpcykuYXR0cignaHJlZicpIHx8ICQodGhpcykuZGF0YSgnaHJlZicpO1xuXHRcdCAgc2Nyb2xsVG9CbG9jayh0byk7XG5cdFx0ICByZXR1cm4gZmFsc2U7XG5cdFx0fSk7XG5cblx0XHQkKFwic2VsZWN0W25hbWU9dGVhbXNdXCIpLmNoYW5nZShmdW5jdGlvbigpe1xuXHRcdFx0dmFyIHVybCA9IFJvdXRpbmcuZ2VuZXJhdGUoJ3BsYXllcicsIHtcblx0XHRcdFx0J3RlYW0nOiAkKHRoaXMpLnZhbCgpLCAnY291bnRyeSc6ICQodGhpcykuZGF0YSgnY291bnRyeScpXG5cdFx0XHR9KTtcblx0XHRcdHdpbmRvdy5sb2NhdGlvbi5ocmVmID0gdXJsO1xuXHRcdH0pO1xuXG5cdFx0JChcInNlbGVjdFtuYW1lPWNvdW50cnldW3BsYWNlaG9sZGVyPdCh0YLRgNCw0L3QsF1cIikuY2hhbmdlKGZ1bmN0aW9uKCl7XG5cdFx0XHR2YXIgdXJsID0gUm91dGluZy5nZW5lcmF0ZSgncGxheWVyJywge1xuXHRcdFx0XHQnY291bnRyeSc6ICQodGhpcykudmFsKCksICd0ZWFtJzogJCh0aGlzKS5kYXRhKCd0ZWFtJylcblx0XHRcdH0pO1xuXHRcdFx0d2luZG93LmxvY2F0aW9uLmhyZWYgPSB1cmw7XG5cdFx0fSk7XG4gICAgJChcInNlbGVjdFtuYW1lPWNvdW50cnldW3BsYWNlaG9sZGVyPdCT0YDQsNC20LTQsNC90YHRgtCy0L5dXCIpLmNoYW5nZShmdW5jdGlvbigpe1xuXHRcdFx0dmFyIHVybCA9IFJvdXRpbmcuZ2VuZXJhdGUoJ3BsYXllcl9hbGwnLCB7XG5cdFx0XHRcdCdjb3VudHJ5JzogJCh0aGlzKS52YWwoKSwgJ3RlYW0nOiAkKHRoaXMpLmRhdGEoJ3RlYW0nKVxuXHRcdFx0fSk7XG5cdFx0XHR3aW5kb3cubG9jYXRpb24uaHJlZiA9IHVybDtcblx0XHR9KTtcblxuICAgIC8v0JbQuNCy0L7QuSDQv9C+0LjRgdC6XG4gIFx0JCgnLnNlYXJjaF9rZXl3b3JkcycpLmJpbmQoXCJrZXl1cFwiLCBmdW5jdGlvbigpIHtcbiAgICAgIGlmKHRoaXMudmFsdWUubGVuZ3RoID49IDEpe1xuICAgICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICAgIHR5cGU6ICdwb3N0JyxcbiAgICAgICAgICAgICAgdXJsOiBSb3V0aW5nLmdlbmVyYXRlKCduZXdzX3NlYXJjaCcpLFxuICAgICAgICAgICAgICBkYXRhOiB7cXVlcnk6IHRoaXMudmFsdWV9LFxuICAgICAgICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhKXtcbiAgICAgICAgICAgICAgICAgICQoXCIuc2VhcmNoX3Jlc3VsdF9pdGVtc1wiKS5lbXB0eSgpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICAgIGlmKGRhdGEpe1xuICAgICAgICAgICAgICAgICAgICAgICQoXCIuc2VhcmNoX3Jlc3VsdCwgLnNlYXJjaF9yZXN1bHRfaXRlbXNcIikuc2hvdygpO1xuICAgICAgICAgICAgICAgICAgICAgICQuZWFjaChkYXRhLCBmdW5jdGlvbih0cmFuc2xpdCwgbmFtZSl7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICQoXCIuc2VhcmNoX3Jlc3VsdF9pdGVtc1wiKVxuICAgICAgICAgICAgICAgICAgICAgICAgICAuYXBwZW5kKFwiPGEgaHJlZj0nL1wiK3RyYW5zbGl0K1wiJz5cIituYW1lK1wiPC9hPlwiKTtcblxuICAgICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICAgICQoXCJib2R5XCIpLm5vdChcIi5zZWFyY2gtdG9wXCIpLmNsaWNrKGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgICAgICAgICAkKFwiLnNlYXJjaF9yZXN1bHQsIC5zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgICAgJChcIi5zZWFyY2hfcmVzdWx0LCAuc2VhcmNoX3Jlc3VsdF9pdGVtc1wiKS5oaWRlKCk7XG4gICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyhkYXRhKTtcbiAgICAgICAgICAgICB9LFxuICAgICAgIGVycm9yOiBmdW5jdGlvbiAoeGhyLCBhamF4T3B0aW9ucywgdGhyb3duRXJyb3IpIHtcbiAgICAgICAgfVxuICAgICAgfSk7XG4gICAgICB9IGVsc2Uge1xuICAgICAgICAkKFwiLnNlYXJjaF9yZXN1bHQsIC5zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLmhpZGUoKTtcbiAgICAgIH1cbiAgfSk7XG5cbiAgJChkb2N1bWVudCkub24oXCJrZXl1cFwiLCAnI3J1c19wbGF5ZXInLCBmdW5jdGlvbigpIHtcbiAgICBpZih0aGlzLnZhbHVlLmxlbmd0aCA+PSAxKXtcbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgIHR5cGU6ICdwb3N0JyxcbiAgICAgICAgICAgIHVybDogUm91dGluZy5nZW5lcmF0ZSgnbmV3c19zZWFyY2gnKSxcbiAgICAgICAgICAgIGRhdGE6IHtxdWVyeTogdGhpcy52YWx1ZSwgZm9ybV9wbGF5ZXI6ICd5J30sXG4gICAgICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24oZGF0YSl7XG4gICAgICAgICAgICAgICAgJChcIi5wbGF5ZXJfc2VhcmNoX3Jlc3VsdF9pdGVtc1wiKS5lbXB0eSgpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICBpZihkYXRhKXtcbiAgICAgICAgICAgICAgICAgICAgJChcIi5wbGF5ZXJfc2VhcmNoX3Jlc3VsdCwgLnBsYXllcl9zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLnNob3coKTtcbiAgICAgICAgICAgICAgICAgICAgJC5lYWNoKGRhdGEsIGZ1bmN0aW9uKGlkLCBuYW1lKXtcbiAgICAgICAgICAgICAgICAgICAgICAgICQoXCIucGxheWVyX3NlYXJjaF9yZXN1bHRfaXRlbXNcIilcbiAgICAgICAgICAgICAgICAgICAgICAgIC5hcHBlbmQoXCI8ZGl2IGNsYXNzPVxcXCJwbGF5ZXJfZm9ybV9zZWFyY2hcXFwiIGRhdGEtaWQ9J1wiK2lkK1wiJz5cIituYW1lK1wiPC9kaXY+XCIpO1xuXG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICAkKFwiYm9keVwiKS5ub3QoXCIuc2VhcmNoLXRvcFwiKS5jbGljayhmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgICAgICAgICQoXCIucGxheWVyX3NlYXJjaF9yZXN1bHQsIC5wbGF5ZXJfc2VhcmNoX3Jlc3VsdF9pdGVtc1wiKS5oaWRlKCk7XG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICAkKGRvY3VtZW50KS5vbignY2xpY2snLCAnLnBsYXllcl9mb3JtX3NlYXJjaCcsIGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgICAgICAgJChcIiNydXNfcGxheWVyXCIpLnZhbCgkKHRoaXMpLnRleHQoKSk7XG4gICAgICAgICAgICAgICAgICAgICAgJChcIiNydXNfcGxheWVyX2hpZGRlblwiKS52YWwoJCh0aGlzKS5kYXRhKCdpZCcpKTtcbiAgICAgICAgICAgICAgICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgICAgICAgICAgICAgdHlwZTogJ3Bvc3QnLFxuICAgICAgICAgICAgICAgICAgICAgICAgdXJsOiBSb3V0aW5nLmdlbmVyYXRlKCdzZXNzaW9uX3BsYXllcl9hZGQnLCB7J2lkJzogJCh0aGlzKS5kYXRhKCdpZCcpfSksXG4gICAgICAgICAgICAgICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihyZXNwb25zZSl7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2cocmVzcG9uc2UpO1xuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgICAgJChcIi5wbGF5ZXJfc2VhcmNoX3Jlc3VsdCwgLnBsYXllcl9zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coZGF0YSk7XG4gICAgICAgICAgIH0sXG4gICAgIGVycm9yOiBmdW5jdGlvbiAoeGhyLCBhamF4T3B0aW9ucywgdGhyb3duRXJyb3IpIHtcbiAgICAgIH1cbiAgICB9KTtcbiAgICB9IGVsc2Uge1xuICAgICAgJChcIi5wbGF5ZXJfc2VhcmNoX3Jlc3VsdCwgLnBsYXllcl9zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLmhpZGUoKTtcbiAgICB9XG59KTtcblxuJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy50b3VyX2pzJywgZnVuY3Rpb24oKXtcbiAgbGV0ICR0aGlzID0gJCh0aGlzKTtcbiAgbGV0IHRvdXIgPSAkdGhpcy5kYXRhKCd0b3VyJyk7XG4gIGxldCBjb3VudHJ5ID0gJHRoaXMuZGF0YSgnY291bnRyeScpO1xuICBsZXQgc2Vhc29uID0gJHRoaXMuZGF0YSgnc2Vhc29uJyk7XG4gICQuYWpheCh7XG4gICAgdHlwZTogJ3Bvc3QnLFxuICAgIHVybDogUm91dGluZy5nZW5lcmF0ZSgnY2hhbXBpb25zaGlwc190b3VyJywgeyd0b3VyJzp0b3VyLCAnc2Vhc29uJzogc2Vhc29uLCAnY291bnRyeSc6IGNvdW50cnl9KSxcbiAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKHJlc3BvbnNlKXtcbiAgICAgICQoXCIuY2hhbXBzaGlwLXRhYmxlIHRib2R5XCIpLmh0bWwocmVzcG9uc2UucmVzcG9uc2UpO1xuICAgICAgJChcIi50b3VyX3RleHQgc3BhblwiKS50ZXh0KHRvdXIpO1xuICAgICAgJChcIi50b3VyX2pzXCIpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcbiAgICAgICR0aGlzLmFkZENsYXNzKCdhY3RpdmUnKTtcbiAgICAgIGhpc3RvcnkucHVzaFN0YXRlKG51bGwsICcnLCBSb3V0aW5nLmdlbmVyYXRlKCdjaGFtcGlvbnNoaXBzJywgeyd0b3VyJzp0b3VyLCAnc2Vhc29uJzogc2Vhc29uLCAnY291bnRyeSc6IGNvdW50cnl9KSlcbiAgICB9LFxuICAgIGVycm9yOiBmdW5jdGlvbiAoeGhyLCBhamF4T3B0aW9ucywgdGhyb3duRXJyb3IpIHtcbiAgICAgIGNvbnNvbGUubG9nKHhoci5zdGF0dXMpO1xuICAgICAgY29uc29sZS5sb2codGhyb3duRXJyb3IpO1xuICAgIH1cbn0pO1xufSk7XG5cbiAgJChkb2N1bWVudCkub24oJ2NsaWNrJywgXCIjc2hpcHBsYXllcnNVcGRhdGVcIiwgZnVuY3Rpb24oKXtcbiAgICB2YXIgYXJHYW1lcyA9IFtdO1xuXHRcdHZhciBjaGFtcCA9ICQodGhpcykuZGF0YSgnY2hhbXAnKTtcbiAgICBsZXQgdW5kZXIgPSAkKHRoaXMpLmRhdGEoJ3VuZGVyJyk7XG4gICAgJChcIi5zaGlwcGxheWVyLWlucHV0XCIpLmVhY2goZnVuY3Rpb24oKXtcbiAgICAgIHZhciBnYW1lID0gJCh0aGlzKS52YWwoKTtcbiAgICAgIGlmKGdhbWUgIT0gMCl7XG4gICAgICAgIGFyR2FtZXMucHVzaChbXG4gICAgICAgICAgJCh0aGlzKS5kYXRhKCdpZCcpLFxuICAgICAgICAgICQodGhpcykuZGF0YSgncGxheWVyJyksXG4gICAgICAgICAgcGFyc2VJbnQoZ2FtZSlcbiAgICAgICAgXSk7XG4gICAgICB9XG4gICAgfSk7XG4gICAgJC5hamF4KHtcbiAgICAgICAgdHlwZTogJ3Bvc3QnLFxuICAgICAgICB1cmw6IFJvdXRpbmcuZ2VuZXJhdGUoJ3NoaXBwbGF5ZXJzX3VwZGF0ZScpLFxuICAgICAgICBkYXRhOiB7cXVlcnk6IGFyR2FtZXMsIGNoYW1wOiBjaGFtcCwgdW5kZXI6IHVuZGVyfSxcbiAgICAgICAgZGF0YVR5cGU6ICdqc29uJyxcbiAgICAgICAgc3VjY2VzczogZnVuY3Rpb24ocmVzcG9uc2Upe1xuICAgICAgICAgIHZhciBhcnIgPSBKU09OLnBhcnNlKHJlc3BvbnNlKTtcbiAgICAgICAgICBhcnIuZm9yRWFjaChmdW5jdGlvbihpdGVtLCBpLCBhcnIpIHtcbiAgICAgICAgICAgICQoXCJbZGF0YS1pZD1cIitpdGVtWzBdK1wiXVtkYXRhLXBhcmFtPSdnYW1lJ11cIikudGV4dChpdGVtWzFdKTtcbiAgICAgICAgICB9KTtcbiAgICAgICAgfSxcbiAgICAgICAgZXJyb3I6IGZ1bmN0aW9uICh4aHIsIGFqYXhPcHRpb25zLCB0aHJvd25FcnJvcikge1xuICAgICAgICAgIGNvbnNvbGUubG9nKHhoci5zdGF0dXMpO1xuICAgICAgICAgIGNvbnNvbGUubG9nKHRocm93bkVycm9yKTtcbiAgICAgICAgfVxuICAgIH0pO1xuICB9KTtcblxuICAkKGRvY3VtZW50KS5vbignY2xpY2snLCBcIiNuaGxwbGF5ZXJzVXBkYXRlXCIsIGZ1bmN0aW9uKCl7XG4gICAgbGV0IGFyR29hbHNSZWcgPSBbXTtcbiAgICAkKFwiLm5obHBsYXllci1pbnB1dC5nb2FsUmVnXCIpLmVhY2goZnVuY3Rpb24oKXtcbiAgICAgIGxldCBnb2FsUmVnID0gJCh0aGlzKS52YWwoKTtcbiAgICAgIGlmKGdvYWxSZWcgIT0gMCl7XG4gICAgICAgIGFyR29hbHNSZWcucHVzaChbXG4gICAgICAgICAgJCh0aGlzKS5kYXRhKCdpZCcpLFxuICAgICAgICAgICQodGhpcykuZGF0YSgncGxheWVyJyksXG4gICAgICAgICAgcGFyc2VJbnQoZ29hbFJlZylcbiAgICAgICAgXSk7XG4gICAgICB9XG4gICAgfSk7XG4gICAgbGV0IGFyQXNzaXN0UmVnID0gW107XG4gICAgJChcIi5uaGxwbGF5ZXItaW5wdXQuYXNzaXN0UmVnXCIpLmVhY2goZnVuY3Rpb24oKXtcbiAgICAgIGxldCBhc3Npc3RSZWcgPSAkKHRoaXMpLnZhbCgpO1xuICAgICAgaWYoYXNzaXN0UmVnICE9IDApe1xuICAgICAgICBhckFzc2lzdFJlZy5wdXNoKFtcbiAgICAgICAgICAkKHRoaXMpLmRhdGEoJ2lkJyksXG4gICAgICAgICAgJCh0aGlzKS5kYXRhKCdwbGF5ZXInKSxcbiAgICAgICAgICBwYXJzZUludChhc3Npc3RSZWcpXG4gICAgICAgIF0pO1xuICAgICAgfVxuICAgIH0pO1xuICAgIGxldCBhckdvYWxzUG8gPSBbXTtcbiAgICAkKFwiLm5obHBsYXllci1pbnB1dC5nb2FsUG9cIikuZWFjaChmdW5jdGlvbigpe1xuICAgICAgbGV0IGdvYWxQbyA9ICQodGhpcykudmFsKCk7XG4gICAgICBpZihnb2FsUG8gIT0gMCl7XG4gICAgICAgIGFyR29hbHNQby5wdXNoKFtcbiAgICAgICAgICAkKHRoaXMpLmRhdGEoJ2lkJyksXG4gICAgICAgICAgJCh0aGlzKS5kYXRhKCdwbGF5ZXInKSxcbiAgICAgICAgICBwYXJzZUludChnb2FsUG8pXG4gICAgICAgIF0pO1xuICAgICAgfVxuICAgIH0pO1xuICAgIGxldCBhckFzc2lzdFBvID0gW107XG4gICAgJChcIi5uaGxwbGF5ZXItaW5wdXQuYXNzaXN0UG9cIikuZWFjaChmdW5jdGlvbigpe1xuICAgICAgdmFyIGdhbWUgPSAkKHRoaXMpLnZhbCgpO1xuICAgICAgaWYoZ2FtZSAhPSAwKXtcbiAgICAgICAgYXJBc3Npc3RQby5wdXNoKFtcbiAgICAgICAgICAkKHRoaXMpLmRhdGEoJ2lkJyksXG4gICAgICAgICAgJCh0aGlzKS5kYXRhKCdwbGF5ZXInKSxcbiAgICAgICAgICBwYXJzZUludChnYW1lKVxuICAgICAgICBdKTtcbiAgICAgIH1cbiAgICB9KTtcbiAgICBsZXQgYXJHYW1lUmVnID0gW107XG4gICAgJChcIi5uaGxwbGF5ZXItaW5wdXQuZ2FtZVJlZ1wiKS5lYWNoKGZ1bmN0aW9uKCl7XG4gICAgICBsZXQgZ2FtZVJlZyA9ICQodGhpcykudmFsKCk7XG4gICAgICBpZihnYW1lUmVnICE9IDApe1xuICAgICAgICBhckdhbWVSZWcucHVzaChbXG4gICAgICAgICAgJCh0aGlzKS5kYXRhKCdpZCcpLFxuICAgICAgICAgICQodGhpcykuZGF0YSgncGxheWVyJyksXG4gICAgICAgICAgcGFyc2VJbnQoZ2FtZVJlZylcbiAgICAgICAgXSk7XG4gICAgICB9XG4gICAgfSk7XG4gICAgbGV0IGFyTWlzc2VkUmVnID0gW107XG4gICAgJChcIi5uaGxwbGF5ZXItaW5wdXQubWlzc2VkUmVnXCIpLmVhY2goZnVuY3Rpb24oKXtcbiAgICAgIGxldCBtaXNzZWRSZWcgPSAkKHRoaXMpLnZhbCgpO1xuICAgICAgaWYobWlzc2VkUmVnICE9IDApe1xuICAgICAgICBhck1pc3NlZFJlZy5wdXNoKFtcbiAgICAgICAgICAkKHRoaXMpLmRhdGEoJ2lkJyksXG4gICAgICAgICAgJCh0aGlzKS5kYXRhKCdwbGF5ZXInKSxcbiAgICAgICAgICBwYXJzZUludChtaXNzZWRSZWcpXG4gICAgICAgIF0pO1xuICAgICAgfVxuICAgIH0pO1xuICAgIGxldCBhclplcm9SZWcgPSBbXTtcbiAgICAkKFwiLm5obHBsYXllci1pbnB1dC56ZXJvUmVnXCIpLmVhY2goZnVuY3Rpb24oKXtcbiAgICAgIGxldCB6ZXJvUmVnID0gJCh0aGlzKS52YWwoKTtcbiAgICAgIGlmKHplcm9SZWcgIT0gMCl7XG4gICAgICAgIGFyWmVyb1JlZy5wdXNoKFtcbiAgICAgICAgICAkKHRoaXMpLmRhdGEoJ2lkJyksXG4gICAgICAgICAgJCh0aGlzKS5kYXRhKCdwbGF5ZXInKSxcbiAgICAgICAgICBwYXJzZUludCh6ZXJvUmVnKVxuICAgICAgICBdKTtcbiAgICAgIH1cbiAgICB9KTtcbiAgICBsZXQgYXJHYW1lUG8gPSBbXTtcbiAgICAkKFwiLm5obHBsYXllci1pbnB1dC5nYW1lUG9cIikuZWFjaChmdW5jdGlvbigpe1xuICAgICAgbGV0IGdhbWVQbyA9ICQodGhpcykudmFsKCk7XG4gICAgICBpZihnYW1lUG8gIT0gMCl7XG4gICAgICAgIGFyR2FtZVBvLnB1c2goW1xuICAgICAgICAgICQodGhpcykuZGF0YSgnaWQnKSxcbiAgICAgICAgICAkKHRoaXMpLmRhdGEoJ3BsYXllcicpLFxuICAgICAgICAgIHBhcnNlSW50KGdhbWVQbylcbiAgICAgICAgXSk7XG4gICAgICB9XG4gICAgfSk7XG4gICAgbGV0IGFyTWlzc2VkUG8gPSBbXTtcbiAgICAkKFwiLm5obHBsYXllci1pbnB1dC5taXNzZWRQb1wiKS5lYWNoKGZ1bmN0aW9uKCl7XG4gICAgICBsZXQgbWlzc2VkUG8gPSAkKHRoaXMpLnZhbCgpO1xuICAgICAgaWYobWlzc2VkUG8gIT0gMCl7XG4gICAgICAgIGFyTWlzc2VkUG8ucHVzaChbXG4gICAgICAgICAgJCh0aGlzKS5kYXRhKCdpZCcpLFxuICAgICAgICAgICQodGhpcykuZGF0YSgncGxheWVyJyksXG4gICAgICAgICAgcGFyc2VJbnQobWlzc2VkUG8pXG4gICAgICAgIF0pO1xuICAgICAgfVxuICAgIH0pO1xuICAgIGxldCBhclplcm9QbyA9IFtdO1xuICAgICQoXCIubmhscGxheWVyLWlucHV0Lnplcm9Qb1wiKS5lYWNoKGZ1bmN0aW9uKCl7XG4gICAgICBsZXQgemVyb1BvID0gJCh0aGlzKS52YWwoKTtcbiAgICAgIGlmKHplcm9QbyAhPSAwKXtcbiAgICAgICAgYXJaZXJvUG8ucHVzaChbXG4gICAgICAgICAgJCh0aGlzKS5kYXRhKCdpZCcpLFxuICAgICAgICAgICQodGhpcykuZGF0YSgncGxheWVyJyksXG4gICAgICAgICAgcGFyc2VJbnQoemVyb1BvKVxuICAgICAgICBdKTtcbiAgICAgIH1cbiAgICB9KTtcbiAgICAkLmFqYXgoe1xuICAgICAgICB0eXBlOiAncG9zdCcsXG4gICAgICAgIHVybDogUm91dGluZy5nZW5lcmF0ZSgnbmhscGxheWVyc191cGRhdGUnKSxcbiAgICAgICAgZGF0YToge2FyR29hbHNSZWc6IGFyR29hbHNSZWcsIGFyQXNzaXN0UmVnOiBhckFzc2lzdFJlZywgYXJHb2Fsc1BvOiBhckdvYWxzUG8sIGFyQXNzaXN0UG86IGFyQXNzaXN0UG8sIGFyR2FtZVJlZzogYXJHYW1lUmVnLCBcbiAgICAgICAgICBhck1pc3NlZFJlZzogYXJNaXNzZWRSZWcsIGFyWmVyb1JlZzogYXJaZXJvUmVnLCBhckdhbWVQbzogYXJHYW1lUG8sIGFyTWlzc2VkUG86IGFyTWlzc2VkUG8sIGFyWmVyb1BvOiBhclplcm9Qb30sXG4gICAgICAgIGRhdGFUeXBlOiAnanNvbicsXG4gICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKHJlc3BvbnNlKXtcbiAgICAgICAgICB2YXIgYXJyID0gSlNPTi5wYXJzZShyZXNwb25zZSk7XG4gICAgICAgICAgJChcIi5uaGxwbGF5ZXItaW5wdXRcIikudmFsKDApO1xuICAgICAgICAgIC8qYXJyLmZvckVhY2goZnVuY3Rpb24oaXRlbSwgaSwgYXJyKSB7XG4gICAgICAgICAgICAkKFwiW2RhdGEtaWQ9XCIraXRlbVswXStcIl1bZGF0YS1wYXJhbT0nZ2FtZSddXCIpLnRleHQoaXRlbVsxXSk7XG4gICAgICAgICAgfSk7Ki9cbiAgICAgICAgfSxcbiAgICAgICAgZXJyb3I6IGZ1bmN0aW9uICh4aHIsIGFqYXhPcHRpb25zLCB0aHJvd25FcnJvcikge1xuICAgICAgICAgIGNvbnNvbGUubG9nKHhoci5zdGF0dXMpO1xuICAgICAgICAgIGNvbnNvbGUubG9nKHRocm93bkVycm9yKTtcbiAgICAgICAgfVxuICAgIH0pO1xuICB9KTtcblxuICAkKGRvY3VtZW50KS5vbignY2xpY2snLCBcIi5jaGFuZ2VHYW1lR29hbFBsYXllclwiLCBmdW5jdGlvbigpe1xuICAgIHZhciBjaGFuZ2UgPSAkKHRoaXMpLmRhdGEoJ2NoYW5nZScpO1xuICAgIHZhciBpZCA9ICQodGhpcykuZGF0YSgnaWQnKTtcbiAgICB2YXIgc2Vhc29uID0gJCh0aGlzKS5kYXRhKCdzZWFzb24nKTtcbiAgICB2YXIgdGVhbSA9ICQodGhpcykuZGF0YSgndGVhbScpO1xuICAgIHZhciByb3V0ZSA9ICQodGhpcykuZGF0YSgncGF0aCcpO1xuXHRcdHZhciB0dXJuaXIgPSAkKHRoaXMpLmRhdGEoJ3R1cm5pcicpO1xuXHRcdHZhciAkdGhpcyA9ICQodGhpcyk7XG5cdFx0dmFyIHBhcmFtcyA9IHsnaWQnOiBpZCwgJ3NlYXNvbic6IHNlYXNvbiwgJ2NoYW5nZSc6IGNoYW5nZSwgJ3R1cm5pcic6IHR1cm5pcn07XG5cdFx0JChcIi5sb2FkaW5nW2RhdGEtaWQ9XCIraWQrXCJdXCIpLmNzcygnZGlzcGxheScsICdpbmxpbmUtYmxvY2snKTtcblx0XHRpZih0dXJuaXIgIT0gdW5kZWZpbmVkKXtcblx0XHRcdHBhcmFtc1sndHVybmlyJ10gPSB0dXJuaXI7XG5cdFx0fVxuXHRcdGlmKHJvdXRlICE9ICdwbGF5ZXJfZWRpdFNiJyl7XG5cdFx0XHRwYXJhbXNbJ3RlYW0nXSA9IHRlYW07XG5cdFx0fVxuICAgICQuYWpheCh7XG4gICAgICAgIHR5cGU6ICdwb3N0JyxcbiAgICAgICAgdXJsOiBSb3V0aW5nLmdlbmVyYXRlKHJvdXRlLCBwYXJhbXMpLFxuICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhKXtcbiAgICAgICAgICAgICQoXCIuc3Bpc2tpLnNlbGVjdGVkXCIpLnJlbW92ZUNsYXNzKCdzZWxlY3RlZCcpO1xuICAgICAgICAgICAgJChcIi5zcGlza2lbZGF0YS1pZD1cIitpZCtcIl1cIikuYWRkQ2xhc3MoJ3NlbGVjdGVkJyk7XG5cdFx0XHRcdFx0XHRpZihyb3V0ZSA9PSAncGxheWVyYWRtaW5fZWRpdENoYW1wVG90YWwnKXtcblx0XHRcdFx0XHRcdFx0JChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSd0b3RhbGdhbWUnXVwiKS50ZXh0KGRhdGFbJ2dhbWUnXSk7XG4gICAgICAgICAgICBcdCQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0ndG90YWxnb2FsJ11cIikudGV4dChkYXRhWydnb2FsJ10pO1xuXHRcdFx0XHRcdFx0fSBlbHNlIGlmKHJvdXRlID09ICdwbGF5ZXJhZG1pbl9lZGl0TmF0aW9uQ3VwJyl7XG5cdCAgICAgICAgICAgIFx0JChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSdjdXAnXVwiKS50ZXh0KGRhdGFbJ2dvYWwnXSk7XG5cdFx0XHRcdFx0XHR9IGVsc2UgaWYocm91dGUgPT0gJ3BsYXllcmFkbWluX2VkaXROYXRpb25TdXBlcmN1cCcpe1xuXHRcdFx0XHRcdFx0XHRcdCQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nc3VwZXJjdXAnXVwiKS50ZXh0KGRhdGFbJ2dvYWwnXSk7XG5cdFx0XHRcdFx0XHR9IGVsc2UgaWYocm91dGUgPT0gJ3BsYXllcmFkbWluX2VkaXROYXRpb25FdXJvY3VwJyl7XG5cdFx0XHRcdFx0XHRcdFx0JChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSdldXJvY3VwJ11cIikudGV4dChkYXRhWydnb2FsJ10pO1xuXHRcdFx0XHRcdFx0fSBlbHNlIGlmKHJvdXRlID09ICdwbGF5ZXJhZG1pbl9lZGl0TmF0aW9uU2Jvcm5pZScpe1xuXHRcdFx0XHRcdFx0XHRcdCQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nc2Jvcm5pZSddXCIpLnRleHQoZGF0YVsnZ29hbCddKTtcblx0XHRcdFx0XHRcdH0gZWxzZSB7XG4gICAgICAgICAgICBcdCQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nZ2FtZSddXCIpLnRleHQoZGF0YVsnZ2FtZSddKTtcbiAgICAgICAgICAgIFx0JChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSdnb2FsJ11cIikudGV4dChkYXRhWydnb2FsJ10pO1xuICAgICAgICAgICAgICAkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J2dhbWVQbyddXCIpLnRleHQoZGF0YVsnZ2FtZVBvJ10pO1xuICAgICAgICAgICAgXHQkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J2dvYWxQbyddXCIpLnRleHQoZGF0YVsnZ29hbFBvJ10pO1xuXHRcdFx0XHRcdFx0fVxuICAgICAgICAgICAgJChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSdhc3Npc3QnXVwiKS50ZXh0KGRhdGFbJ2Fzc2lzdCddKTtcbiAgICAgICAgICAgICQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nc2NvcmUnXVwiKS50ZXh0KGRhdGFbJ3Njb3JlJ10pO1xuICAgICAgICAgICAgJChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSdtaXNzZWQnXVwiKS50ZXh0KGRhdGFbJ21pc3NlZCddKTtcbiAgICAgICAgICAgICQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nemVybyddXCIpLnRleHQoZGF0YVsnemVybyddKTtcbiAgICAgICAgICAgICQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nYXNzaXN0UG8nXVwiKS50ZXh0KGRhdGFbJ2Fzc2lzdFBvJ10pO1xuICAgICAgICAgICAgJChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSdzY29yZVBvJ11cIikudGV4dChkYXRhWydzY29yZVBvJ10pO1xuICAgICAgICAgICAgJChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSdtaXNzZWRQbyddXCIpLnRleHQoZGF0YVsnbWlzc2VkUG8nXSk7XG4gICAgICAgICAgICAkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J3plcm9QbyddXCIpLnRleHQoZGF0YVsnemVyb1BvJ10pO1xuXHRcdFx0XHRcdFx0JChcIi5sb2FkaW5nW2RhdGEtaWQ9XCIraWQrXCJdXCIpLmhpZGUoKTtcblx0XHRcdFx0XHRcdCR0aGlzLmFkZENsYXNzKCdjaGFuZ2VkLXBsYXllcicpO1xuICAgICAgICB9LFxuICAgICAgICBlcnJvcjogZnVuY3Rpb24gKHhociwgYWpheE9wdGlvbnMsIHRocm93bkVycm9yKSB7XG4gICAgICAgICAgY29uc29sZS5sb2coeGhyLnN0YXR1cyk7XG4gICAgICAgICAgY29uc29sZS5sb2codGhyb3duRXJyb3IpO1xuICAgICAgICB9XG4gICAgICB9KTtcbiAgfSk7XG5cbiAgJChcIi5sZXR0ZXJzLWxpc3QgbGlcIikuY2xpY2soZnVuY3Rpb24oKXtcbiAgICB2YXIgbGV0dGVyID0gJCh0aGlzKS50ZXh0KCk7XG4gICAgJC5hamF4KHtcbiAgICAgICAgdHlwZTogJ3Bvc3QnLFxuICAgICAgICB1cmw6IFJvdXRpbmcuZ2VuZXJhdGUoJ3RlYW1fZ2V0X2J5X2xldHRlcicsIHsnbGV0dGVyJzpsZXR0ZXJ9KSxcbiAgICAgICAgZGF0YVR5cGU6ICdqc29uJyxcbiAgICAgICAgc3VjY2VzczogZnVuY3Rpb24oZGF0YSl7XG4gICAgICAgICAgICB2YXIgbmV3SHRtbCA9IFwiXCI7XG4gICAgICAgICAgICBmb3IodmFyIGk9MCwgY250PWRhdGEudGVhbXMubGVuZ3RoOyBpIDwgY250OyBpKyspe1xuICAgICAgICAgICAgICB2YXIgZGV0YWlsVXJsID0gUm91dGluZy5nZW5lcmF0ZSgndGVhbV9zaG93Jywge1xuICAgICAgICAgICAgICAgICdjb2RlJzogZGF0YS50ZWFtc1tpXVsxXX0pO1xuXG4gICAgICAgICAgICAgIG5ld0h0bWwgKz0gXCI8bGk+PGEgaHJlZj0nXCIrIGRldGFpbFVybCArXCInIGNsYXNzPSdzcGlza2knPlwiXG4gICAgICAgICAgICAgICAgKyBkYXRhLnRlYW1zW2ldWzBdICsgXCI8L2E+PC9saT5cIjtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgICQoXCIuY2x1YnMtbGlzdFwiKS5odG1sKG5ld0h0bWwpO1xuICAgICAgICB9LFxuICAgICAgICBlcnJvcjogZnVuY3Rpb24gKHhociwgYWpheE9wdGlvbnMsIHRocm93bkVycm9yKSB7XG4gICAgICAgICAgY29uc29sZS5sb2coeGhyLnN0YXR1cyk7XG4gICAgICAgICAgY29uc29sZS5sb2codGhyb3duRXJyb3IpO1xuICAgICAgICB9XG4gICAgICB9KTtcbiAgfSk7XG5cbiAgJChcIiNzZWxlY3RQYWdlTWF0Y2hlc1wiKS5jaGFuZ2UoZnVuY3Rpb24oKXtcbiAgICB2YXIgbWF4TWF0Y2hlcyA9ICQodGhpcykudmFsKCksXG4gICAgICBwYXJhbXMgPSBwYXJzZVVybFF1ZXJ5KCksXG4gICAgICBuZXdBcnIgPSBbXTtcblxuICAgICAgcGFyYW1zWydtYXgnXSA9IG1heE1hdGNoZXM7XG4gICAgICBmb3IgKGtleSBpbiBwYXJhbXMpe1xuICAgICAgICBuZXdBcnIucHVzaChrZXkgKyAnPScgKyBwYXJhbXNba2V5XSk7XG4gICAgICB9XG4gICAgICB3aW5kb3cubG9jYXRpb24uc2VhcmNoID0gbmV3QXJyLmpvaW4oJyYnKTtcbiAgfSk7XG5cbiAgJChkb2N1bWVudCkub24oXCJjbGlja1wiLCBcIi5uaGwtbWF0Y2hlcyAubmhsLWRhdGVzIHNwYW5bZGF0YS1kYXRlXVwiLCBmdW5jdGlvbigpe1xuICAgIHZhciBkYXRhID0gJCh0aGlzKS5kYXRhKCdkYXRlJyk7XG4gICAgJChcIi5uaGwtbWF0Y2hlcy5jaGFtcHNcIikubG9hZChcIi9uaGwvZGF0ZS9cIiArIGRhdGEgKyBcIiAubmhsLW1hdGNoZXMuY2hhbXBzXCIpO1xuICB9KTtcblxuICAkKGRvY3VtZW50KS5vbihcImNsaWNrXCIsIFwiLmNoYW1wLXRvdXJzIC5uaGwtZGF0ZXMgc3BhbltkYXRhLWRhdGVdXCIsIGZ1bmN0aW9uKCl7XG4gICAgdmFyIGRhdGEgPSAkKHRoaXMpLmRhdGEoJ2RhdGUnKTtcbiAgICAkKFwiLmNoYW1wLXRvdXJzXCIpLmxvYWQoXCIvY2hhbXBpb25zaGlwcy9kYXRlL3VuZGVybGVhZ3VlLXVzYS9cIiArIGRhdGEgKyBcIiAuY2hhbXAtdG91cnNcIik7XG4gIH0pO1xuXG4gICQoXCIjZGF0ZXBpY2tlclwiKS5kYXRlcGlja2VyKCk7XG5cblxufSk7XG5cbmZ1bmN0aW9uIHNsaWNlTWFpbk1lbnUocmVzaXplKXtcblxuXHR2YXIgJG1haW5NZW51ID0gJChcIiNzdWJNZW51XCIpO1xuXHRpZihyZXNpemUgPT0gdHJ1ZSl7XG5cdFx0JG1haW5NZW51LmZpbmQoXCIucmVtb3ZlZFwiKS5lYWNoKGZ1bmN0aW9uKGksIG5leHRFbGVtZW50KXtcblx0XHRcdHZhciAkbmV4dEVsZW1lbnQgPSAkKG5leHRFbGVtZW50KTtcblx0XHRcdCRtYWluTWVudS5hcHBlbmQoXG5cdFx0XHRcdCRuZXh0RWxlbWVudC5yZW1vdmVDbGFzcyhcInJlbW92ZWRcIilcblx0XHRcdClcblx0XHR9KTtcblx0XHQkbWFpbk1lbnUuZmluZChcIi5yZW1vdmVkSXRlbXNMaW5rXCIpLnJlbW92ZSgpO1xuXHR9XG5cblx0dmFyICRtYWluTWVudUl0ZW1zID0gJG1haW5NZW51LmNoaWxkcmVuKFwibGlcIik7XG5cdHZhciB2aXNpYmxlTWVudVdpZHRoID0gJG1haW5NZW51LndpZHRoKCkgLSAxMDA7XG5cdHZhciB3aW5kb3dXaWR0aCA9ICQod2luZG93KS53aWR0aCgpIC0gMTIwO1xuXHR2YXIgdG90YWxTdW1NZW51V2lkdGggPSAwO1xuXG5cdFx0JG1haW5NZW51SXRlbXMuZWFjaChmdW5jdGlvbihpLCBuZXh0RWxlbWVudCl7XG5cdFx0XHR2YXIgJG5leHRFbGVtZW50ID0gJChuZXh0RWxlbWVudCk7XG5cdFx0XHR0b3RhbFN1bU1lbnVXaWR0aCArPSAkbmV4dEVsZW1lbnQub3V0ZXJXaWR0aCh0cnVlKTtcblxuXHRcdFx0aWYodG90YWxTdW1NZW51V2lkdGggPiB3aW5kb3dXaWR0aCl7XG5cdFx0XHRcdCRuZXh0RWxlbWVudC5hZGRDbGFzcyhcInJlbW92ZWRcIik7XG5cdFx0XHR9XG5cdFx0fSk7XG5cdFx0dmFyICRyZW1vdmVkSXRlbXMgPSAkbWFpbk1lbnUuZmluZChcIi5yZW1vdmVkXCIpO1xuXHRcdGlmKCRyZW1vdmVkSXRlbXMubGVuZ3RoID4gMCl7XG5cdFx0XHR2YXIgJHJlbW92ZWRJdGVtc0xpc3QgPSAkKFwiPHVsLz5cIikuYWRkQ2xhc3MoXCJyZW1vdmVkSXRlbXNMaXN0XCIpO1xuXHRcdFx0dmFyICRyZW1vdmVkSXRlbXNMaW5rID0gJChcIjxsaS8+XCIpLmFkZENsYXNzKFwicmVtb3ZlZEl0ZW1zTGlua1wiKS5hcHBlbmQoJChgPGJ1dHRvbiB0eXBlPVwiYnV0dG9uXCIgY2xhc3M9XCJuYXZiYXItdG9nZ2xlLXN1YlwiPlxuXHRcdFx0XHRcdDxzcGFuIGNsYXNzPVwiaWNvbi1iYXJcIj48L3NwYW4+XG5cdFx0XHRcdFx0PHNwYW4gY2xhc3M9XCJpY29uLWJhclwiPjwvc3Bhbj5cblx0XHRcdFx0XHQ8c3BhbiBjbGFzcz1cImljb24tYmFyXCI+PC9zcGFuPlxuXHRcdFx0PC9idXR0b24+YCkpO1xuXHRcdFx0JHJlbW92ZWRJdGVtcy5lYWNoKGZ1bmN0aW9uKGksIG5leHRFbGVtZW50KXtcblx0XHRcdFx0dmFyICRuZXh0RWxlbWVudCA9ICQobmV4dEVsZW1lbnQpO1xuXHRcdFx0XHQkcmVtb3ZlZEl0ZW1zTGlzdC5hcHBlbmQoXG5cdFx0XHRcdFx0JG5leHRFbGVtZW50XG5cdFx0XHRcdClcblx0XHRcdH0pO1xuXHRcdFx0JG1haW5NZW51LmFwcGVuZCgkcmVtb3ZlZEl0ZW1zTGluay5hcHBlbmQoJHJlbW92ZWRJdGVtc0xpc3QpKTtcblx0XHRcdC8qJHJlbW92ZWRJdGVtc0xpc3QuY3NzKHtcblx0XHRcdFx0bGVmdDogJHJlbW92ZWRJdGVtc0xpbmsub2Zmc2V0KCkubGVmdCArIFwicHhcIlxuXHRcdFx0fSk7Ki9cblx0XHRcdCQoXCIubmF2YmFyLXRvZ2dsZS1zdWJcIikubW91c2VvdmVyKGZ1bmN0aW9uKCl7XG5cdFx0XHRcdCQoXCIucmVtb3ZlZEl0ZW1zTGlzdFwiKS5zaG93KCk7XG5cdFx0XHR9KTtcblx0XHR9XG5cblx0XHR2YXIgX19zZWN0aW9uTWVudUFjdGl2ZSA9IFwiYWN0aXZlRHJvcFwiO1xuXHRcdHZhciBfX3NlY3Rpb25NZW51TWVudUlEID0gXCJtZW51Q2F0YWxvZ1NlY3Rpb25cIjtcblx0XHR2YXIgX19zZWN0aW9uTWVudU9wZW5lciA9IFwibWVudVNlY3Rpb25cIjtcblx0XHR2YXIgX19zZWN0aW9uTWVudURyb3BcdCA9IFwiZHJvcFwiO1xuXHRcdHZhciBfX2FjdGl2ZSA9IFwiYWN0aXZlRHJvcFwiO1xuXHRcdHZhciBfX21lbnVJRCA9IFwibWFpbk1lbnVcIjtcblx0XHR2YXIgX19vcGVuZXIgPSBcImVDaGlsZFwiO1xuXHRcdHZhciBfX2Ryb3BcdCA9IFwiZHJvcFwiO1xuXG5cdFx0dmFyICRfc2VsZiA9ICQoXCIjXCIgKyBfX21lbnVJRCk7XG5cdFx0dmFyICRfZUNoaWxkID0gJF9zZWxmLmNoaWxkcmVuKFwiLlwiICsgX19vcGVuZXIpO1xuXG5cdFx0dmFyIG9wZW5DaGlsZCA9IGZ1bmN0aW9uKCl7XG5cblx0XHRcdHZhciAkX3RoaXMgPSAkKHRoaXMpO1xuXHRcdFx0aWYoISRfdGhpcy5oYXNDbGFzcyhcInJlbW92ZWRcIikpe1xuXG5cdFx0XHRcdF9fbWVudUZpcnN0T3BlblRpbWVvdXRJRCA9IHNldFRpbWVvdXQoZnVuY3Rpb24oKXtcblx0XHRcdFx0XHRpZigkX3RoaXMuaXMoXCI6aG92ZXJcIikpe1xuXHRcdFx0XHRcdFx0Y2xlYXJUaW1lb3V0KF9fbWVudUZpcnN0T3BlblRpbWVvdXRJRCk7XG5cdFx0XHRcdFx0XHQkX3NlY3Rpb25NZW51RUNoaWxkLnJlbW92ZUNsYXNzKF9fc2VjdGlvbk1lbnVBY3RpdmUpLmZpbmQoXCIuXCIgKyBfX3NlY3Rpb25NZW51RHJvcCkuaGlkZSgpO1xuXHRcdFx0XHRcdFx0JF9lQ2hpbGQucmVtb3ZlQ2xhc3MoX19hY3RpdmUpLmZpbmQoXCIuXCIgKyBfX2Ryb3ApLmhpZGUoKTtcblx0XHRcdFx0XHRcdCRfdGhpcy5hZGRDbGFzcyhfX2FjdGl2ZSkuZmluZChcIi5cIiArIF9fZHJvcCkuY3NzKFwiZGlzcGxheVwiLCBcInRhYmxlXCIpO1xuXHRcdFx0XHRcdFx0cmV0dXJuIGNsZWFyVGltZW91dChfX21lbnVUaW1lb3V0SUQpO1xuXHRcdFx0XHRcdH1cblx0XHRcdFx0fSwgMzAwKTtcblxuXHRcdH1cbiAgICBcblxuXHR9XG5cblx0dmFyIGNsb3NlQ2hpbGQgPSBmdW5jdGlvbigpe1xuXHRcdHZhciAkX2NhcHR1cmVUaGlzID0gJCh0aGlzKTtcblx0XHRfX21lbnVUaW1lb3V0SUQgPSBzZXRUaW1lb3V0KGZ1bmN0aW9uKCl7XG5cdFx0XHQkX2NhcHR1cmVUaGlzLnJlbW92ZUNsYXNzKF9fYWN0aXZlKS5maW5kKFwiLlwiICsgX19kcm9wKS5oaWRlKCk7XG5cdFx0fSwgNTAwKTtcblx0fVxuXG5cdCRfZUNoaWxkLmhvdmVyKG9wZW5DaGlsZCwgY2xvc2VDaGlsZCk7XG4gICRtYWluTWVudS5yZW1vdmVDbGFzcygnc3RhcnRfbWVudScpO1xufVxuXG4kKHdpbmRvdykub24oXCJyZXNpemVcIiwgZnVuY3Rpb24oKXtcblx0c2xpY2VNYWluTWVudSh0cnVlKTtcbn0pO1xuXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbihldmVudCl7XG5cdHNsaWNlTWFpbk1lbnUoZmFsc2UpO1xufSk7XG5cblxuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignRE9NQ29udGVudExvYWRlZCcsICgpID0+IHtcblxuICAgIGNvbnN0IGdldFNvcnQgPSAoeyB0YXJnZXQgfSkgPT4ge1xuICAgICAgICBjb25zdCBvcmRlciA9ICh0YXJnZXQuZGF0YXNldC5vcmRlciA9IC0odGFyZ2V0LmRhdGFzZXQub3JkZXIgfHwgLTEpKTtcbiAgICAgICAgY29uc3QgaW5kZXggPSBbLi4udGFyZ2V0LnBhcmVudE5vZGUuY2VsbHNdLmluZGV4T2YodGFyZ2V0KTtcbiAgICAgICAgY29uc3QgY29sbGF0b3IgPSBuZXcgSW50bC5Db2xsYXRvcihbJ2VuJywgJ3J1J10sIHsgbnVtZXJpYzogdHJ1ZSB9KTtcbiAgICAgICAgY29uc3QgY29tcGFyYXRvciA9IChpbmRleCwgb3JkZXIpID0+IChhLCBiKSA9PiBvcmRlciAqIGNvbGxhdG9yLmNvbXBhcmUoXG4gICAgICAgICAgICBiLmNoaWxkcmVuW2luZGV4XS5pbm5lclRleHQsXG4gICAgICAgICAgICBhLmNoaWxkcmVuW2luZGV4XS5pbm5lclRleHRcbiAgICAgICAgKTtcblxuICAgICAgICBmb3IoY29uc3QgdEJvZHkgb2YgdGFyZ2V0LmNsb3Nlc3QoJ3RhYmxlJykudEJvZGllcylcbiAgICAgICAgICAgIHRCb2R5LmFwcGVuZCguLi5bLi4udEJvZHkucm93c10uc29ydChjb21wYXJhdG9yKGluZGV4LCBvcmRlcikpKTtcblxuICAgICAgICBmb3IoY29uc3QgY2VsbCBvZiB0YXJnZXQucGFyZW50Tm9kZS5jZWxscylcbiAgICAgICAgICAgIGNlbGwuY2xhc3NMaXN0LnRvZ2dsZSgnc29ydGVkJywgY2VsbCA9PT0gdGFyZ2V0KTtcbiAgICB9O1xuXHRcdGNvbnN0IHRoZWFkID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLnRhYmxlX3NvcnQgdGhlYWQgdHInKVsxXTtcblx0XHQvL2NvbnNvbGUubG9nKHRoZWFkKTtcblx0XHRpZih0aGVhZCAhPSB1bmRlZmluZWQpXG4gICAgXHR0aGVhZC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IGdldFNvcnQoZXZlbnQpKTtcblxufSk7XG5cbmZ1bmN0aW9uIHNldENvb2tpZShuYW1lLCB2YWx1ZSwgb3B0aW9ucyA9IHt9KSB7XG5cbiAgICBvcHRpb25zID0ge1xuICAgICAgcGF0aDogJy8nLFxuICAgICAgLi4ub3B0aW9uc1xuICAgIH07XG4gIFxuICAgIGlmIChvcHRpb25zLmV4cGlyZXMgaW5zdGFuY2VvZiBEYXRlKSB7XG4gICAgICBvcHRpb25zLmV4cGlyZXMgPSBvcHRpb25zLmV4cGlyZXMudG9VVENTdHJpbmcoKTtcbiAgICB9XG4gIFxuICAgIGxldCB1cGRhdGVkQ29va2llID0gZW5jb2RlVVJJQ29tcG9uZW50KG5hbWUpICsgXCI9XCIgKyBlbmNvZGVVUklDb21wb25lbnQodmFsdWUpO1xuICBcbiAgICBmb3IgKGxldCBvcHRpb25LZXkgaW4gb3B0aW9ucykge1xuICAgICAgdXBkYXRlZENvb2tpZSArPSBcIjsgXCIgKyBvcHRpb25LZXk7XG4gICAgICBsZXQgb3B0aW9uVmFsdWUgPSBvcHRpb25zW29wdGlvbktleV07XG4gICAgICBpZiAob3B0aW9uVmFsdWUgIT09IHRydWUpIHtcbiAgICAgICAgdXBkYXRlZENvb2tpZSArPSBcIj1cIiArIG9wdGlvblZhbHVlO1xuICAgICAgfVxuICAgIH1cbiAgXG4gICAgZG9jdW1lbnQuY29va2llID0gdXBkYXRlZENvb2tpZTtcbn1cblxuJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy5qcy1jb29raWUtZGF0YS13YXJuaW5nX19jbG9zZScsIGZ1bmN0aW9uKCkge1xuICAkKFwiLm1vZGFsLWNvb2tpZVwiKS5yZW1vdmVBdHRyKCdvcGVuJyk7XG4gIHNldENvb2tpZSgnc2l0ZV9jb29raWUnLCAneScsIHsnbWF4LWFnZSc6IDM2MDAgKiAyNCAqIDMwfSk7XG59KTsiXSwibmFtZXMiOlsiJCIsImRhdGVwaWNrZXIiLCJyZWdpb25hbCIsImNsb3NlVGV4dCIsInByZXZUZXh0IiwibmV4dFRleHQiLCJjdXJyZW50VGV4dCIsIm1vbnRoTmFtZXMiLCJtb250aE5hbWVzU2hvcnQiLCJkYXlOYW1lcyIsImRheU5hbWVzU2hvcnQiLCJkYXlOYW1lc01pbiIsIndlZWtIZWFkZXIiLCJkYXRlRm9ybWF0IiwiZmlyc3REYXkiLCJpc1JUTCIsInNob3dNb250aEFmdGVyWWVhciIsInllYXJTdWZmaXgiLCJzZXREZWZhdWx0cyIsInBhcnNlVXJsUXVlcnkiLCJkYXRhIiwibG9jYXRpb24iLCJzZWFyY2giLCJwYWlyIiwic3Vic3RyIiwic3BsaXQiLCJpIiwibGVuZ3RoIiwicGFyYW0iLCJzY3JvbGxUb0Jsb2NrIiwidG8iLCJzcGVlZCIsIm9mZnNldCIsInN0b3AiLCJhbmltYXRlIiwic2Nyb2xsVG9wIiwidG9wIiwib24iLCJldmVudCIsInByZXZlbnREZWZhdWx0IiwidG9nZ2xlQ2xhc3MiLCJyZW1vdmVDbGFzcyIsImhpZGUiLCJtb3VzZW92ZXIiLCJzaG93IiwibW91c2VvdXQiLCJjaG9zZW4iLCJub19yZXN1bHRzX3RleHQiLCJzZWFyY2hfY29udGFpbnMiLCJ3aWR0aCIsImF0dHIiLCJjaGFuZ2UiLCJ1cmwiLCJSb3V0aW5nIiwiZ2VuZXJhdGUiLCJ2YWwiLCJ3aW5kb3ciLCJocmVmIiwiYmluZCIsInZhbHVlIiwiYWpheCIsInR5cGUiLCJxdWVyeSIsImRhdGFUeXBlIiwic3VjY2VzcyIsImVtcHR5IiwiZWFjaCIsInRyYW5zbGl0IiwibmFtZSIsImFwcGVuZCIsIm5vdCIsImNsaWNrIiwiY29uc29sZSIsImxvZyIsImVycm9yIiwieGhyIiwiYWpheE9wdGlvbnMiLCJ0aHJvd25FcnJvciIsImRvY3VtZW50IiwiZm9ybV9wbGF5ZXIiLCJpZCIsInRleHQiLCJyZXNwb25zZSIsIiR0aGlzIiwidG91ciIsImNvdW50cnkiLCJzZWFzb24iLCJodG1sIiwiYWRkQ2xhc3MiLCJoaXN0b3J5IiwicHVzaFN0YXRlIiwic3RhdHVzIiwiYXJHYW1lcyIsImNoYW1wIiwidW5kZXIiLCJnYW1lIiwicHVzaCIsInBhcnNlSW50IiwiYXJyIiwiSlNPTiIsInBhcnNlIiwiZm9yRWFjaCIsIml0ZW0iLCJhckdvYWxzUmVnIiwiZ29hbFJlZyIsImFyQXNzaXN0UmVnIiwiYXNzaXN0UmVnIiwiYXJHb2Fsc1BvIiwiZ29hbFBvIiwiYXJBc3Npc3RQbyIsImFyR2FtZVJlZyIsImdhbWVSZWciLCJhck1pc3NlZFJlZyIsIm1pc3NlZFJlZyIsImFyWmVyb1JlZyIsInplcm9SZWciLCJhckdhbWVQbyIsImdhbWVQbyIsImFyTWlzc2VkUG8iLCJtaXNzZWRQbyIsImFyWmVyb1BvIiwiemVyb1BvIiwidGVhbSIsInJvdXRlIiwidHVybmlyIiwicGFyYW1zIiwiY3NzIiwidW5kZWZpbmVkIiwibGV0dGVyIiwibmV3SHRtbCIsImNudCIsInRlYW1zIiwiZGV0YWlsVXJsIiwibWF4TWF0Y2hlcyIsIm5ld0FyciIsImtleSIsImpvaW4iLCJsb2FkIiwic2xpY2VNYWluTWVudSIsInJlc2l6ZSIsIiRtYWluTWVudSIsImZpbmQiLCJuZXh0RWxlbWVudCIsIiRuZXh0RWxlbWVudCIsInJlbW92ZSIsIiRtYWluTWVudUl0ZW1zIiwiY2hpbGRyZW4iLCJ2aXNpYmxlTWVudVdpZHRoIiwid2luZG93V2lkdGgiLCJ0b3RhbFN1bU1lbnVXaWR0aCIsIm91dGVyV2lkdGgiLCIkcmVtb3ZlZEl0ZW1zIiwiJHJlbW92ZWRJdGVtc0xpc3QiLCIkcmVtb3ZlZEl0ZW1zTGluayIsIl9fc2VjdGlvbk1lbnVBY3RpdmUiLCJfX3NlY3Rpb25NZW51TWVudUlEIiwiX19zZWN0aW9uTWVudU9wZW5lciIsIl9fc2VjdGlvbk1lbnVEcm9wIiwiX19hY3RpdmUiLCJfX21lbnVJRCIsIl9fb3BlbmVyIiwiX19kcm9wIiwiJF9zZWxmIiwiJF9lQ2hpbGQiLCJvcGVuQ2hpbGQiLCIkX3RoaXMiLCJoYXNDbGFzcyIsIl9fbWVudUZpcnN0T3BlblRpbWVvdXRJRCIsInNldFRpbWVvdXQiLCJpcyIsImNsZWFyVGltZW91dCIsIiRfc2VjdGlvbk1lbnVFQ2hpbGQiLCJfX21lbnVUaW1lb3V0SUQiLCJjbG9zZUNoaWxkIiwiJF9jYXB0dXJlVGhpcyIsImhvdmVyIiwicmVhZHkiLCJhZGRFdmVudExpc3RlbmVyIiwiZ2V0U29ydCIsIl9yZWYiLCJ0YXJnZXQiLCJvcmRlciIsImRhdGFzZXQiLCJpbmRleCIsIl90b0NvbnN1bWFibGVBcnJheSIsInBhcmVudE5vZGUiLCJjZWxscyIsImluZGV4T2YiLCJjb2xsYXRvciIsIkludGwiLCJDb2xsYXRvciIsIm51bWVyaWMiLCJjb21wYXJhdG9yIiwiYSIsImIiLCJjb21wYXJlIiwiaW5uZXJUZXh0IiwiX2l0ZXJhdG9yIiwiX2NyZWF0ZUZvck9mSXRlcmF0b3JIZWxwZXIiLCJjbG9zZXN0IiwidEJvZGllcyIsIl9zdGVwIiwicyIsIm4iLCJkb25lIiwidEJvZHkiLCJhcHBseSIsInJvd3MiLCJzb3J0IiwiZXJyIiwiZSIsImYiLCJfaXRlcmF0b3IyIiwiX3N0ZXAyIiwiY2VsbCIsImNsYXNzTGlzdCIsInRvZ2dsZSIsInRoZWFkIiwicXVlcnlTZWxlY3RvckFsbCIsInNldENvb2tpZSIsIm9wdGlvbnMiLCJhcmd1bWVudHMiLCJfb2JqZWN0U3ByZWFkIiwicGF0aCIsImV4cGlyZXMiLCJEYXRlIiwidG9VVENTdHJpbmciLCJ1cGRhdGVkQ29va2llIiwiZW5jb2RlVVJJQ29tcG9uZW50Iiwib3B0aW9uS2V5Iiwib3B0aW9uVmFsdWUiLCJjb29raWUiLCJyZW1vdmVBdHRyIl0sInNvdXJjZVJvb3QiOiIifQ==