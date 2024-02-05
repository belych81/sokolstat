(self["webpackChunk"] = self["webpackChunk"] || []).push([["custom"],{

/***/ "./assets/js/search.js":
/*!*****************************!*\
  !*** ./assets/js/search.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

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
__webpack_require__(/*! core-js/modules/es.array.is-array.js */ "./node_modules/core-js/modules/es.array.is-array.js");
__webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
__webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
__webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
__webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
__webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
__webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
__webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");
__webpack_require__(/*! core-js/modules/es.array.slice.js */ "./node_modules/core-js/modules/es.array.slice.js");
__webpack_require__(/*! core-js/modules/es.date.to-string.js */ "./node_modules/core-js/modules/es.date.to-string.js");
__webpack_require__(/*! core-js/modules/es.regexp.to-string.js */ "./node_modules/core-js/modules/es.regexp.to-string.js");
__webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
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
  $("#shipplayersUpdate").click(function () {
    var arGames = [];
    var champ = $(this).data('champ');
    $(".shipplayer-input").each(function () {
      var game = $(this).val();
      if (game != 0) {
        arGames.push([$(this).data('id'), $(this).data('player'), parseInt(game)]);
      }
    });
    console.log(arGames);
    $.ajax({
      type: 'post',
      url: Routing.generate('shipplayers_update'),
      data: {
        query: arGames,
        champ: champ
      },
      dataType: 'json',
      success: function success(response) {
        console.log(response);
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
  $(".changeGameGoalPlayer").click(function () {
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
      'change': change
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
        console.log(data);
        console.log(route);
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
          console.log($("[data-id=" + id + "][data-param='goalPo']"));
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
  $("body").on("click", ".nhl-dates span[data-date]", function () {
    var data = $(this).data('date');
    $(".nhl-matches.champs").load("/nhl/date/" + data + " .nhl-matches.champs");
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

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_modules_es_object_to-string_js-node_modules_core-js_modules_es_s-6657b7","vendors-node_modules_core-js_modules_es_array_find_js-node_modules_core-js_modules_es_array_f-7d4272"], () => (__webpack_exec__("./assets/js/search.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiY3VzdG9tLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBQUEsQ0FBQyxDQUFDQyxVQUFVLENBQUNDLFFBQVEsQ0FBQyxJQUFJLENBQUMsR0FBRztFQUM3QkMsU0FBUyxFQUFFLFNBQVM7RUFDcEJDLFFBQVEsRUFBRSxZQUFZO0VBQ3RCQyxRQUFRLEVBQUUsV0FBVztFQUNyQkMsV0FBVyxFQUFFLFNBQVM7RUFDdEJDLFVBQVUsRUFBRSxDQUFDLFFBQVEsRUFBQyxTQUFTLEVBQUMsTUFBTSxFQUFDLFFBQVEsRUFBQyxLQUFLLEVBQUMsTUFBTSxFQUFDLE1BQU0sRUFBQyxRQUFRLEVBQUMsVUFBVSxFQUFDLFNBQVMsRUFBQyxRQUFRLEVBQUMsU0FBUyxDQUFDO0VBQ3JIQyxlQUFlLEVBQUUsQ0FBQyxLQUFLLEVBQUMsS0FBSyxFQUFDLEtBQUssRUFBQyxLQUFLLEVBQUMsS0FBSyxFQUFDLEtBQUssRUFBQyxLQUFLLEVBQUMsS0FBSyxFQUFDLEtBQUssRUFBQyxLQUFLLEVBQUMsS0FBSyxFQUFDLEtBQUssQ0FBQztFQUMxRkMsUUFBUSxFQUFFLENBQUMsYUFBYSxFQUFDLGFBQWEsRUFBQyxTQUFTLEVBQUMsT0FBTyxFQUFDLFNBQVMsRUFBQyxTQUFTLEVBQUMsU0FBUyxDQUFDO0VBQ3ZGQyxhQUFhLEVBQUUsQ0FBQyxLQUFLLEVBQUMsS0FBSyxFQUFDLEtBQUssRUFBQyxLQUFLLEVBQUMsS0FBSyxFQUFDLEtBQUssRUFBQyxLQUFLLENBQUM7RUFDMURDLFdBQVcsRUFBRSxDQUFDLElBQUksRUFBQyxJQUFJLEVBQUMsSUFBSSxFQUFDLElBQUksRUFBQyxJQUFJLEVBQUMsSUFBSSxFQUFDLElBQUksQ0FBQztFQUNqREMsVUFBVSxFQUFFLElBQUk7RUFDaEJDLFVBQVUsRUFBRSxVQUFVO0VBQ3RCQyxRQUFRLEVBQUUsQ0FBQztFQUNYQyxLQUFLLEVBQUUsS0FBSztFQUNaQyxrQkFBa0IsRUFBRSxLQUFLO0VBQ3pCQyxVQUFVLEVBQUU7QUFDYixDQUFDO0FBRURqQixDQUFDLENBQUNDLFVBQVUsQ0FBQ2lCLFdBQVcsQ0FBQ2xCLENBQUMsQ0FBQ0MsVUFBVSxDQUFDQyxRQUFRLENBQUMsSUFBSSxDQUFDLENBQUM7QUFFckQsU0FBU2lCLGFBQWFBLENBQUEsRUFBRztFQUNyQixJQUFJQyxJQUFJLEdBQUcsQ0FBQyxDQUFDO0VBQ2IsSUFBR0MsUUFBUSxDQUFDQyxNQUFNLEVBQUU7SUFDaEIsSUFBSUMsSUFBSSxHQUFJRixRQUFRLENBQUNDLE1BQU0sQ0FBQ0UsTUFBTSxDQUFDLENBQUMsQ0FBQyxDQUFFQyxLQUFLLENBQUMsR0FBRyxDQUFDO0lBQ2pELEtBQUksSUFBSUMsQ0FBQyxHQUFHLENBQUMsRUFBRUEsQ0FBQyxHQUFHSCxJQUFJLENBQUNJLE1BQU0sRUFBRUQsQ0FBQyxFQUFHLEVBQUU7TUFDbEMsSUFBSUUsS0FBSyxHQUFHTCxJQUFJLENBQUNHLENBQUMsQ0FBQyxDQUFDRCxLQUFLLENBQUMsR0FBRyxDQUFDO01BQzlCTCxJQUFJLENBQUNRLEtBQUssQ0FBQyxDQUFDLENBQUMsQ0FBQyxHQUFHQSxLQUFLLENBQUMsQ0FBQyxDQUFDO0lBQzdCO0VBQ0o7RUFDQSxPQUFPUixJQUFJO0FBQ2Y7QUFFQSxTQUFTUyxhQUFhQSxDQUFDQyxFQUFFLEVBQUVDLEtBQUssRUFBRUMsTUFBTSxFQUFFO0VBQ3hDLElBQUksT0FBT0YsRUFBRSxLQUFLLFFBQVEsRUFBRUEsRUFBRSxHQUFHOUIsQ0FBQyxDQUFDOEIsRUFBRSxDQUFDO0VBQ3RDLElBQUksQ0FBQ0EsRUFBRSxDQUFDLENBQUMsQ0FBQyxFQUFFO0VBQ1pFLE1BQU0sR0FBR0EsTUFBTSxJQUFJLEVBQUU7RUFDckJELEtBQUssR0FBR0EsS0FBSyxJQUFJLElBQUk7RUFDckIvQixDQUFDLENBQUMsWUFBWSxDQUFDLENBQUNpQyxJQUFJLENBQUMsQ0FBQyxDQUFDQyxPQUFPLENBQUM7SUFDN0JDLFNBQVMsRUFBRUwsRUFBRSxDQUFDRSxNQUFNLENBQUMsQ0FBQyxDQUFDSSxHQUFHLEdBQUdKO0VBQy9CLENBQUMsRUFBRUQsS0FBSyxDQUFDO0FBQ1g7QUFFRS9CLENBQUMsQ0FBQyxZQUFVO0VBQ1ZBLENBQUMsQ0FBQyxlQUFlLENBQUMsQ0FBQ3FDLEVBQUUsQ0FBQyxPQUFPLEVBQUUsVUFBU0MsS0FBSyxFQUFFO0lBQzdDQSxLQUFLLENBQUNDLGNBQWMsQ0FBQyxDQUFDO0lBQ3RCdkMsQ0FBQyxDQUFDLFlBQVksQ0FBQyxDQUFDd0MsV0FBVyxDQUFDLE1BQU0sQ0FBQztJQUNuQ3hDLENBQUMsQ0FBQyxvQkFBb0IsQ0FBQyxDQUFDeUMsV0FBVyxDQUFDLElBQUksQ0FBQztFQUMzQyxDQUFDLENBQUM7RUFFRnpDLENBQUMsQ0FBQyxZQUFZLENBQUMsQ0FBQzBDLElBQUksQ0FBQyxDQUFDO0VBQ3RCMUMsQ0FBQyxDQUFDLFFBQVEsQ0FBQyxDQUFDMkMsU0FBUyxDQUFDLFlBQVc7SUFDN0IzQyxDQUFDLENBQUMsWUFBWSxDQUFDLENBQUM0QyxJQUFJLENBQUMsQ0FBQztFQUMxQixDQUFDLENBQUMsQ0FBQ0MsUUFBUSxDQUFDLFlBQVc7SUFDbkI3QyxDQUFDLENBQUMsWUFBWSxDQUFDLENBQUMwQyxJQUFJLENBQUMsQ0FBQztFQUMxQixDQUFDLENBQUM7RUFFSjFDLENBQUMsQ0FBQyxRQUFRLENBQUMsQ0FBQzhDLE1BQU0sQ0FBQztJQUNsQkMsZUFBZSxFQUFFLFlBQVk7SUFDN0JDLGVBQWUsRUFBRSxJQUFJO0lBQ3JCQyxLQUFLLEVBQUU7RUFDUixDQUFDLENBQUM7RUFFRmpELENBQUMsQ0FBQyxnQkFBZ0IsQ0FBQyxDQUFDcUMsRUFBRSxDQUFDLE9BQU8sRUFBRSxZQUFZO0lBQzFDLElBQUlQLEVBQUUsR0FBRzlCLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ2tELElBQUksQ0FBQyxNQUFNLENBQUMsSUFBSWxELENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ29CLElBQUksQ0FBQyxNQUFNLENBQUM7SUFDckRTLGFBQWEsQ0FBQ0MsRUFBRSxDQUFDO0lBQ2pCLE9BQU8sS0FBSztFQUNkLENBQUMsQ0FBQztFQUVGOUIsQ0FBQyxDQUFDLG9CQUFvQixDQUFDLENBQUNtRCxNQUFNLENBQUMsWUFBVTtJQUN4QyxJQUFJQyxHQUFHLEdBQUdDLE9BQU8sQ0FBQ0MsUUFBUSxDQUFDLFFBQVEsRUFBRTtNQUNwQyxNQUFNLEVBQUV0RCxDQUFDLENBQUMsSUFBSSxDQUFDLENBQUN1RCxHQUFHLENBQUMsQ0FBQztNQUFFLFNBQVMsRUFBRXZELENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ29CLElBQUksQ0FBQyxTQUFTO0lBQ3pELENBQUMsQ0FBQztJQUNGb0MsTUFBTSxDQUFDbkMsUUFBUSxDQUFDb0MsSUFBSSxHQUFHTCxHQUFHO0VBQzNCLENBQUMsQ0FBQztFQUVGcEQsQ0FBQyxDQUFDLDBDQUEwQyxDQUFDLENBQUNtRCxNQUFNLENBQUMsWUFBVTtJQUM5RCxJQUFJQyxHQUFHLEdBQUdDLE9BQU8sQ0FBQ0MsUUFBUSxDQUFDLFFBQVEsRUFBRTtNQUNwQyxTQUFTLEVBQUV0RCxDQUFDLENBQUMsSUFBSSxDQUFDLENBQUN1RCxHQUFHLENBQUMsQ0FBQztNQUFFLE1BQU0sRUFBRXZELENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ29CLElBQUksQ0FBQyxNQUFNO0lBQ3RELENBQUMsQ0FBQztJQUNGb0MsTUFBTSxDQUFDbkMsUUFBUSxDQUFDb0MsSUFBSSxHQUFHTCxHQUFHO0VBQzNCLENBQUMsQ0FBQztFQUNBcEQsQ0FBQyxDQUFDLCtDQUErQyxDQUFDLENBQUNtRCxNQUFNLENBQUMsWUFBVTtJQUNyRSxJQUFJQyxHQUFHLEdBQUdDLE9BQU8sQ0FBQ0MsUUFBUSxDQUFDLFlBQVksRUFBRTtNQUN4QyxTQUFTLEVBQUV0RCxDQUFDLENBQUMsSUFBSSxDQUFDLENBQUN1RCxHQUFHLENBQUMsQ0FBQztNQUFFLE1BQU0sRUFBRXZELENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ29CLElBQUksQ0FBQyxNQUFNO0lBQ3RELENBQUMsQ0FBQztJQUNGb0MsTUFBTSxDQUFDbkMsUUFBUSxDQUFDb0MsSUFBSSxHQUFHTCxHQUFHO0VBQzNCLENBQUMsQ0FBQzs7RUFFQTtFQUNEcEQsQ0FBQyxDQUFDLGtCQUFrQixDQUFDLENBQUMwRCxJQUFJLENBQUMsT0FBTyxFQUFFLFlBQVc7SUFDNUMsSUFBRyxJQUFJLENBQUNDLEtBQUssQ0FBQ2hDLE1BQU0sSUFBSSxDQUFDLEVBQUM7TUFDdEIzQixDQUFDLENBQUM0RCxJQUFJLENBQUM7UUFDSEMsSUFBSSxFQUFFLE1BQU07UUFDWlQsR0FBRyxFQUFFQyxPQUFPLENBQUNDLFFBQVEsQ0FBQyxhQUFhLENBQUM7UUFDcENsQyxJQUFJLEVBQUU7VUFBQzBDLEtBQUssRUFBRSxJQUFJLENBQUNIO1FBQUssQ0FBQztRQUN6QkksUUFBUSxFQUFFLE1BQU07UUFDaEJDLE9BQU8sRUFBRSxTQUFBQSxRQUFTNUMsSUFBSSxFQUFDO1VBQ25CcEIsQ0FBQyxDQUFDLHNCQUFzQixDQUFDLENBQUNpRSxLQUFLLENBQUMsQ0FBQyxDQUFDdkIsSUFBSSxDQUFDLENBQUM7VUFDeEMsSUFBR3RCLElBQUksRUFBQztZQUNKcEIsQ0FBQyxDQUFDLHNDQUFzQyxDQUFDLENBQUM0QyxJQUFJLENBQUMsQ0FBQztZQUNoRDVDLENBQUMsQ0FBQ2tFLElBQUksQ0FBQzlDLElBQUksRUFBRSxVQUFTK0MsUUFBUSxFQUFFQyxJQUFJLEVBQUM7Y0FDakNwRSxDQUFDLENBQUMsc0JBQXNCLENBQUMsQ0FDeEJxRSxNQUFNLENBQUMsWUFBWSxHQUFDRixRQUFRLEdBQUMsSUFBSSxHQUFDQyxJQUFJLEdBQUMsTUFBTSxDQUFDO1lBRW5ELENBQUMsQ0FBQztZQUNGcEUsQ0FBQyxDQUFDLE1BQU0sQ0FBQyxDQUFDc0UsR0FBRyxDQUFDLGFBQWEsQ0FBQyxDQUFDQyxLQUFLLENBQUMsWUFBVTtjQUMzQ3ZFLENBQUMsQ0FBQyxzQ0FBc0MsQ0FBQyxDQUFDMEMsSUFBSSxDQUFDLENBQUM7WUFDbEQsQ0FBQyxDQUFDO1VBQ04sQ0FBQyxNQUFNO1lBQ0gxQyxDQUFDLENBQUMsc0NBQXNDLENBQUMsQ0FBQzBDLElBQUksQ0FBQyxDQUFDO1VBQ3BEO1VBQ0E4QixPQUFPLENBQUNDLEdBQUcsQ0FBQ3JELElBQUksQ0FBQztRQUN0QixDQUFDO1FBQ1BzRCxLQUFLLEVBQUUsU0FBQUEsTUFBVUMsR0FBRyxFQUFFQyxXQUFXLEVBQUVDLFdBQVcsRUFBRSxDQUMvQztNQUNGLENBQUMsQ0FBQztJQUNGLENBQUMsTUFBTTtNQUNMN0UsQ0FBQyxDQUFDLHNDQUFzQyxDQUFDLENBQUMwQyxJQUFJLENBQUMsQ0FBQztJQUNsRDtFQUNKLENBQUMsQ0FBQztFQUVGMUMsQ0FBQyxDQUFDOEUsUUFBUSxDQUFDLENBQUN6QyxFQUFFLENBQUMsT0FBTyxFQUFFLGFBQWEsRUFBRSxZQUFXO0lBQ2hELElBQUcsSUFBSSxDQUFDc0IsS0FBSyxDQUFDaEMsTUFBTSxJQUFJLENBQUMsRUFBQztNQUN0QjNCLENBQUMsQ0FBQzRELElBQUksQ0FBQztRQUNIQyxJQUFJLEVBQUUsTUFBTTtRQUNaVCxHQUFHLEVBQUVDLE9BQU8sQ0FBQ0MsUUFBUSxDQUFDLGFBQWEsQ0FBQztRQUNwQ2xDLElBQUksRUFBRTtVQUFDMEMsS0FBSyxFQUFFLElBQUksQ0FBQ0gsS0FBSztVQUFFb0IsV0FBVyxFQUFFO1FBQUcsQ0FBQztRQUMzQ2hCLFFBQVEsRUFBRSxNQUFNO1FBQ2hCQyxPQUFPLEVBQUUsU0FBQUEsUUFBUzVDLElBQUksRUFBQztVQUNuQnBCLENBQUMsQ0FBQyw2QkFBNkIsQ0FBQyxDQUFDaUUsS0FBSyxDQUFDLENBQUMsQ0FBQ3ZCLElBQUksQ0FBQyxDQUFDO1VBQy9DLElBQUd0QixJQUFJLEVBQUM7WUFDSnBCLENBQUMsQ0FBQyxvREFBb0QsQ0FBQyxDQUFDNEMsSUFBSSxDQUFDLENBQUM7WUFDOUQ1QyxDQUFDLENBQUNrRSxJQUFJLENBQUM5QyxJQUFJLEVBQUUsVUFBUzRELEVBQUUsRUFBRVosSUFBSSxFQUFDO2NBQzNCcEUsQ0FBQyxDQUFDLDZCQUE2QixDQUFDLENBQy9CcUUsTUFBTSxDQUFDLDZDQUE2QyxHQUFDVyxFQUFFLEdBQUMsSUFBSSxHQUFDWixJQUFJLEdBQUMsUUFBUSxDQUFDO1lBRWhGLENBQUMsQ0FBQztZQUNGcEUsQ0FBQyxDQUFDLE1BQU0sQ0FBQyxDQUFDc0UsR0FBRyxDQUFDLGFBQWEsQ0FBQyxDQUFDQyxLQUFLLENBQUMsWUFBVTtjQUMzQ3ZFLENBQUMsQ0FBQyxvREFBb0QsQ0FBQyxDQUFDMEMsSUFBSSxDQUFDLENBQUM7WUFDaEUsQ0FBQyxDQUFDO1lBQ0YxQyxDQUFDLENBQUM4RSxRQUFRLENBQUMsQ0FBQ3pDLEVBQUUsQ0FBQyxPQUFPLEVBQUUscUJBQXFCLEVBQUUsWUFBVTtjQUN2RHJDLENBQUMsQ0FBQyxhQUFhLENBQUMsQ0FBQ3VELEdBQUcsQ0FBQ3ZELENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ2lGLElBQUksQ0FBQyxDQUFDLENBQUM7Y0FDcENqRixDQUFDLENBQUMsb0JBQW9CLENBQUMsQ0FBQ3VELEdBQUcsQ0FBQ3ZELENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ29CLElBQUksQ0FBQyxJQUFJLENBQUMsQ0FBQztjQUMvQ3BCLENBQUMsQ0FBQzRELElBQUksQ0FBQztnQkFDTEMsSUFBSSxFQUFFLE1BQU07Z0JBQ1pULEdBQUcsRUFBRUMsT0FBTyxDQUFDQyxRQUFRLENBQUMsb0JBQW9CLEVBQUU7a0JBQUMsSUFBSSxFQUFFdEQsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDb0IsSUFBSSxDQUFDLElBQUk7Z0JBQUMsQ0FBQyxDQUFDO2dCQUN2RTRDLE9BQU8sRUFBRSxTQUFBQSxRQUFTa0IsUUFBUSxFQUFDO2tCQUN2QlYsT0FBTyxDQUFDQyxHQUFHLENBQUNTLFFBQVEsQ0FBQztnQkFDekI7Y0FDSixDQUFDLENBQUM7WUFDRixDQUFDLENBQUM7VUFDTixDQUFDLE1BQU07WUFDSGxGLENBQUMsQ0FBQyxvREFBb0QsQ0FBQyxDQUFDMEMsSUFBSSxDQUFDLENBQUM7VUFDbEU7VUFDQThCLE9BQU8sQ0FBQ0MsR0FBRyxDQUFDckQsSUFBSSxDQUFDO1FBQ3RCLENBQUM7UUFDUHNELEtBQUssRUFBRSxTQUFBQSxNQUFVQyxHQUFHLEVBQUVDLFdBQVcsRUFBRUMsV0FBVyxFQUFFLENBQy9DO01BQ0YsQ0FBQyxDQUFDO0lBQ0YsQ0FBQyxNQUFNO01BQ0w3RSxDQUFDLENBQUMsb0RBQW9ELENBQUMsQ0FBQzBDLElBQUksQ0FBQyxDQUFDO0lBQ2hFO0VBQ0osQ0FBQyxDQUFDO0VBRUYxQyxDQUFDLENBQUM4RSxRQUFRLENBQUMsQ0FBQ3pDLEVBQUUsQ0FBQyxPQUFPLEVBQUUsVUFBVSxFQUFFLFlBQVU7SUFDNUMsSUFBSThDLEtBQUssR0FBR25GLENBQUMsQ0FBQyxJQUFJLENBQUM7SUFDbkIsSUFBSW9GLElBQUksR0FBR0QsS0FBSyxDQUFDL0QsSUFBSSxDQUFDLE1BQU0sQ0FBQztJQUM3QixJQUFJaUUsT0FBTyxHQUFHRixLQUFLLENBQUMvRCxJQUFJLENBQUMsU0FBUyxDQUFDO0lBQ25DLElBQUlrRSxNQUFNLEdBQUdILEtBQUssQ0FBQy9ELElBQUksQ0FBQyxRQUFRLENBQUM7SUFDakNwQixDQUFDLENBQUM0RCxJQUFJLENBQUM7TUFDTEMsSUFBSSxFQUFFLE1BQU07TUFDWlQsR0FBRyxFQUFFQyxPQUFPLENBQUNDLFFBQVEsQ0FBQyxvQkFBb0IsRUFBRTtRQUFDLE1BQU0sRUFBQzhCLElBQUk7UUFBRSxRQUFRLEVBQUVFLE1BQU07UUFBRSxTQUFTLEVBQUVEO01BQU8sQ0FBQyxDQUFDO01BQ2hHdEIsUUFBUSxFQUFFLE1BQU07TUFDaEJDLE9BQU8sRUFBRSxTQUFBQSxRQUFTa0IsUUFBUSxFQUFDO1FBQ3pCbEYsQ0FBQyxDQUFDLHdCQUF3QixDQUFDLENBQUN1RixJQUFJLENBQUNMLFFBQVEsQ0FBQ0EsUUFBUSxDQUFDO1FBQ25EbEYsQ0FBQyxDQUFDLGlCQUFpQixDQUFDLENBQUNpRixJQUFJLENBQUNHLElBQUksQ0FBQztRQUMvQnBGLENBQUMsQ0FBQyxVQUFVLENBQUMsQ0FBQ3lDLFdBQVcsQ0FBQyxRQUFRLENBQUM7UUFDbkMwQyxLQUFLLENBQUNLLFFBQVEsQ0FBQyxRQUFRLENBQUM7UUFDeEJDLE9BQU8sQ0FBQ0MsU0FBUyxDQUFDLElBQUksRUFBRSxFQUFFLEVBQUVyQyxPQUFPLENBQUNDLFFBQVEsQ0FBQyxlQUFlLEVBQUU7VUFBQyxNQUFNLEVBQUM4QixJQUFJO1VBQUUsUUFBUSxFQUFFRSxNQUFNO1VBQUUsU0FBUyxFQUFFRDtRQUFPLENBQUMsQ0FBQyxDQUFDO01BQ3JILENBQUM7TUFDRFgsS0FBSyxFQUFFLFNBQUFBLE1BQVVDLEdBQUcsRUFBRUMsV0FBVyxFQUFFQyxXQUFXLEVBQUU7UUFDOUNMLE9BQU8sQ0FBQ0MsR0FBRyxDQUFDRSxHQUFHLENBQUNnQixNQUFNLENBQUM7UUFDdkJuQixPQUFPLENBQUNDLEdBQUcsQ0FBQ0ksV0FBVyxDQUFDO01BQzFCO0lBQ0osQ0FBQyxDQUFDO0VBQ0YsQ0FBQyxDQUFDO0VBRUE3RSxDQUFDLENBQUMsb0JBQW9CLENBQUMsQ0FBQ3VFLEtBQUssQ0FBQyxZQUFVO0lBQ3RDLElBQUlxQixPQUFPLEdBQUcsRUFBRTtJQUNsQixJQUFJQyxLQUFLLEdBQUc3RixDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNvQixJQUFJLENBQUMsT0FBTyxDQUFDO0lBQy9CcEIsQ0FBQyxDQUFDLG1CQUFtQixDQUFDLENBQUNrRSxJQUFJLENBQUMsWUFBVTtNQUNwQyxJQUFJNEIsSUFBSSxHQUFHOUYsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDdUQsR0FBRyxDQUFDLENBQUM7TUFDeEIsSUFBR3VDLElBQUksSUFBSSxDQUFDLEVBQUM7UUFDWEYsT0FBTyxDQUFDRyxJQUFJLENBQUMsQ0FDWC9GLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ29CLElBQUksQ0FBQyxJQUFJLENBQUMsRUFDbEJwQixDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNvQixJQUFJLENBQUMsUUFBUSxDQUFDLEVBQ3RCNEUsUUFBUSxDQUFDRixJQUFJLENBQUMsQ0FDZixDQUFDO01BQ0o7SUFDRixDQUFDLENBQUM7SUFDRnRCLE9BQU8sQ0FBQ0MsR0FBRyxDQUFDbUIsT0FBTyxDQUFDO0lBQ3BCNUYsQ0FBQyxDQUFDNEQsSUFBSSxDQUFDO01BQ0hDLElBQUksRUFBRSxNQUFNO01BQ1pULEdBQUcsRUFBRUMsT0FBTyxDQUFDQyxRQUFRLENBQUMsb0JBQW9CLENBQUM7TUFDM0NsQyxJQUFJLEVBQUU7UUFBQzBDLEtBQUssRUFBRThCLE9BQU87UUFBRUMsS0FBSyxFQUFFQTtNQUFLLENBQUM7TUFDcEM5QixRQUFRLEVBQUUsTUFBTTtNQUNoQkMsT0FBTyxFQUFFLFNBQUFBLFFBQVNrQixRQUFRLEVBQUM7UUFDekJWLE9BQU8sQ0FBQ0MsR0FBRyxDQUFDUyxRQUFRLENBQUM7UUFDckIsSUFBSWUsR0FBRyxHQUFHQyxJQUFJLENBQUNDLEtBQUssQ0FBQ2pCLFFBQVEsQ0FBQztRQUM5QmUsR0FBRyxDQUFDRyxPQUFPLENBQUMsVUFBU0MsSUFBSSxFQUFFM0UsQ0FBQyxFQUFFdUUsR0FBRyxFQUFFO1VBQ2pDakcsQ0FBQyxDQUFDLFdBQVcsR0FBQ3FHLElBQUksQ0FBQyxDQUFDLENBQUMsR0FBQyxzQkFBc0IsQ0FBQyxDQUFDcEIsSUFBSSxDQUFDb0IsSUFBSSxDQUFDLENBQUMsQ0FBQyxDQUFDO1FBQzdELENBQUMsQ0FBQztNQUNKLENBQUM7TUFDRDNCLEtBQUssRUFBRSxTQUFBQSxNQUFVQyxHQUFHLEVBQUVDLFdBQVcsRUFBRUMsV0FBVyxFQUFFO1FBQzlDTCxPQUFPLENBQUNDLEdBQUcsQ0FBQ0UsR0FBRyxDQUFDZ0IsTUFBTSxDQUFDO1FBQ3ZCbkIsT0FBTyxDQUFDQyxHQUFHLENBQUNJLFdBQVcsQ0FBQztNQUMxQjtJQUNKLENBQUMsQ0FBQztFQUNKLENBQUMsQ0FBQztFQUVGN0UsQ0FBQyxDQUFDLHVCQUF1QixDQUFDLENBQUN1RSxLQUFLLENBQUMsWUFBVTtJQUN6QyxJQUFJcEIsTUFBTSxHQUFHbkQsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDb0IsSUFBSSxDQUFDLFFBQVEsQ0FBQztJQUNuQyxJQUFJNEQsRUFBRSxHQUFHaEYsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDb0IsSUFBSSxDQUFDLElBQUksQ0FBQztJQUMzQixJQUFJa0UsTUFBTSxHQUFHdEYsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDb0IsSUFBSSxDQUFDLFFBQVEsQ0FBQztJQUNuQyxJQUFJa0YsSUFBSSxHQUFHdEcsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDb0IsSUFBSSxDQUFDLE1BQU0sQ0FBQztJQUMvQixJQUFJbUYsS0FBSyxHQUFHdkcsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDb0IsSUFBSSxDQUFDLE1BQU0sQ0FBQztJQUNsQyxJQUFJb0YsTUFBTSxHQUFHeEcsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDb0IsSUFBSSxDQUFDLFFBQVEsQ0FBQztJQUNuQyxJQUFJK0QsS0FBSyxHQUFHbkYsQ0FBQyxDQUFDLElBQUksQ0FBQztJQUNuQixJQUFJeUcsTUFBTSxHQUFHO01BQUMsSUFBSSxFQUFFekIsRUFBRTtNQUFFLFFBQVEsRUFBRU0sTUFBTTtNQUFFLFFBQVEsRUFBRW5DO0lBQU0sQ0FBQztJQUMzRG5ELENBQUMsQ0FBQyxtQkFBbUIsR0FBQ2dGLEVBQUUsR0FBQyxHQUFHLENBQUMsQ0FBQzBCLEdBQUcsQ0FBQyxTQUFTLEVBQUUsY0FBYyxDQUFDO0lBQzVELElBQUdGLE1BQU0sSUFBSUcsU0FBUyxFQUFDO01BQ3RCRixNQUFNLENBQUMsUUFBUSxDQUFDLEdBQUdELE1BQU07SUFDMUI7SUFDQSxJQUFHRCxLQUFLLElBQUksZUFBZSxFQUFDO01BQzNCRSxNQUFNLENBQUMsTUFBTSxDQUFDLEdBQUdILElBQUk7SUFDdEI7SUFDRXRHLENBQUMsQ0FBQzRELElBQUksQ0FBQztNQUNIQyxJQUFJLEVBQUUsTUFBTTtNQUNaVCxHQUFHLEVBQUVDLE9BQU8sQ0FBQ0MsUUFBUSxDQUFDaUQsS0FBSyxFQUFFRSxNQUFNLENBQUM7TUFDcEMxQyxRQUFRLEVBQUUsTUFBTTtNQUNoQkMsT0FBTyxFQUFFLFNBQUFBLFFBQVM1QyxJQUFJLEVBQUM7UUFDMUJvRCxPQUFPLENBQUNDLEdBQUcsQ0FBQ3JELElBQUksQ0FBQztRQUNab0QsT0FBTyxDQUFDQyxHQUFHLENBQUM4QixLQUFLLENBQUM7UUFDaEJ2RyxDQUFDLENBQUMsa0JBQWtCLENBQUMsQ0FBQ3lDLFdBQVcsQ0FBQyxVQUFVLENBQUM7UUFDN0N6QyxDQUFDLENBQUMsa0JBQWtCLEdBQUNnRixFQUFFLEdBQUMsR0FBRyxDQUFDLENBQUNRLFFBQVEsQ0FBQyxVQUFVLENBQUM7UUFDdkQsSUFBR2UsS0FBSyxJQUFJLDRCQUE0QixFQUFDO1VBQ3hDdkcsQ0FBQyxDQUFDLFdBQVcsR0FBQ2dGLEVBQUUsR0FBQywyQkFBMkIsQ0FBQyxDQUFDQyxJQUFJLENBQUM3RCxJQUFJLENBQUMsTUFBTSxDQUFDLENBQUM7VUFDMURwQixDQUFDLENBQUMsV0FBVyxHQUFDZ0YsRUFBRSxHQUFDLDJCQUEyQixDQUFDLENBQUNDLElBQUksQ0FBQzdELElBQUksQ0FBQyxNQUFNLENBQUMsQ0FBQztRQUN2RSxDQUFDLE1BQU0sSUFBR21GLEtBQUssSUFBSSwyQkFBMkIsRUFBQztVQUN2Q3ZHLENBQUMsQ0FBQyxXQUFXLEdBQUNnRixFQUFFLEdBQUMscUJBQXFCLENBQUMsQ0FBQ0MsSUFBSSxDQUFDN0QsSUFBSSxDQUFDLE1BQU0sQ0FBQyxDQUFDO1FBQ2xFLENBQUMsTUFBTSxJQUFHbUYsS0FBSyxJQUFJLGdDQUFnQyxFQUFDO1VBQ2xEdkcsQ0FBQyxDQUFDLFdBQVcsR0FBQ2dGLEVBQUUsR0FBQywwQkFBMEIsQ0FBQyxDQUFDQyxJQUFJLENBQUM3RCxJQUFJLENBQUMsTUFBTSxDQUFDLENBQUM7UUFDakUsQ0FBQyxNQUFNLElBQUdtRixLQUFLLElBQUksK0JBQStCLEVBQUM7VUFDakR2RyxDQUFDLENBQUMsV0FBVyxHQUFDZ0YsRUFBRSxHQUFDLHlCQUF5QixDQUFDLENBQUNDLElBQUksQ0FBQzdELElBQUksQ0FBQyxNQUFNLENBQUMsQ0FBQztRQUNoRSxDQUFDLE1BQU0sSUFBR21GLEtBQUssSUFBSSwrQkFBK0IsRUFBQztVQUNqRHZHLENBQUMsQ0FBQyxXQUFXLEdBQUNnRixFQUFFLEdBQUMseUJBQXlCLENBQUMsQ0FBQ0MsSUFBSSxDQUFDN0QsSUFBSSxDQUFDLE1BQU0sQ0FBQyxDQUFDO1FBQ2hFLENBQUMsTUFBTTtVQUNDb0QsT0FBTyxDQUFDQyxHQUFHLENBQUN6RSxDQUFDLENBQUMsV0FBVyxHQUFDZ0YsRUFBRSxHQUFDLHdCQUF3QixDQUFDLENBQUM7VUFDeERoRixDQUFDLENBQUMsV0FBVyxHQUFDZ0YsRUFBRSxHQUFDLHNCQUFzQixDQUFDLENBQUNDLElBQUksQ0FBQzdELElBQUksQ0FBQyxNQUFNLENBQUMsQ0FBQztVQUMzRHBCLENBQUMsQ0FBQyxXQUFXLEdBQUNnRixFQUFFLEdBQUMsc0JBQXNCLENBQUMsQ0FBQ0MsSUFBSSxDQUFDN0QsSUFBSSxDQUFDLE1BQU0sQ0FBQyxDQUFDO1VBQzFEcEIsQ0FBQyxDQUFDLFdBQVcsR0FBQ2dGLEVBQUUsR0FBQyx3QkFBd0IsQ0FBQyxDQUFDQyxJQUFJLENBQUM3RCxJQUFJLENBQUMsUUFBUSxDQUFDLENBQUM7VUFDaEVwQixDQUFDLENBQUMsV0FBVyxHQUFDZ0YsRUFBRSxHQUFDLHdCQUF3QixDQUFDLENBQUNDLElBQUksQ0FBQzdELElBQUksQ0FBQyxRQUFRLENBQUMsQ0FBQztRQUN0RTtRQUNNcEIsQ0FBQyxDQUFDLFdBQVcsR0FBQ2dGLEVBQUUsR0FBQyx3QkFBd0IsQ0FBQyxDQUFDQyxJQUFJLENBQUM3RCxJQUFJLENBQUMsUUFBUSxDQUFDLENBQUM7UUFDL0RwQixDQUFDLENBQUMsV0FBVyxHQUFDZ0YsRUFBRSxHQUFDLHVCQUF1QixDQUFDLENBQUNDLElBQUksQ0FBQzdELElBQUksQ0FBQyxPQUFPLENBQUMsQ0FBQztRQUM3RHBCLENBQUMsQ0FBQyxXQUFXLEdBQUNnRixFQUFFLEdBQUMsd0JBQXdCLENBQUMsQ0FBQ0MsSUFBSSxDQUFDN0QsSUFBSSxDQUFDLFFBQVEsQ0FBQyxDQUFDO1FBQy9EcEIsQ0FBQyxDQUFDLFdBQVcsR0FBQ2dGLEVBQUUsR0FBQyxzQkFBc0IsQ0FBQyxDQUFDQyxJQUFJLENBQUM3RCxJQUFJLENBQUMsTUFBTSxDQUFDLENBQUM7UUFDM0RwQixDQUFDLENBQUMsV0FBVyxHQUFDZ0YsRUFBRSxHQUFDLDBCQUEwQixDQUFDLENBQUNDLElBQUksQ0FBQzdELElBQUksQ0FBQyxVQUFVLENBQUMsQ0FBQztRQUNuRXBCLENBQUMsQ0FBQyxXQUFXLEdBQUNnRixFQUFFLEdBQUMseUJBQXlCLENBQUMsQ0FBQ0MsSUFBSSxDQUFDN0QsSUFBSSxDQUFDLFNBQVMsQ0FBQyxDQUFDO1FBQ2pFcEIsQ0FBQyxDQUFDLFdBQVcsR0FBQ2dGLEVBQUUsR0FBQywwQkFBMEIsQ0FBQyxDQUFDQyxJQUFJLENBQUM3RCxJQUFJLENBQUMsVUFBVSxDQUFDLENBQUM7UUFDbkVwQixDQUFDLENBQUMsV0FBVyxHQUFDZ0YsRUFBRSxHQUFDLHdCQUF3QixDQUFDLENBQUNDLElBQUksQ0FBQzdELElBQUksQ0FBQyxRQUFRLENBQUMsQ0FBQztRQUNyRXBCLENBQUMsQ0FBQyxtQkFBbUIsR0FBQ2dGLEVBQUUsR0FBQyxHQUFHLENBQUMsQ0FBQ3RDLElBQUksQ0FBQyxDQUFDO1FBQ3BDeUMsS0FBSyxDQUFDSyxRQUFRLENBQUMsZ0JBQWdCLENBQUM7TUFDOUIsQ0FBQztNQUNEZCxLQUFLLEVBQUUsU0FBQUEsTUFBVUMsR0FBRyxFQUFFQyxXQUFXLEVBQUVDLFdBQVcsRUFBRTtRQUM5Q0wsT0FBTyxDQUFDQyxHQUFHLENBQUNFLEdBQUcsQ0FBQ2dCLE1BQU0sQ0FBQztRQUN2Qm5CLE9BQU8sQ0FBQ0MsR0FBRyxDQUFDSSxXQUFXLENBQUM7TUFDMUI7SUFDRixDQUFDLENBQUM7RUFDTixDQUFDLENBQUM7RUFFRjdFLENBQUMsQ0FBQyxrQkFBa0IsQ0FBQyxDQUFDdUUsS0FBSyxDQUFDLFlBQVU7SUFDcEMsSUFBSXFDLE1BQU0sR0FBRzVHLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ2lGLElBQUksQ0FBQyxDQUFDO0lBQzNCakYsQ0FBQyxDQUFDNEQsSUFBSSxDQUFDO01BQ0hDLElBQUksRUFBRSxNQUFNO01BQ1pULEdBQUcsRUFBRUMsT0FBTyxDQUFDQyxRQUFRLENBQUMsb0JBQW9CLEVBQUU7UUFBQyxRQUFRLEVBQUNzRDtNQUFNLENBQUMsQ0FBQztNQUM5RDdDLFFBQVEsRUFBRSxNQUFNO01BQ2hCQyxPQUFPLEVBQUUsU0FBQUEsUUFBUzVDLElBQUksRUFBQztRQUNuQixJQUFJeUYsT0FBTyxHQUFHLEVBQUU7UUFDaEIsS0FBSSxJQUFJbkYsQ0FBQyxHQUFDLENBQUMsRUFBRW9GLEdBQUcsR0FBQzFGLElBQUksQ0FBQzJGLEtBQUssQ0FBQ3BGLE1BQU0sRUFBRUQsQ0FBQyxHQUFHb0YsR0FBRyxFQUFFcEYsQ0FBQyxFQUFFLEVBQUM7VUFDL0MsSUFBSXNGLFNBQVMsR0FBRzNELE9BQU8sQ0FBQ0MsUUFBUSxDQUFDLFdBQVcsRUFBRTtZQUM1QyxNQUFNLEVBQUVsQyxJQUFJLENBQUMyRixLQUFLLENBQUNyRixDQUFDLENBQUMsQ0FBQyxDQUFDO1VBQUMsQ0FBQyxDQUFDO1VBRTVCbUYsT0FBTyxJQUFJLGVBQWUsR0FBRUcsU0FBUyxHQUFFLG1CQUFtQixHQUN0RDVGLElBQUksQ0FBQzJGLEtBQUssQ0FBQ3JGLENBQUMsQ0FBQyxDQUFDLENBQUMsQ0FBQyxHQUFHLFdBQVc7UUFDcEM7UUFDQTFCLENBQUMsQ0FBQyxhQUFhLENBQUMsQ0FBQ3VGLElBQUksQ0FBQ3NCLE9BQU8sQ0FBQztNQUNsQyxDQUFDO01BQ0RuQyxLQUFLLEVBQUUsU0FBQUEsTUFBVUMsR0FBRyxFQUFFQyxXQUFXLEVBQUVDLFdBQVcsRUFBRTtRQUM5Q0wsT0FBTyxDQUFDQyxHQUFHLENBQUNFLEdBQUcsQ0FBQ2dCLE1BQU0sQ0FBQztRQUN2Qm5CLE9BQU8sQ0FBQ0MsR0FBRyxDQUFDSSxXQUFXLENBQUM7TUFDMUI7SUFDRixDQUFDLENBQUM7RUFDTixDQUFDLENBQUM7RUFFRjdFLENBQUMsQ0FBQyxvQkFBb0IsQ0FBQyxDQUFDbUQsTUFBTSxDQUFDLFlBQVU7SUFDdkMsSUFBSThELFVBQVUsR0FBR2pILENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ3VELEdBQUcsQ0FBQyxDQUFDO01BQzVCa0QsTUFBTSxHQUFHdEYsYUFBYSxDQUFDLENBQUM7TUFDeEIrRixNQUFNLEdBQUcsRUFBRTtJQUVYVCxNQUFNLENBQUMsS0FBSyxDQUFDLEdBQUdRLFVBQVU7SUFDMUIsS0FBS0UsR0FBRyxJQUFJVixNQUFNLEVBQUM7TUFDakJTLE1BQU0sQ0FBQ25CLElBQUksQ0FBQ29CLEdBQUcsR0FBRyxHQUFHLEdBQUdWLE1BQU0sQ0FBQ1UsR0FBRyxDQUFDLENBQUM7SUFDdEM7SUFDQTNELE1BQU0sQ0FBQ25DLFFBQVEsQ0FBQ0MsTUFBTSxHQUFHNEYsTUFBTSxDQUFDRSxJQUFJLENBQUMsR0FBRyxDQUFDO0VBQzdDLENBQUMsQ0FBQztFQUVGcEgsQ0FBQyxDQUFDLE1BQU0sQ0FBQyxDQUFDcUMsRUFBRSxDQUFDLE9BQU8sRUFBRSw0QkFBNEIsRUFBRSxZQUFVO0lBQzVELElBQUlqQixJQUFJLEdBQUdwQixDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNvQixJQUFJLENBQUMsTUFBTSxDQUFDO0lBQy9CcEIsQ0FBQyxDQUFDLHFCQUFxQixDQUFDLENBQUNxSCxJQUFJLENBQUMsWUFBWSxHQUFHakcsSUFBSSxHQUFHLHNCQUFzQixDQUFDO0VBQzdFLENBQUMsQ0FBQztFQUVGcEIsQ0FBQyxDQUFDLGFBQWEsQ0FBQyxDQUFDQyxVQUFVLENBQUMsQ0FBQztBQUcvQixDQUFDLENBQUM7QUFFRixTQUFTcUgsYUFBYUEsQ0FBQ0MsTUFBTSxFQUFDO0VBRTdCLElBQUlDLFNBQVMsR0FBR3hILENBQUMsQ0FBQyxVQUFVLENBQUM7RUFDN0IsSUFBR3VILE1BQU0sSUFBSSxJQUFJLEVBQUM7SUFDakJDLFNBQVMsQ0FBQ0MsSUFBSSxDQUFDLFVBQVUsQ0FBQyxDQUFDdkQsSUFBSSxDQUFDLFVBQVN4QyxDQUFDLEVBQUVnRyxXQUFXLEVBQUM7TUFDdkQsSUFBSUMsWUFBWSxHQUFHM0gsQ0FBQyxDQUFDMEgsV0FBVyxDQUFDO01BQ2pDRixTQUFTLENBQUNuRCxNQUFNLENBQ2ZzRCxZQUFZLENBQUNsRixXQUFXLENBQUMsU0FBUyxDQUNuQyxDQUFDO0lBQ0YsQ0FBQyxDQUFDO0lBQ0YrRSxTQUFTLENBQUNDLElBQUksQ0FBQyxtQkFBbUIsQ0FBQyxDQUFDRyxNQUFNLENBQUMsQ0FBQztFQUM3QztFQUVBLElBQUlDLGNBQWMsR0FBR0wsU0FBUyxDQUFDTSxRQUFRLENBQUMsSUFBSSxDQUFDO0VBQzdDLElBQUlDLGdCQUFnQixHQUFHUCxTQUFTLENBQUN2RSxLQUFLLENBQUMsQ0FBQyxHQUFHLEdBQUc7RUFDOUMsSUFBSStFLFdBQVcsR0FBR2hJLENBQUMsQ0FBQ3dELE1BQU0sQ0FBQyxDQUFDUCxLQUFLLENBQUMsQ0FBQyxHQUFHLEdBQUc7RUFDekMsSUFBSWdGLGlCQUFpQixHQUFHLENBQUM7RUFFeEJKLGNBQWMsQ0FBQzNELElBQUksQ0FBQyxVQUFTeEMsQ0FBQyxFQUFFZ0csV0FBVyxFQUFDO0lBQzNDLElBQUlDLFlBQVksR0FBRzNILENBQUMsQ0FBQzBILFdBQVcsQ0FBQztJQUNqQ08saUJBQWlCLElBQUlOLFlBQVksQ0FBQ08sVUFBVSxDQUFDLElBQUksQ0FBQztJQUVsRCxJQUFHRCxpQkFBaUIsR0FBR0QsV0FBVyxFQUFDO01BQ2xDTCxZQUFZLENBQUNuQyxRQUFRLENBQUMsU0FBUyxDQUFDO0lBQ2pDO0VBQ0QsQ0FBQyxDQUFDO0VBQ0YsSUFBSTJDLGFBQWEsR0FBR1gsU0FBUyxDQUFDQyxJQUFJLENBQUMsVUFBVSxDQUFDO0VBQzlDLElBQUdVLGFBQWEsQ0FBQ3hHLE1BQU0sR0FBRyxDQUFDLEVBQUM7SUFDM0IsSUFBSXlHLGlCQUFpQixHQUFHcEksQ0FBQyxDQUFDLE9BQU8sQ0FBQyxDQUFDd0YsUUFBUSxDQUFDLGtCQUFrQixDQUFDO0lBQy9ELElBQUk2QyxpQkFBaUIsR0FBR3JJLENBQUMsQ0FBQyxPQUFPLENBQUMsQ0FBQ3dGLFFBQVEsQ0FBQyxrQkFBa0IsQ0FBQyxDQUFDbkIsTUFBTSxDQUFDckUsQ0FBQyw0TUFJOUQsQ0FBQyxDQUFDO0lBQ1ptSSxhQUFhLENBQUNqRSxJQUFJLENBQUMsVUFBU3hDLENBQUMsRUFBRWdHLFdBQVcsRUFBQztNQUMxQyxJQUFJQyxZQUFZLEdBQUczSCxDQUFDLENBQUMwSCxXQUFXLENBQUM7TUFDakNVLGlCQUFpQixDQUFDL0QsTUFBTSxDQUN2QnNELFlBQ0QsQ0FBQztJQUNGLENBQUMsQ0FBQztJQUNGSCxTQUFTLENBQUNuRCxNQUFNLENBQUNnRSxpQkFBaUIsQ0FBQ2hFLE1BQU0sQ0FBQytELGlCQUFpQixDQUFDLENBQUM7SUFDN0Q7QUFDSDtBQUNBO0lBQ0dwSSxDQUFDLENBQUMsb0JBQW9CLENBQUMsQ0FBQzJDLFNBQVMsQ0FBQyxZQUFVO01BQzNDM0MsQ0FBQyxDQUFDLG1CQUFtQixDQUFDLENBQUM0QyxJQUFJLENBQUMsQ0FBQztJQUM5QixDQUFDLENBQUM7RUFDSDtFQUVBLElBQUkwRixtQkFBbUIsR0FBRyxZQUFZO0VBQ3RDLElBQUlDLG1CQUFtQixHQUFHLG9CQUFvQjtFQUM5QyxJQUFJQyxtQkFBbUIsR0FBRyxhQUFhO0VBQ3ZDLElBQUlDLGlCQUFpQixHQUFJLE1BQU07RUFDL0IsSUFBSUMsUUFBUSxHQUFHLFlBQVk7RUFDM0IsSUFBSUMsUUFBUSxHQUFHLFVBQVU7RUFDekIsSUFBSUMsUUFBUSxHQUFHLFFBQVE7RUFDdkIsSUFBSUMsTUFBTSxHQUFJLE1BQU07RUFFcEIsSUFBSUMsTUFBTSxHQUFHOUksQ0FBQyxDQUFDLEdBQUcsR0FBRzJJLFFBQVEsQ0FBQztFQUM5QixJQUFJSSxRQUFRLEdBQUdELE1BQU0sQ0FBQ2hCLFFBQVEsQ0FBQyxHQUFHLEdBQUdjLFFBQVEsQ0FBQztFQUU5QyxJQUFJSSxTQUFTLEdBQUcsU0FBWkEsU0FBU0EsQ0FBQSxFQUFhO0lBRXpCLElBQUlDLE1BQU0sR0FBR2pKLENBQUMsQ0FBQyxJQUFJLENBQUM7SUFDcEIsSUFBRyxDQUFDaUosTUFBTSxDQUFDQyxRQUFRLENBQUMsU0FBUyxDQUFDLEVBQUM7TUFFOUJDLHdCQUF3QixHQUFHQyxVQUFVLENBQUMsWUFBVTtRQUMvQyxJQUFHSCxNQUFNLENBQUNJLEVBQUUsQ0FBQyxRQUFRLENBQUMsRUFBQztVQUN0QkMsWUFBWSxDQUFDSCx3QkFBd0IsQ0FBQztVQUN0Q0ksbUJBQW1CLENBQUM5RyxXQUFXLENBQUM2RixtQkFBbUIsQ0FBQyxDQUFDYixJQUFJLENBQUMsR0FBRyxHQUFHZ0IsaUJBQWlCLENBQUMsQ0FBQy9GLElBQUksQ0FBQyxDQUFDO1VBQ3pGcUcsUUFBUSxDQUFDdEcsV0FBVyxDQUFDaUcsUUFBUSxDQUFDLENBQUNqQixJQUFJLENBQUMsR0FBRyxHQUFHb0IsTUFBTSxDQUFDLENBQUNuRyxJQUFJLENBQUMsQ0FBQztVQUN4RHVHLE1BQU0sQ0FBQ3pELFFBQVEsQ0FBQ2tELFFBQVEsQ0FBQyxDQUFDakIsSUFBSSxDQUFDLEdBQUcsR0FBR29CLE1BQU0sQ0FBQyxDQUFDbkMsR0FBRyxDQUFDLFNBQVMsRUFBRSxPQUFPLENBQUM7VUFDcEUsT0FBTzRDLFlBQVksQ0FBQ0UsZUFBZSxDQUFDO1FBQ3JDO01BQ0QsQ0FBQyxFQUFFLEdBQUcsQ0FBQztJQUVUO0VBRUQsQ0FBQztFQUVELElBQUlDLFVBQVUsR0FBRyxTQUFiQSxVQUFVQSxDQUFBLEVBQWE7SUFDMUIsSUFBSUMsYUFBYSxHQUFHMUosQ0FBQyxDQUFDLElBQUksQ0FBQztJQUMzQndKLGVBQWUsR0FBR0osVUFBVSxDQUFDLFlBQVU7TUFDdENNLGFBQWEsQ0FBQ2pILFdBQVcsQ0FBQ2lHLFFBQVEsQ0FBQyxDQUFDakIsSUFBSSxDQUFDLEdBQUcsR0FBR29CLE1BQU0sQ0FBQyxDQUFDbkcsSUFBSSxDQUFDLENBQUM7SUFDOUQsQ0FBQyxFQUFFLEdBQUcsQ0FBQztFQUNSLENBQUM7RUFFRHFHLFFBQVEsQ0FBQ1ksS0FBSyxDQUFDWCxTQUFTLEVBQUVTLFVBQVUsQ0FBQztBQUN0QztBQUVBekosQ0FBQyxDQUFDd0QsTUFBTSxDQUFDLENBQUNuQixFQUFFLENBQUMsUUFBUSxFQUFFLFlBQVU7RUFDaENpRixhQUFhLENBQUMsSUFBSSxDQUFDO0FBQ3BCLENBQUMsQ0FBQztBQUVGdEgsQ0FBQyxDQUFDOEUsUUFBUSxDQUFDLENBQUM4RSxLQUFLLENBQUMsVUFBU3RILEtBQUssRUFBQztFQUNoQ2dGLGFBQWEsQ0FBQyxLQUFLLENBQUM7QUFDckIsQ0FBQyxDQUFDO0FBR0Z4QyxRQUFRLENBQUMrRSxnQkFBZ0IsQ0FBQyxrQkFBa0IsRUFBRSxZQUFNO0VBRWhELElBQU1DLE9BQU8sR0FBRyxTQUFWQSxPQUFPQSxDQUFBQyxJQUFBLEVBQW1CO0lBQUEsSUFBYkMsTUFBTSxHQUFBRCxJQUFBLENBQU5DLE1BQU07SUFDckIsSUFBTUMsS0FBSyxHQUFJRCxNQUFNLENBQUNFLE9BQU8sQ0FBQ0QsS0FBSyxHQUFHLEVBQUVELE1BQU0sQ0FBQ0UsT0FBTyxDQUFDRCxLQUFLLElBQUksQ0FBQyxDQUFDLENBQUU7SUFDcEUsSUFBTUUsS0FBSyxHQUFHQyxrQkFBQSxDQUFJSixNQUFNLENBQUNLLFVBQVUsQ0FBQ0MsS0FBSyxFQUFFQyxPQUFPLENBQUNQLE1BQU0sQ0FBQztJQUMxRCxJQUFNUSxRQUFRLEdBQUcsSUFBSUMsSUFBSSxDQUFDQyxRQUFRLENBQUMsQ0FBQyxJQUFJLEVBQUUsSUFBSSxDQUFDLEVBQUU7TUFBRUMsT0FBTyxFQUFFO0lBQUssQ0FBQyxDQUFDO0lBQ25FLElBQU1DLFVBQVUsR0FBRyxTQUFiQSxVQUFVQSxDQUFJVCxLQUFLLEVBQUVGLEtBQUs7TUFBQSxPQUFLLFVBQUNZLENBQUMsRUFBRUMsQ0FBQztRQUFBLE9BQUtiLEtBQUssR0FBR08sUUFBUSxDQUFDTyxPQUFPLENBQ25FRCxDQUFDLENBQUNoRCxRQUFRLENBQUNxQyxLQUFLLENBQUMsQ0FBQ2EsU0FBUyxFQUMzQkgsQ0FBQyxDQUFDL0MsUUFBUSxDQUFDcUMsS0FBSyxDQUFDLENBQUNhLFNBQ3RCLENBQUM7TUFBQTtJQUFBO0lBQUMsSUFBQUMsU0FBQSxHQUFBQywwQkFBQSxDQUVpQmxCLE1BQU0sQ0FBQ21CLE9BQU8sQ0FBQyxPQUFPLENBQUMsQ0FBQ0MsT0FBTztNQUFBQyxLQUFBO0lBQUE7TUFBbEQsS0FBQUosU0FBQSxDQUFBSyxDQUFBLE1BQUFELEtBQUEsR0FBQUosU0FBQSxDQUFBTSxDQUFBLElBQUFDLElBQUEsR0FDSTtRQUFBLElBRE1DLEtBQUssR0FBQUosS0FBQSxDQUFBMUgsS0FBQTtRQUNYOEgsS0FBSyxDQUFDcEgsTUFBTSxDQUFBcUgsS0FBQSxDQUFaRCxLQUFLLEVBQUFyQixrQkFBQSxDQUFXQSxrQkFBQSxDQUFJcUIsS0FBSyxDQUFDRSxJQUFJLEVBQUVDLElBQUksQ0FBQ2hCLFVBQVUsQ0FBQ1QsS0FBSyxFQUFFRixLQUFLLENBQUMsQ0FBQyxFQUFDO01BQUE7SUFBQyxTQUFBNEIsR0FBQTtNQUFBWixTQUFBLENBQUFhLENBQUEsQ0FBQUQsR0FBQTtJQUFBO01BQUFaLFNBQUEsQ0FBQWMsQ0FBQTtJQUFBO0lBQUEsSUFBQUMsVUFBQSxHQUFBZCwwQkFBQSxDQUVsRGxCLE1BQU0sQ0FBQ0ssVUFBVSxDQUFDQyxLQUFLO01BQUEyQixNQUFBO0lBQUE7TUFBekMsS0FBQUQsVUFBQSxDQUFBVixDQUFBLE1BQUFXLE1BQUEsR0FBQUQsVUFBQSxDQUFBVCxDQUFBLElBQUFDLElBQUEsR0FDSTtRQUFBLElBRE1VLElBQUksR0FBQUQsTUFBQSxDQUFBdEksS0FBQTtRQUNWdUksSUFBSSxDQUFDQyxTQUFTLENBQUNDLE1BQU0sQ0FBQyxRQUFRLEVBQUVGLElBQUksS0FBS2xDLE1BQU0sQ0FBQztNQUFBO0lBQUMsU0FBQTZCLEdBQUE7TUFBQUcsVUFBQSxDQUFBRixDQUFBLENBQUFELEdBQUE7SUFBQTtNQUFBRyxVQUFBLENBQUFELENBQUE7SUFBQTtFQUN6RCxDQUFDO0VBQ0gsSUFBTU0sS0FBSyxHQUFHdkgsUUFBUSxDQUFDd0gsZ0JBQWdCLENBQUMsc0JBQXNCLENBQUMsQ0FBQyxDQUFDLENBQUM7RUFDbEU7RUFDQSxJQUFHRCxLQUFLLElBQUkxRixTQUFTLEVBQ2xCMEYsS0FBSyxDQUFDeEMsZ0JBQWdCLENBQUMsT0FBTyxFQUFFO0lBQUEsT0FBTUMsT0FBTyxDQUFDeEgsS0FBSyxDQUFDO0VBQUEsRUFBQztBQUUxRCxDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvc2VhcmNoLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIiQuZGF0ZXBpY2tlci5yZWdpb25hbFsncnUnXSA9IHtcblx0Y2xvc2VUZXh0OiAn0JfQsNC60YDRi9GC0YwnLFxuXHRwcmV2VGV4dDogJ9Cf0YDQtdC00YvQtNGD0YnQuNC5Jyxcblx0bmV4dFRleHQ6ICfQodC70LXQtNGD0Y7RidC40LknLFxuXHRjdXJyZW50VGV4dDogJ9Ch0LXQs9C+0LTQvdGPJyxcblx0bW9udGhOYW1lczogWyfQr9C90LLQsNGA0YwnLCfQpNC10LLRgNCw0LvRjCcsJ9Cc0LDRgNGCJywn0JDQv9GA0LXQu9GMJywn0JzQsNC5Jywn0JjRjtC90YwnLCfQmNGO0LvRjCcsJ9CQ0LLQs9GD0YHRgicsJ9Ch0LXQvdGC0Y/QsdGA0YwnLCfQntC60YLRj9Cx0YDRjCcsJ9Cd0L7Rj9Cx0YDRjCcsJ9CU0LXQutCw0LHRgNGMJ10sXG5cdG1vbnRoTmFtZXNTaG9ydDogWyfQr9C90LInLCfQpNC10LInLCfQnNCw0YAnLCfQkNC/0YAnLCfQnNCw0LknLCfQmNGO0L0nLCfQmNGO0LsnLCfQkNCy0LMnLCfQodC10L0nLCfQntC60YInLCfQndC+0Y8nLCfQlNC10LonXSxcblx0ZGF5TmFtZXM6IFsn0LLQvtGB0LrRgNC10YHQtdC90YzQtScsJ9C/0L7QvdC10LTQtdC70YzQvdC40LonLCfQstGC0L7RgNC90LjQuicsJ9GB0YDQtdC00LAnLCfRh9C10YLQstC10YDQsycsJ9C/0Y/RgtC90LjRhtCwJywn0YHRg9Cx0LHQvtGC0LAnXSxcblx0ZGF5TmFtZXNTaG9ydDogWyfQstGB0LonLCfQv9C90LQnLCfQstGC0YAnLCfRgdGA0LQnLCfRh9GC0LInLCfQv9GC0L0nLCfRgdCx0YInXSxcblx0ZGF5TmFtZXNNaW46IFsn0JLRgScsJ9Cf0L0nLCfQktGCJywn0KHRgCcsJ9Cn0YInLCfQn9GCJywn0KHQsSddLFxuXHR3ZWVrSGVhZGVyOiAn0J3QtScsXG5cdGRhdGVGb3JtYXQ6ICdkZC5tbS55eScsXG5cdGZpcnN0RGF5OiAxLFxuXHRpc1JUTDogZmFsc2UsXG5cdHNob3dNb250aEFmdGVyWWVhcjogZmFsc2UsXG5cdHllYXJTdWZmaXg6ICcnXG59O1xuXG4kLmRhdGVwaWNrZXIuc2V0RGVmYXVsdHMoJC5kYXRlcGlja2VyLnJlZ2lvbmFsWydydSddKTtcblxuZnVuY3Rpb24gcGFyc2VVcmxRdWVyeSgpIHtcbiAgICB2YXIgZGF0YSA9IHt9O1xuICAgIGlmKGxvY2F0aW9uLnNlYXJjaCkge1xuICAgICAgICB2YXIgcGFpciA9IChsb2NhdGlvbi5zZWFyY2guc3Vic3RyKDEpKS5zcGxpdCgnJicpO1xuICAgICAgICBmb3IodmFyIGkgPSAwOyBpIDwgcGFpci5sZW5ndGg7IGkgKyspIHtcbiAgICAgICAgICAgIHZhciBwYXJhbSA9IHBhaXJbaV0uc3BsaXQoJz0nKTtcbiAgICAgICAgICAgIGRhdGFbcGFyYW1bMF1dID0gcGFyYW1bMV07XG4gICAgICAgIH1cbiAgICB9XG4gICAgcmV0dXJuIGRhdGE7XG59XG5cbmZ1bmN0aW9uIHNjcm9sbFRvQmxvY2sodG8sIHNwZWVkLCBvZmZzZXQpIHtcbiAgaWYgKHR5cGVvZiB0byA9PT0gJ3N0cmluZycpIHRvID0gJCh0byk7XG4gIGlmICghdG9bMF0pIHJldHVybjtcbiAgb2Zmc2V0ID0gb2Zmc2V0IHx8IDcyO1xuICBzcGVlZCA9IHNwZWVkIHx8IDEwMDA7XG4gICQoJ2h0bWwsIGJvZHknKS5zdG9wKCkuYW5pbWF0ZSh7XG4gICAgc2Nyb2xsVG9wOiB0by5vZmZzZXQoKS50b3AgLSBvZmZzZXRcbiAgfSwgc3BlZWQpO1xufVxuXG4gICQoZnVuY3Rpb24oKXtcbiAgICAkKCcubWVudS10cmlnZ2VyJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZXZlbnQpIHtcbiAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAkKCcucGFuZWwtYm94JykudG9nZ2xlQ2xhc3MoJ29wZW4nKTtcbiAgICAgICQoJyNuYXZiYXItY29sbGFwc2UtMScpLnJlbW92ZUNsYXNzKCdpbicpO1xuICAgIH0pO1xuICAgIFxuICAgICQoJyNtZW51Q2hhbXAnKS5oaWRlKCk7XG4gICAgJCgnI2NoYW1wJykubW91c2VvdmVyKGZ1bmN0aW9uKCkge1xuICAgICAgICAkKCcjbWVudUNoYW1wJykuc2hvdygpO1xuICAgIH0pLm1vdXNlb3V0KGZ1bmN0aW9uKCkge1xuICAgICAgICAkKCcjbWVudUNoYW1wJykuaGlkZSgpO1xuICAgIH0pO1xuXG5cdFx0JChcInNlbGVjdFwiKS5jaG9zZW4oe1xuXHRcdFx0bm9fcmVzdWx0c190ZXh0OiBcItCd0LUg0L3QsNGI0LvQvtGB0YxcIixcblx0XHRcdHNlYXJjaF9jb250YWluczogdHJ1ZSxcblx0XHRcdHdpZHRoOiAnMTgwcHgnXG5cdFx0fSk7XG5cblx0XHQkKCcuc2Nyb2xsLXRvLWJ0bicpLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcblx0XHQgIHZhciB0byA9ICQodGhpcykuYXR0cignaHJlZicpIHx8ICQodGhpcykuZGF0YSgnaHJlZicpO1xuXHRcdCAgc2Nyb2xsVG9CbG9jayh0byk7XG5cdFx0ICByZXR1cm4gZmFsc2U7XG5cdFx0fSk7XG5cblx0XHQkKFwic2VsZWN0W25hbWU9dGVhbXNdXCIpLmNoYW5nZShmdW5jdGlvbigpe1xuXHRcdFx0dmFyIHVybCA9IFJvdXRpbmcuZ2VuZXJhdGUoJ3BsYXllcicsIHtcblx0XHRcdFx0J3RlYW0nOiAkKHRoaXMpLnZhbCgpLCAnY291bnRyeSc6ICQodGhpcykuZGF0YSgnY291bnRyeScpXG5cdFx0XHR9KTtcblx0XHRcdHdpbmRvdy5sb2NhdGlvbi5ocmVmID0gdXJsO1xuXHRcdH0pO1xuXG5cdFx0JChcInNlbGVjdFtuYW1lPWNvdW50cnldW3BsYWNlaG9sZGVyPdCh0YLRgNCw0L3QsF1cIikuY2hhbmdlKGZ1bmN0aW9uKCl7XG5cdFx0XHR2YXIgdXJsID0gUm91dGluZy5nZW5lcmF0ZSgncGxheWVyJywge1xuXHRcdFx0XHQnY291bnRyeSc6ICQodGhpcykudmFsKCksICd0ZWFtJzogJCh0aGlzKS5kYXRhKCd0ZWFtJylcblx0XHRcdH0pO1xuXHRcdFx0d2luZG93LmxvY2F0aW9uLmhyZWYgPSB1cmw7XG5cdFx0fSk7XG4gICAgJChcInNlbGVjdFtuYW1lPWNvdW50cnldW3BsYWNlaG9sZGVyPdCT0YDQsNC20LTQsNC90YHRgtCy0L5dXCIpLmNoYW5nZShmdW5jdGlvbigpe1xuXHRcdFx0dmFyIHVybCA9IFJvdXRpbmcuZ2VuZXJhdGUoJ3BsYXllcl9hbGwnLCB7XG5cdFx0XHRcdCdjb3VudHJ5JzogJCh0aGlzKS52YWwoKSwgJ3RlYW0nOiAkKHRoaXMpLmRhdGEoJ3RlYW0nKVxuXHRcdFx0fSk7XG5cdFx0XHR3aW5kb3cubG9jYXRpb24uaHJlZiA9IHVybDtcblx0XHR9KTtcblxuICAgIC8v0JbQuNCy0L7QuSDQv9C+0LjRgdC6XG4gIFx0JCgnLnNlYXJjaF9rZXl3b3JkcycpLmJpbmQoXCJrZXl1cFwiLCBmdW5jdGlvbigpIHtcbiAgICAgIGlmKHRoaXMudmFsdWUubGVuZ3RoID49IDEpe1xuICAgICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICAgIHR5cGU6ICdwb3N0JyxcbiAgICAgICAgICAgICAgdXJsOiBSb3V0aW5nLmdlbmVyYXRlKCduZXdzX3NlYXJjaCcpLFxuICAgICAgICAgICAgICBkYXRhOiB7cXVlcnk6IHRoaXMudmFsdWV9LFxuICAgICAgICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhKXtcbiAgICAgICAgICAgICAgICAgICQoXCIuc2VhcmNoX3Jlc3VsdF9pdGVtc1wiKS5lbXB0eSgpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICAgIGlmKGRhdGEpe1xuICAgICAgICAgICAgICAgICAgICAgICQoXCIuc2VhcmNoX3Jlc3VsdCwgLnNlYXJjaF9yZXN1bHRfaXRlbXNcIikuc2hvdygpO1xuICAgICAgICAgICAgICAgICAgICAgICQuZWFjaChkYXRhLCBmdW5jdGlvbih0cmFuc2xpdCwgbmFtZSl7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICQoXCIuc2VhcmNoX3Jlc3VsdF9pdGVtc1wiKVxuICAgICAgICAgICAgICAgICAgICAgICAgICAuYXBwZW5kKFwiPGEgaHJlZj0nL1wiK3RyYW5zbGl0K1wiJz5cIituYW1lK1wiPC9hPlwiKTtcblxuICAgICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICAgICQoXCJib2R5XCIpLm5vdChcIi5zZWFyY2gtdG9wXCIpLmNsaWNrKGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgICAgICAgICAkKFwiLnNlYXJjaF9yZXN1bHQsIC5zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgICAgJChcIi5zZWFyY2hfcmVzdWx0LCAuc2VhcmNoX3Jlc3VsdF9pdGVtc1wiKS5oaWRlKCk7XG4gICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyhkYXRhKTtcbiAgICAgICAgICAgICB9LFxuICAgICAgIGVycm9yOiBmdW5jdGlvbiAoeGhyLCBhamF4T3B0aW9ucywgdGhyb3duRXJyb3IpIHtcbiAgICAgICAgfVxuICAgICAgfSk7XG4gICAgICB9IGVsc2Uge1xuICAgICAgICAkKFwiLnNlYXJjaF9yZXN1bHQsIC5zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLmhpZGUoKTtcbiAgICAgIH1cbiAgfSk7XG5cbiAgJChkb2N1bWVudCkub24oXCJrZXl1cFwiLCAnI3J1c19wbGF5ZXInLCBmdW5jdGlvbigpIHtcbiAgICBpZih0aGlzLnZhbHVlLmxlbmd0aCA+PSAxKXtcbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgIHR5cGU6ICdwb3N0JyxcbiAgICAgICAgICAgIHVybDogUm91dGluZy5nZW5lcmF0ZSgnbmV3c19zZWFyY2gnKSxcbiAgICAgICAgICAgIGRhdGE6IHtxdWVyeTogdGhpcy52YWx1ZSwgZm9ybV9wbGF5ZXI6ICd5J30sXG4gICAgICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24oZGF0YSl7XG4gICAgICAgICAgICAgICAgJChcIi5wbGF5ZXJfc2VhcmNoX3Jlc3VsdF9pdGVtc1wiKS5lbXB0eSgpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICBpZihkYXRhKXtcbiAgICAgICAgICAgICAgICAgICAgJChcIi5wbGF5ZXJfc2VhcmNoX3Jlc3VsdCwgLnBsYXllcl9zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLnNob3coKTtcbiAgICAgICAgICAgICAgICAgICAgJC5lYWNoKGRhdGEsIGZ1bmN0aW9uKGlkLCBuYW1lKXtcbiAgICAgICAgICAgICAgICAgICAgICAgICQoXCIucGxheWVyX3NlYXJjaF9yZXN1bHRfaXRlbXNcIilcbiAgICAgICAgICAgICAgICAgICAgICAgIC5hcHBlbmQoXCI8ZGl2IGNsYXNzPVxcXCJwbGF5ZXJfZm9ybV9zZWFyY2hcXFwiIGRhdGEtaWQ9J1wiK2lkK1wiJz5cIituYW1lK1wiPC9kaXY+XCIpO1xuXG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICAkKFwiYm9keVwiKS5ub3QoXCIuc2VhcmNoLXRvcFwiKS5jbGljayhmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgICAgICAgICQoXCIucGxheWVyX3NlYXJjaF9yZXN1bHQsIC5wbGF5ZXJfc2VhcmNoX3Jlc3VsdF9pdGVtc1wiKS5oaWRlKCk7XG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICAkKGRvY3VtZW50KS5vbignY2xpY2snLCAnLnBsYXllcl9mb3JtX3NlYXJjaCcsIGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgICAgICAgJChcIiNydXNfcGxheWVyXCIpLnZhbCgkKHRoaXMpLnRleHQoKSk7XG4gICAgICAgICAgICAgICAgICAgICAgJChcIiNydXNfcGxheWVyX2hpZGRlblwiKS52YWwoJCh0aGlzKS5kYXRhKCdpZCcpKTtcbiAgICAgICAgICAgICAgICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgICAgICAgICAgICAgdHlwZTogJ3Bvc3QnLFxuICAgICAgICAgICAgICAgICAgICAgICAgdXJsOiBSb3V0aW5nLmdlbmVyYXRlKCdzZXNzaW9uX3BsYXllcl9hZGQnLCB7J2lkJzogJCh0aGlzKS5kYXRhKCdpZCcpfSksXG4gICAgICAgICAgICAgICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihyZXNwb25zZSl7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2cocmVzcG9uc2UpO1xuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgICAgJChcIi5wbGF5ZXJfc2VhcmNoX3Jlc3VsdCwgLnBsYXllcl9zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coZGF0YSk7XG4gICAgICAgICAgIH0sXG4gICAgIGVycm9yOiBmdW5jdGlvbiAoeGhyLCBhamF4T3B0aW9ucywgdGhyb3duRXJyb3IpIHtcbiAgICAgIH1cbiAgICB9KTtcbiAgICB9IGVsc2Uge1xuICAgICAgJChcIi5wbGF5ZXJfc2VhcmNoX3Jlc3VsdCwgLnBsYXllcl9zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLmhpZGUoKTtcbiAgICB9XG59KTtcblxuJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy50b3VyX2pzJywgZnVuY3Rpb24oKXtcbiAgbGV0ICR0aGlzID0gJCh0aGlzKTtcbiAgbGV0IHRvdXIgPSAkdGhpcy5kYXRhKCd0b3VyJyk7XG4gIGxldCBjb3VudHJ5ID0gJHRoaXMuZGF0YSgnY291bnRyeScpO1xuICBsZXQgc2Vhc29uID0gJHRoaXMuZGF0YSgnc2Vhc29uJyk7XG4gICQuYWpheCh7XG4gICAgdHlwZTogJ3Bvc3QnLFxuICAgIHVybDogUm91dGluZy5nZW5lcmF0ZSgnY2hhbXBpb25zaGlwc190b3VyJywgeyd0b3VyJzp0b3VyLCAnc2Vhc29uJzogc2Vhc29uLCAnY291bnRyeSc6IGNvdW50cnl9KSxcbiAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKHJlc3BvbnNlKXtcbiAgICAgICQoXCIuY2hhbXBzaGlwLXRhYmxlIHRib2R5XCIpLmh0bWwocmVzcG9uc2UucmVzcG9uc2UpO1xuICAgICAgJChcIi50b3VyX3RleHQgc3BhblwiKS50ZXh0KHRvdXIpO1xuICAgICAgJChcIi50b3VyX2pzXCIpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcbiAgICAgICR0aGlzLmFkZENsYXNzKCdhY3RpdmUnKTtcbiAgICAgIGhpc3RvcnkucHVzaFN0YXRlKG51bGwsICcnLCBSb3V0aW5nLmdlbmVyYXRlKCdjaGFtcGlvbnNoaXBzJywgeyd0b3VyJzp0b3VyLCAnc2Vhc29uJzogc2Vhc29uLCAnY291bnRyeSc6IGNvdW50cnl9KSlcbiAgICB9LFxuICAgIGVycm9yOiBmdW5jdGlvbiAoeGhyLCBhamF4T3B0aW9ucywgdGhyb3duRXJyb3IpIHtcbiAgICAgIGNvbnNvbGUubG9nKHhoci5zdGF0dXMpO1xuICAgICAgY29uc29sZS5sb2codGhyb3duRXJyb3IpO1xuICAgIH1cbn0pO1xufSk7XG5cbiAgJChcIiNzaGlwcGxheWVyc1VwZGF0ZVwiKS5jbGljayhmdW5jdGlvbigpe1xuICAgIHZhciBhckdhbWVzID0gW107XG5cdFx0dmFyIGNoYW1wID0gJCh0aGlzKS5kYXRhKCdjaGFtcCcpO1xuICAgICQoXCIuc2hpcHBsYXllci1pbnB1dFwiKS5lYWNoKGZ1bmN0aW9uKCl7XG4gICAgICB2YXIgZ2FtZSA9ICQodGhpcykudmFsKCk7XG4gICAgICBpZihnYW1lICE9IDApe1xuICAgICAgICBhckdhbWVzLnB1c2goW1xuICAgICAgICAgICQodGhpcykuZGF0YSgnaWQnKSxcbiAgICAgICAgICAkKHRoaXMpLmRhdGEoJ3BsYXllcicpLFxuICAgICAgICAgIHBhcnNlSW50KGdhbWUpXG4gICAgICAgIF0pO1xuICAgICAgfVxuICAgIH0pO1xuICAgIGNvbnNvbGUubG9nKGFyR2FtZXMpXG4gICAgJC5hamF4KHtcbiAgICAgICAgdHlwZTogJ3Bvc3QnLFxuICAgICAgICB1cmw6IFJvdXRpbmcuZ2VuZXJhdGUoJ3NoaXBwbGF5ZXJzX3VwZGF0ZScpLFxuICAgICAgICBkYXRhOiB7cXVlcnk6IGFyR2FtZXMsIGNoYW1wOiBjaGFtcH0sXG4gICAgICAgIGRhdGFUeXBlOiAnanNvbicsXG4gICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKHJlc3BvbnNlKXtcbiAgICAgICAgICBjb25zb2xlLmxvZyhyZXNwb25zZSlcbiAgICAgICAgICB2YXIgYXJyID0gSlNPTi5wYXJzZShyZXNwb25zZSk7XG4gICAgICAgICAgYXJyLmZvckVhY2goZnVuY3Rpb24oaXRlbSwgaSwgYXJyKSB7XG4gICAgICAgICAgICAkKFwiW2RhdGEtaWQ9XCIraXRlbVswXStcIl1bZGF0YS1wYXJhbT0nZ2FtZSddXCIpLnRleHQoaXRlbVsxXSk7XG4gICAgICAgICAgfSk7XG4gICAgICAgIH0sXG4gICAgICAgIGVycm9yOiBmdW5jdGlvbiAoeGhyLCBhamF4T3B0aW9ucywgdGhyb3duRXJyb3IpIHtcbiAgICAgICAgICBjb25zb2xlLmxvZyh4aHIuc3RhdHVzKTtcbiAgICAgICAgICBjb25zb2xlLmxvZyh0aHJvd25FcnJvcik7XG4gICAgICAgIH1cbiAgICB9KTtcbiAgfSk7XG5cbiAgJChcIi5jaGFuZ2VHYW1lR29hbFBsYXllclwiKS5jbGljayhmdW5jdGlvbigpe1xuICAgIHZhciBjaGFuZ2UgPSAkKHRoaXMpLmRhdGEoJ2NoYW5nZScpO1xuICAgIHZhciBpZCA9ICQodGhpcykuZGF0YSgnaWQnKTtcbiAgICB2YXIgc2Vhc29uID0gJCh0aGlzKS5kYXRhKCdzZWFzb24nKTtcbiAgICB2YXIgdGVhbSA9ICQodGhpcykuZGF0YSgndGVhbScpO1xuICAgIHZhciByb3V0ZSA9ICQodGhpcykuZGF0YSgncGF0aCcpO1xuXHRcdHZhciB0dXJuaXIgPSAkKHRoaXMpLmRhdGEoJ3R1cm5pcicpO1xuXHRcdHZhciAkdGhpcyA9ICQodGhpcyk7XG5cdFx0dmFyIHBhcmFtcyA9IHsnaWQnOiBpZCwgJ3NlYXNvbic6IHNlYXNvbiwgJ2NoYW5nZSc6IGNoYW5nZX07XG5cdFx0JChcIi5sb2FkaW5nW2RhdGEtaWQ9XCIraWQrXCJdXCIpLmNzcygnZGlzcGxheScsICdpbmxpbmUtYmxvY2snKTtcblx0XHRpZih0dXJuaXIgIT0gdW5kZWZpbmVkKXtcblx0XHRcdHBhcmFtc1sndHVybmlyJ10gPSB0dXJuaXI7XG5cdFx0fVxuXHRcdGlmKHJvdXRlICE9ICdwbGF5ZXJfZWRpdFNiJyl7XG5cdFx0XHRwYXJhbXNbJ3RlYW0nXSA9IHRlYW07XG5cdFx0fVxuICAgICQuYWpheCh7XG4gICAgICAgIHR5cGU6ICdwb3N0JyxcbiAgICAgICAgdXJsOiBSb3V0aW5nLmdlbmVyYXRlKHJvdXRlLCBwYXJhbXMpLFxuICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhKXtcblx0XHRcdFx0XHRjb25zb2xlLmxvZyhkYXRhKTtcbiAgICAgICAgICBjb25zb2xlLmxvZyhyb3V0ZSk7XG4gICAgICAgICAgICAkKFwiLnNwaXNraS5zZWxlY3RlZFwiKS5yZW1vdmVDbGFzcygnc2VsZWN0ZWQnKTtcbiAgICAgICAgICAgICQoXCIuc3Bpc2tpW2RhdGEtaWQ9XCIraWQrXCJdXCIpLmFkZENsYXNzKCdzZWxlY3RlZCcpO1xuXHRcdFx0XHRcdFx0aWYocm91dGUgPT0gJ3BsYXllcmFkbWluX2VkaXRDaGFtcFRvdGFsJyl7XG5cdFx0XHRcdFx0XHRcdCQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0ndG90YWxnYW1lJ11cIikudGV4dChkYXRhWydnYW1lJ10pO1xuICAgICAgICAgICAgXHQkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J3RvdGFsZ29hbCddXCIpLnRleHQoZGF0YVsnZ29hbCddKTtcblx0XHRcdFx0XHRcdH0gZWxzZSBpZihyb3V0ZSA9PSAncGxheWVyYWRtaW5fZWRpdE5hdGlvbkN1cCcpe1xuXHQgICAgICAgICAgICBcdCQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nY3VwJ11cIikudGV4dChkYXRhWydnb2FsJ10pO1xuXHRcdFx0XHRcdFx0fSBlbHNlIGlmKHJvdXRlID09ICdwbGF5ZXJhZG1pbl9lZGl0TmF0aW9uU3VwZXJjdXAnKXtcblx0XHRcdFx0XHRcdFx0XHQkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J3N1cGVyY3VwJ11cIikudGV4dChkYXRhWydnb2FsJ10pO1xuXHRcdFx0XHRcdFx0fSBlbHNlIGlmKHJvdXRlID09ICdwbGF5ZXJhZG1pbl9lZGl0TmF0aW9uRXVyb2N1cCcpe1xuXHRcdFx0XHRcdFx0XHRcdCQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nZXVyb2N1cCddXCIpLnRleHQoZGF0YVsnZ29hbCddKTtcblx0XHRcdFx0XHRcdH0gZWxzZSBpZihyb3V0ZSA9PSAncGxheWVyYWRtaW5fZWRpdE5hdGlvblNib3JuaWUnKXtcblx0XHRcdFx0XHRcdFx0XHQkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J3Nib3JuaWUnXVwiKS50ZXh0KGRhdGFbJ2dvYWwnXSk7XG5cdFx0XHRcdFx0XHR9IGVsc2Uge1xuICAgICAgICAgICAgICBjb25zb2xlLmxvZygkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J2dvYWxQbyddXCIpKVxuICAgICAgICAgICAgXHQkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J2dhbWUnXVwiKS50ZXh0KGRhdGFbJ2dhbWUnXSk7XG4gICAgICAgICAgICBcdCQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nZ29hbCddXCIpLnRleHQoZGF0YVsnZ29hbCddKTtcbiAgICAgICAgICAgICAgJChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSdnYW1lUG8nXVwiKS50ZXh0KGRhdGFbJ2dhbWVQbyddKTtcbiAgICAgICAgICAgIFx0JChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSdnb2FsUG8nXVwiKS50ZXh0KGRhdGFbJ2dvYWxQbyddKTtcblx0XHRcdFx0XHRcdH1cbiAgICAgICAgICAgICQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nYXNzaXN0J11cIikudGV4dChkYXRhWydhc3Npc3QnXSk7XG4gICAgICAgICAgICAkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J3Njb3JlJ11cIikudGV4dChkYXRhWydzY29yZSddKTtcbiAgICAgICAgICAgICQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nbWlzc2VkJ11cIikudGV4dChkYXRhWydtaXNzZWQnXSk7XG4gICAgICAgICAgICAkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J3plcm8nXVwiKS50ZXh0KGRhdGFbJ3plcm8nXSk7XG4gICAgICAgICAgICAkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J2Fzc2lzdFBvJ11cIikudGV4dChkYXRhWydhc3Npc3RQbyddKTtcbiAgICAgICAgICAgICQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nc2NvcmVQbyddXCIpLnRleHQoZGF0YVsnc2NvcmVQbyddKTtcbiAgICAgICAgICAgICQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nbWlzc2VkUG8nXVwiKS50ZXh0KGRhdGFbJ21pc3NlZFBvJ10pO1xuICAgICAgICAgICAgJChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSd6ZXJvUG8nXVwiKS50ZXh0KGRhdGFbJ3plcm9QbyddKTtcblx0XHRcdFx0XHRcdCQoXCIubG9hZGluZ1tkYXRhLWlkPVwiK2lkK1wiXVwiKS5oaWRlKCk7XG5cdFx0XHRcdFx0XHQkdGhpcy5hZGRDbGFzcygnY2hhbmdlZC1wbGF5ZXInKTtcbiAgICAgICAgfSxcbiAgICAgICAgZXJyb3I6IGZ1bmN0aW9uICh4aHIsIGFqYXhPcHRpb25zLCB0aHJvd25FcnJvcikge1xuICAgICAgICAgIGNvbnNvbGUubG9nKHhoci5zdGF0dXMpO1xuICAgICAgICAgIGNvbnNvbGUubG9nKHRocm93bkVycm9yKTtcbiAgICAgICAgfVxuICAgICAgfSk7XG4gIH0pO1xuXG4gICQoXCIubGV0dGVycy1saXN0IGxpXCIpLmNsaWNrKGZ1bmN0aW9uKCl7XG4gICAgdmFyIGxldHRlciA9ICQodGhpcykudGV4dCgpO1xuICAgICQuYWpheCh7XG4gICAgICAgIHR5cGU6ICdwb3N0JyxcbiAgICAgICAgdXJsOiBSb3V0aW5nLmdlbmVyYXRlKCd0ZWFtX2dldF9ieV9sZXR0ZXInLCB7J2xldHRlcic6bGV0dGVyfSksXG4gICAgICAgIGRhdGFUeXBlOiAnanNvbicsXG4gICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKGRhdGEpe1xuICAgICAgICAgICAgdmFyIG5ld0h0bWwgPSBcIlwiO1xuICAgICAgICAgICAgZm9yKHZhciBpPTAsIGNudD1kYXRhLnRlYW1zLmxlbmd0aDsgaSA8IGNudDsgaSsrKXtcbiAgICAgICAgICAgICAgdmFyIGRldGFpbFVybCA9IFJvdXRpbmcuZ2VuZXJhdGUoJ3RlYW1fc2hvdycsIHtcbiAgICAgICAgICAgICAgICAnY29kZSc6IGRhdGEudGVhbXNbaV1bMV19KTtcblxuICAgICAgICAgICAgICBuZXdIdG1sICs9IFwiPGxpPjxhIGhyZWY9J1wiKyBkZXRhaWxVcmwgK1wiJyBjbGFzcz0nc3Bpc2tpJz5cIlxuICAgICAgICAgICAgICAgICsgZGF0YS50ZWFtc1tpXVswXSArIFwiPC9hPjwvbGk+XCI7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICAkKFwiLmNsdWJzLWxpc3RcIikuaHRtbChuZXdIdG1sKTtcbiAgICAgICAgfSxcbiAgICAgICAgZXJyb3I6IGZ1bmN0aW9uICh4aHIsIGFqYXhPcHRpb25zLCB0aHJvd25FcnJvcikge1xuICAgICAgICAgIGNvbnNvbGUubG9nKHhoci5zdGF0dXMpO1xuICAgICAgICAgIGNvbnNvbGUubG9nKHRocm93bkVycm9yKTtcbiAgICAgICAgfVxuICAgICAgfSk7XG4gIH0pO1xuXG4gICQoXCIjc2VsZWN0UGFnZU1hdGNoZXNcIikuY2hhbmdlKGZ1bmN0aW9uKCl7XG4gICAgdmFyIG1heE1hdGNoZXMgPSAkKHRoaXMpLnZhbCgpLFxuICAgICAgcGFyYW1zID0gcGFyc2VVcmxRdWVyeSgpLFxuICAgICAgbmV3QXJyID0gW107XG5cbiAgICAgIHBhcmFtc1snbWF4J10gPSBtYXhNYXRjaGVzO1xuICAgICAgZm9yIChrZXkgaW4gcGFyYW1zKXtcbiAgICAgICAgbmV3QXJyLnB1c2goa2V5ICsgJz0nICsgcGFyYW1zW2tleV0pO1xuICAgICAgfVxuICAgICAgd2luZG93LmxvY2F0aW9uLnNlYXJjaCA9IG5ld0Fyci5qb2luKCcmJyk7XG4gIH0pO1xuXG4gICQoXCJib2R5XCIpLm9uKFwiY2xpY2tcIiwgXCIubmhsLWRhdGVzIHNwYW5bZGF0YS1kYXRlXVwiLCBmdW5jdGlvbigpe1xuICAgIHZhciBkYXRhID0gJCh0aGlzKS5kYXRhKCdkYXRlJyk7XG4gICAgJChcIi5uaGwtbWF0Y2hlcy5jaGFtcHNcIikubG9hZChcIi9uaGwvZGF0ZS9cIiArIGRhdGEgKyBcIiAubmhsLW1hdGNoZXMuY2hhbXBzXCIpO1xuICB9KTtcblxuICAkKFwiI2RhdGVwaWNrZXJcIikuZGF0ZXBpY2tlcigpO1xuXG5cbn0pO1xuXG5mdW5jdGlvbiBzbGljZU1haW5NZW51KHJlc2l6ZSl7XG5cblx0dmFyICRtYWluTWVudSA9ICQoXCIjc3ViTWVudVwiKTtcblx0aWYocmVzaXplID09IHRydWUpe1xuXHRcdCRtYWluTWVudS5maW5kKFwiLnJlbW92ZWRcIikuZWFjaChmdW5jdGlvbihpLCBuZXh0RWxlbWVudCl7XG5cdFx0XHR2YXIgJG5leHRFbGVtZW50ID0gJChuZXh0RWxlbWVudCk7XG5cdFx0XHQkbWFpbk1lbnUuYXBwZW5kKFxuXHRcdFx0XHQkbmV4dEVsZW1lbnQucmVtb3ZlQ2xhc3MoXCJyZW1vdmVkXCIpXG5cdFx0XHQpXG5cdFx0fSk7XG5cdFx0JG1haW5NZW51LmZpbmQoXCIucmVtb3ZlZEl0ZW1zTGlua1wiKS5yZW1vdmUoKTtcblx0fVxuXG5cdHZhciAkbWFpbk1lbnVJdGVtcyA9ICRtYWluTWVudS5jaGlsZHJlbihcImxpXCIpO1xuXHR2YXIgdmlzaWJsZU1lbnVXaWR0aCA9ICRtYWluTWVudS53aWR0aCgpIC0gMTAwO1xuXHR2YXIgd2luZG93V2lkdGggPSAkKHdpbmRvdykud2lkdGgoKSAtIDEyMDtcblx0dmFyIHRvdGFsU3VtTWVudVdpZHRoID0gMDtcblxuXHRcdCRtYWluTWVudUl0ZW1zLmVhY2goZnVuY3Rpb24oaSwgbmV4dEVsZW1lbnQpe1xuXHRcdFx0dmFyICRuZXh0RWxlbWVudCA9ICQobmV4dEVsZW1lbnQpO1xuXHRcdFx0dG90YWxTdW1NZW51V2lkdGggKz0gJG5leHRFbGVtZW50Lm91dGVyV2lkdGgodHJ1ZSk7XG5cblx0XHRcdGlmKHRvdGFsU3VtTWVudVdpZHRoID4gd2luZG93V2lkdGgpe1xuXHRcdFx0XHQkbmV4dEVsZW1lbnQuYWRkQ2xhc3MoXCJyZW1vdmVkXCIpO1xuXHRcdFx0fVxuXHRcdH0pO1xuXHRcdHZhciAkcmVtb3ZlZEl0ZW1zID0gJG1haW5NZW51LmZpbmQoXCIucmVtb3ZlZFwiKTtcblx0XHRpZigkcmVtb3ZlZEl0ZW1zLmxlbmd0aCA+IDApe1xuXHRcdFx0dmFyICRyZW1vdmVkSXRlbXNMaXN0ID0gJChcIjx1bC8+XCIpLmFkZENsYXNzKFwicmVtb3ZlZEl0ZW1zTGlzdFwiKTtcblx0XHRcdHZhciAkcmVtb3ZlZEl0ZW1zTGluayA9ICQoXCI8bGkvPlwiKS5hZGRDbGFzcyhcInJlbW92ZWRJdGVtc0xpbmtcIikuYXBwZW5kKCQoYDxidXR0b24gdHlwZT1cImJ1dHRvblwiIGNsYXNzPVwibmF2YmFyLXRvZ2dsZS1zdWJcIj5cblx0XHRcdFx0XHQ8c3BhbiBjbGFzcz1cImljb24tYmFyXCI+PC9zcGFuPlxuXHRcdFx0XHRcdDxzcGFuIGNsYXNzPVwiaWNvbi1iYXJcIj48L3NwYW4+XG5cdFx0XHRcdFx0PHNwYW4gY2xhc3M9XCJpY29uLWJhclwiPjwvc3Bhbj5cblx0XHRcdDwvYnV0dG9uPmApKTtcblx0XHRcdCRyZW1vdmVkSXRlbXMuZWFjaChmdW5jdGlvbihpLCBuZXh0RWxlbWVudCl7XG5cdFx0XHRcdHZhciAkbmV4dEVsZW1lbnQgPSAkKG5leHRFbGVtZW50KTtcblx0XHRcdFx0JHJlbW92ZWRJdGVtc0xpc3QuYXBwZW5kKFxuXHRcdFx0XHRcdCRuZXh0RWxlbWVudFxuXHRcdFx0XHQpXG5cdFx0XHR9KTtcblx0XHRcdCRtYWluTWVudS5hcHBlbmQoJHJlbW92ZWRJdGVtc0xpbmsuYXBwZW5kKCRyZW1vdmVkSXRlbXNMaXN0KSk7XG5cdFx0XHQvKiRyZW1vdmVkSXRlbXNMaXN0LmNzcyh7XG5cdFx0XHRcdGxlZnQ6ICRyZW1vdmVkSXRlbXNMaW5rLm9mZnNldCgpLmxlZnQgKyBcInB4XCJcblx0XHRcdH0pOyovXG5cdFx0XHQkKFwiLm5hdmJhci10b2dnbGUtc3ViXCIpLm1vdXNlb3ZlcihmdW5jdGlvbigpe1xuXHRcdFx0XHQkKFwiLnJlbW92ZWRJdGVtc0xpc3RcIikuc2hvdygpO1xuXHRcdFx0fSk7XG5cdFx0fVxuXG5cdFx0dmFyIF9fc2VjdGlvbk1lbnVBY3RpdmUgPSBcImFjdGl2ZURyb3BcIjtcblx0XHR2YXIgX19zZWN0aW9uTWVudU1lbnVJRCA9IFwibWVudUNhdGFsb2dTZWN0aW9uXCI7XG5cdFx0dmFyIF9fc2VjdGlvbk1lbnVPcGVuZXIgPSBcIm1lbnVTZWN0aW9uXCI7XG5cdFx0dmFyIF9fc2VjdGlvbk1lbnVEcm9wXHQgPSBcImRyb3BcIjtcblx0XHR2YXIgX19hY3RpdmUgPSBcImFjdGl2ZURyb3BcIjtcblx0XHR2YXIgX19tZW51SUQgPSBcIm1haW5NZW51XCI7XG5cdFx0dmFyIF9fb3BlbmVyID0gXCJlQ2hpbGRcIjtcblx0XHR2YXIgX19kcm9wXHQgPSBcImRyb3BcIjtcblxuXHRcdHZhciAkX3NlbGYgPSAkKFwiI1wiICsgX19tZW51SUQpO1xuXHRcdHZhciAkX2VDaGlsZCA9ICRfc2VsZi5jaGlsZHJlbihcIi5cIiArIF9fb3BlbmVyKTtcblxuXHRcdHZhciBvcGVuQ2hpbGQgPSBmdW5jdGlvbigpe1xuXG5cdFx0XHR2YXIgJF90aGlzID0gJCh0aGlzKTtcblx0XHRcdGlmKCEkX3RoaXMuaGFzQ2xhc3MoXCJyZW1vdmVkXCIpKXtcblxuXHRcdFx0XHRfX21lbnVGaXJzdE9wZW5UaW1lb3V0SUQgPSBzZXRUaW1lb3V0KGZ1bmN0aW9uKCl7XG5cdFx0XHRcdFx0aWYoJF90aGlzLmlzKFwiOmhvdmVyXCIpKXtcblx0XHRcdFx0XHRcdGNsZWFyVGltZW91dChfX21lbnVGaXJzdE9wZW5UaW1lb3V0SUQpO1xuXHRcdFx0XHRcdFx0JF9zZWN0aW9uTWVudUVDaGlsZC5yZW1vdmVDbGFzcyhfX3NlY3Rpb25NZW51QWN0aXZlKS5maW5kKFwiLlwiICsgX19zZWN0aW9uTWVudURyb3ApLmhpZGUoKTtcblx0XHRcdFx0XHRcdCRfZUNoaWxkLnJlbW92ZUNsYXNzKF9fYWN0aXZlKS5maW5kKFwiLlwiICsgX19kcm9wKS5oaWRlKCk7XG5cdFx0XHRcdFx0XHQkX3RoaXMuYWRkQ2xhc3MoX19hY3RpdmUpLmZpbmQoXCIuXCIgKyBfX2Ryb3ApLmNzcyhcImRpc3BsYXlcIiwgXCJ0YWJsZVwiKTtcblx0XHRcdFx0XHRcdHJldHVybiBjbGVhclRpbWVvdXQoX19tZW51VGltZW91dElEKTtcblx0XHRcdFx0XHR9XG5cdFx0XHRcdH0sIDMwMCk7XG5cblx0XHR9XG5cblx0fVxuXG5cdHZhciBjbG9zZUNoaWxkID0gZnVuY3Rpb24oKXtcblx0XHR2YXIgJF9jYXB0dXJlVGhpcyA9ICQodGhpcyk7XG5cdFx0X19tZW51VGltZW91dElEID0gc2V0VGltZW91dChmdW5jdGlvbigpe1xuXHRcdFx0JF9jYXB0dXJlVGhpcy5yZW1vdmVDbGFzcyhfX2FjdGl2ZSkuZmluZChcIi5cIiArIF9fZHJvcCkuaGlkZSgpO1xuXHRcdH0sIDUwMCk7XG5cdH1cblxuXHQkX2VDaGlsZC5ob3ZlcihvcGVuQ2hpbGQsIGNsb3NlQ2hpbGQpO1xufVxuXG4kKHdpbmRvdykub24oXCJyZXNpemVcIiwgZnVuY3Rpb24oKXtcblx0c2xpY2VNYWluTWVudSh0cnVlKTtcbn0pO1xuXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbihldmVudCl7XG5cdHNsaWNlTWFpbk1lbnUoZmFsc2UpO1xufSk7XG5cblxuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignRE9NQ29udGVudExvYWRlZCcsICgpID0+IHtcblxuICAgIGNvbnN0IGdldFNvcnQgPSAoeyB0YXJnZXQgfSkgPT4ge1xuICAgICAgICBjb25zdCBvcmRlciA9ICh0YXJnZXQuZGF0YXNldC5vcmRlciA9IC0odGFyZ2V0LmRhdGFzZXQub3JkZXIgfHwgLTEpKTtcbiAgICAgICAgY29uc3QgaW5kZXggPSBbLi4udGFyZ2V0LnBhcmVudE5vZGUuY2VsbHNdLmluZGV4T2YodGFyZ2V0KTtcbiAgICAgICAgY29uc3QgY29sbGF0b3IgPSBuZXcgSW50bC5Db2xsYXRvcihbJ2VuJywgJ3J1J10sIHsgbnVtZXJpYzogdHJ1ZSB9KTtcbiAgICAgICAgY29uc3QgY29tcGFyYXRvciA9IChpbmRleCwgb3JkZXIpID0+IChhLCBiKSA9PiBvcmRlciAqIGNvbGxhdG9yLmNvbXBhcmUoXG4gICAgICAgICAgICBiLmNoaWxkcmVuW2luZGV4XS5pbm5lclRleHQsXG4gICAgICAgICAgICBhLmNoaWxkcmVuW2luZGV4XS5pbm5lclRleHRcbiAgICAgICAgKTtcblxuICAgICAgICBmb3IoY29uc3QgdEJvZHkgb2YgdGFyZ2V0LmNsb3Nlc3QoJ3RhYmxlJykudEJvZGllcylcbiAgICAgICAgICAgIHRCb2R5LmFwcGVuZCguLi5bLi4udEJvZHkucm93c10uc29ydChjb21wYXJhdG9yKGluZGV4LCBvcmRlcikpKTtcblxuICAgICAgICBmb3IoY29uc3QgY2VsbCBvZiB0YXJnZXQucGFyZW50Tm9kZS5jZWxscylcbiAgICAgICAgICAgIGNlbGwuY2xhc3NMaXN0LnRvZ2dsZSgnc29ydGVkJywgY2VsbCA9PT0gdGFyZ2V0KTtcbiAgICB9O1xuXHRcdGNvbnN0IHRoZWFkID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLnRhYmxlX3NvcnQgdGhlYWQgdHInKVsxXTtcblx0XHQvL2NvbnNvbGUubG9nKHRoZWFkKTtcblx0XHRpZih0aGVhZCAhPSB1bmRlZmluZWQpXG4gICAgXHR0aGVhZC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IGdldFNvcnQoZXZlbnQpKTtcblxufSk7XG4iXSwibmFtZXMiOlsiJCIsImRhdGVwaWNrZXIiLCJyZWdpb25hbCIsImNsb3NlVGV4dCIsInByZXZUZXh0IiwibmV4dFRleHQiLCJjdXJyZW50VGV4dCIsIm1vbnRoTmFtZXMiLCJtb250aE5hbWVzU2hvcnQiLCJkYXlOYW1lcyIsImRheU5hbWVzU2hvcnQiLCJkYXlOYW1lc01pbiIsIndlZWtIZWFkZXIiLCJkYXRlRm9ybWF0IiwiZmlyc3REYXkiLCJpc1JUTCIsInNob3dNb250aEFmdGVyWWVhciIsInllYXJTdWZmaXgiLCJzZXREZWZhdWx0cyIsInBhcnNlVXJsUXVlcnkiLCJkYXRhIiwibG9jYXRpb24iLCJzZWFyY2giLCJwYWlyIiwic3Vic3RyIiwic3BsaXQiLCJpIiwibGVuZ3RoIiwicGFyYW0iLCJzY3JvbGxUb0Jsb2NrIiwidG8iLCJzcGVlZCIsIm9mZnNldCIsInN0b3AiLCJhbmltYXRlIiwic2Nyb2xsVG9wIiwidG9wIiwib24iLCJldmVudCIsInByZXZlbnREZWZhdWx0IiwidG9nZ2xlQ2xhc3MiLCJyZW1vdmVDbGFzcyIsImhpZGUiLCJtb3VzZW92ZXIiLCJzaG93IiwibW91c2VvdXQiLCJjaG9zZW4iLCJub19yZXN1bHRzX3RleHQiLCJzZWFyY2hfY29udGFpbnMiLCJ3aWR0aCIsImF0dHIiLCJjaGFuZ2UiLCJ1cmwiLCJSb3V0aW5nIiwiZ2VuZXJhdGUiLCJ2YWwiLCJ3aW5kb3ciLCJocmVmIiwiYmluZCIsInZhbHVlIiwiYWpheCIsInR5cGUiLCJxdWVyeSIsImRhdGFUeXBlIiwic3VjY2VzcyIsImVtcHR5IiwiZWFjaCIsInRyYW5zbGl0IiwibmFtZSIsImFwcGVuZCIsIm5vdCIsImNsaWNrIiwiY29uc29sZSIsImxvZyIsImVycm9yIiwieGhyIiwiYWpheE9wdGlvbnMiLCJ0aHJvd25FcnJvciIsImRvY3VtZW50IiwiZm9ybV9wbGF5ZXIiLCJpZCIsInRleHQiLCJyZXNwb25zZSIsIiR0aGlzIiwidG91ciIsImNvdW50cnkiLCJzZWFzb24iLCJodG1sIiwiYWRkQ2xhc3MiLCJoaXN0b3J5IiwicHVzaFN0YXRlIiwic3RhdHVzIiwiYXJHYW1lcyIsImNoYW1wIiwiZ2FtZSIsInB1c2giLCJwYXJzZUludCIsImFyciIsIkpTT04iLCJwYXJzZSIsImZvckVhY2giLCJpdGVtIiwidGVhbSIsInJvdXRlIiwidHVybmlyIiwicGFyYW1zIiwiY3NzIiwidW5kZWZpbmVkIiwibGV0dGVyIiwibmV3SHRtbCIsImNudCIsInRlYW1zIiwiZGV0YWlsVXJsIiwibWF4TWF0Y2hlcyIsIm5ld0FyciIsImtleSIsImpvaW4iLCJsb2FkIiwic2xpY2VNYWluTWVudSIsInJlc2l6ZSIsIiRtYWluTWVudSIsImZpbmQiLCJuZXh0RWxlbWVudCIsIiRuZXh0RWxlbWVudCIsInJlbW92ZSIsIiRtYWluTWVudUl0ZW1zIiwiY2hpbGRyZW4iLCJ2aXNpYmxlTWVudVdpZHRoIiwid2luZG93V2lkdGgiLCJ0b3RhbFN1bU1lbnVXaWR0aCIsIm91dGVyV2lkdGgiLCIkcmVtb3ZlZEl0ZW1zIiwiJHJlbW92ZWRJdGVtc0xpc3QiLCIkcmVtb3ZlZEl0ZW1zTGluayIsIl9fc2VjdGlvbk1lbnVBY3RpdmUiLCJfX3NlY3Rpb25NZW51TWVudUlEIiwiX19zZWN0aW9uTWVudU9wZW5lciIsIl9fc2VjdGlvbk1lbnVEcm9wIiwiX19hY3RpdmUiLCJfX21lbnVJRCIsIl9fb3BlbmVyIiwiX19kcm9wIiwiJF9zZWxmIiwiJF9lQ2hpbGQiLCJvcGVuQ2hpbGQiLCIkX3RoaXMiLCJoYXNDbGFzcyIsIl9fbWVudUZpcnN0T3BlblRpbWVvdXRJRCIsInNldFRpbWVvdXQiLCJpcyIsImNsZWFyVGltZW91dCIsIiRfc2VjdGlvbk1lbnVFQ2hpbGQiLCJfX21lbnVUaW1lb3V0SUQiLCJjbG9zZUNoaWxkIiwiJF9jYXB0dXJlVGhpcyIsImhvdmVyIiwicmVhZHkiLCJhZGRFdmVudExpc3RlbmVyIiwiZ2V0U29ydCIsIl9yZWYiLCJ0YXJnZXQiLCJvcmRlciIsImRhdGFzZXQiLCJpbmRleCIsIl90b0NvbnN1bWFibGVBcnJheSIsInBhcmVudE5vZGUiLCJjZWxscyIsImluZGV4T2YiLCJjb2xsYXRvciIsIkludGwiLCJDb2xsYXRvciIsIm51bWVyaWMiLCJjb21wYXJhdG9yIiwiYSIsImIiLCJjb21wYXJlIiwiaW5uZXJUZXh0IiwiX2l0ZXJhdG9yIiwiX2NyZWF0ZUZvck9mSXRlcmF0b3JIZWxwZXIiLCJjbG9zZXN0IiwidEJvZGllcyIsIl9zdGVwIiwicyIsIm4iLCJkb25lIiwidEJvZHkiLCJhcHBseSIsInJvd3MiLCJzb3J0IiwiZXJyIiwiZSIsImYiLCJfaXRlcmF0b3IyIiwiX3N0ZXAyIiwiY2VsbCIsImNsYXNzTGlzdCIsInRvZ2dsZSIsInRoZWFkIiwicXVlcnlTZWxlY3RvckFsbCJdLCJzb3VyY2VSb290IjoiIn0=