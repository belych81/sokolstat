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
    $.ajax({
      type: 'post',
      url: Routing.generate('shipplayers_update'),
      data: {
        query: arGames,
        champ: champ
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

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_modules_es_object_to-string_js-node_modules_core-js_modules_es_s-6657b7","vendors-node_modules_core-js_modules_es_array_find_js-node_modules_core-js_modules_es_array_f-7d4272"], () => (__webpack_exec__("./assets/js/search.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QUExSCxLQUFBO1FBQ1g4SCxLQUFLLENBQUNwSCxNQUFNLENBQUFxSCxLQUFBLENBQVpELEtBQUssRUFBQXJCLGtCQUFBLENBQVdBLGtCQUFBLENBQUlxQixLQUFLLENBQUNFLElBQUksRUFBRUMsSUFBSSxDQUFDaEIsVUFBVSxDQUFDVCxLQUFLLEVBQUVGLEtBQUssQ0FBQyxDQUFDLEVBQUM7TUFBQTtJQUFDLFNBQUE0QixHQUFBO01BQUFaLFNBQUEsQ0FBQWEsQ0FBQSxDQUFBRCxHQUFBO0lBQUE7TUFBQVosU0FBQSxDQUFBYyxDQUFBO0lBQUE7SUFBQSxJQUFBQyxVQUFBLEdBQUFkLDBCQUFBLENBRWxEbEIsTUFBTSxDQUFDSyxVQUFVLENBQUNDLEtBQUs7TUFBQTJCLE1BQUE7SUFBQTtNQUF6QyxLQUFBRCxVQUFBLENBQUFWLENBQUEsTUFBQVcsTUFBQSxHQUFBRCxVQUFBLENBQUFULENBQUEsSUFBQUMsSUFBQSxHQUNJO1FBQUEsSUFETVUsSUFBSSxHQUFBRCxNQUFBLENBQUF0SSxLQUFBO1FBQ1Z1SSxJQUFJLENBQUNDLFNBQVMsQ0FBQ0MsTUFBTSxDQUFDLFFBQVEsRUFBRUYsSUFBSSxLQUFLbEMsTUFBTSxDQUFDO01BQUE7SUFBQyxTQUFBNkIsR0FBQTtNQUFBRyxVQUFBLENBQUFGLENBQUEsQ0FBQUQsR0FBQTtJQUFBO01BQUFHLFVBQUEsQ0FBQUQsQ0FBQTtJQUFBO0VBQ3pELENBQUM7RUFDSCxJQUFNTSxLQUFLLEdBQUd2SCxRQUFRLENBQUN3SCxnQkFBZ0IsQ0FBQyxzQkFBc0IsQ0FBQyxDQUFDLENBQUMsQ0FBQztFQUNsRTtFQUNBLElBQUdELEtBQUssSUFBSTFGLFNBQVMsRUFDbEIwRixLQUFLLENBQUN4QyxnQkFBZ0IsQ0FBQyxPQUFPLEVBQUU7SUFBQSxPQUFNQyxPQUFPLENBQUN4SCxLQUFLLENBQUM7RUFBQSxFQUFDO0FBRTFELENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9qcy9zZWFyY2guanMiXSwic291cmNlc0NvbnRlbnQiOlsiJC5kYXRlcGlja2VyLnJlZ2lvbmFsWydydSddID0ge1xuXHRjbG9zZVRleHQ6ICfQl9Cw0LrRgNGL0YLRjCcsXG5cdHByZXZUZXh0OiAn0J/RgNC10LTRi9C00YPRidC40LknLFxuXHRuZXh0VGV4dDogJ9Ch0LvQtdC00YPRjtGJ0LjQuScsXG5cdGN1cnJlbnRUZXh0OiAn0KHQtdCz0L7QtNC90Y8nLFxuXHRtb250aE5hbWVzOiBbJ9Cv0L3QstCw0YDRjCcsJ9Ck0LXQstGA0LDQu9GMJywn0JzQsNGA0YInLCfQkNC/0YDQtdC70YwnLCfQnNCw0LknLCfQmNGO0L3RjCcsJ9CY0Y7Qu9GMJywn0JDQstCz0YPRgdGCJywn0KHQtdC90YLRj9Cx0YDRjCcsJ9Ce0LrRgtGP0LHRgNGMJywn0J3QvtGP0LHRgNGMJywn0JTQtdC60LDQsdGA0YwnXSxcblx0bW9udGhOYW1lc1Nob3J0OiBbJ9Cv0L3QsicsJ9Ck0LXQsicsJ9Cc0LDRgCcsJ9CQ0L/RgCcsJ9Cc0LDQuScsJ9CY0Y7QvScsJ9CY0Y7QuycsJ9CQ0LLQsycsJ9Ch0LXQvScsJ9Ce0LrRgicsJ9Cd0L7RjycsJ9CU0LXQuiddLFxuXHRkYXlOYW1lczogWyfQstC+0YHQutGA0LXRgdC10L3RjNC1Jywn0L/QvtC90LXQtNC10LvRjNC90LjQuicsJ9Cy0YLQvtGA0L3QuNC6Jywn0YHRgNC10LTQsCcsJ9GH0LXRgtCy0LXRgNCzJywn0L/Rj9GC0L3QuNGG0LAnLCfRgdGD0LHQsdC+0YLQsCddLFxuXHRkYXlOYW1lc1Nob3J0OiBbJ9Cy0YHQuicsJ9C/0L3QtCcsJ9Cy0YLRgCcsJ9GB0YDQtCcsJ9GH0YLQsicsJ9C/0YLQvScsJ9GB0LHRgiddLFxuXHRkYXlOYW1lc01pbjogWyfQktGBJywn0J/QvScsJ9CS0YInLCfQodGAJywn0KfRgicsJ9Cf0YInLCfQodCxJ10sXG5cdHdlZWtIZWFkZXI6ICfQndC1Jyxcblx0ZGF0ZUZvcm1hdDogJ2RkLm1tLnl5Jyxcblx0Zmlyc3REYXk6IDEsXG5cdGlzUlRMOiBmYWxzZSxcblx0c2hvd01vbnRoQWZ0ZXJZZWFyOiBmYWxzZSxcblx0eWVhclN1ZmZpeDogJydcbn07XG5cbiQuZGF0ZXBpY2tlci5zZXREZWZhdWx0cygkLmRhdGVwaWNrZXIucmVnaW9uYWxbJ3J1J10pO1xuXG5mdW5jdGlvbiBwYXJzZVVybFF1ZXJ5KCkge1xuICAgIHZhciBkYXRhID0ge307XG4gICAgaWYobG9jYXRpb24uc2VhcmNoKSB7XG4gICAgICAgIHZhciBwYWlyID0gKGxvY2F0aW9uLnNlYXJjaC5zdWJzdHIoMSkpLnNwbGl0KCcmJyk7XG4gICAgICAgIGZvcih2YXIgaSA9IDA7IGkgPCBwYWlyLmxlbmd0aDsgaSArKykge1xuICAgICAgICAgICAgdmFyIHBhcmFtID0gcGFpcltpXS5zcGxpdCgnPScpO1xuICAgICAgICAgICAgZGF0YVtwYXJhbVswXV0gPSBwYXJhbVsxXTtcbiAgICAgICAgfVxuICAgIH1cbiAgICByZXR1cm4gZGF0YTtcbn1cblxuZnVuY3Rpb24gc2Nyb2xsVG9CbG9jayh0bywgc3BlZWQsIG9mZnNldCkge1xuICBpZiAodHlwZW9mIHRvID09PSAnc3RyaW5nJykgdG8gPSAkKHRvKTtcbiAgaWYgKCF0b1swXSkgcmV0dXJuO1xuICBvZmZzZXQgPSBvZmZzZXQgfHwgNzI7XG4gIHNwZWVkID0gc3BlZWQgfHwgMTAwMDtcbiAgJCgnaHRtbCwgYm9keScpLnN0b3AoKS5hbmltYXRlKHtcbiAgICBzY3JvbGxUb3A6IHRvLm9mZnNldCgpLnRvcCAtIG9mZnNldFxuICB9LCBzcGVlZCk7XG59XG5cbiAgJChmdW5jdGlvbigpe1xuICAgICQoJy5tZW51LXRyaWdnZXInKS5vbignY2xpY2snLCBmdW5jdGlvbihldmVudCkge1xuICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgICQoJy5wYW5lbC1ib3gnKS50b2dnbGVDbGFzcygnb3BlbicpO1xuICAgICAgJCgnI25hdmJhci1jb2xsYXBzZS0xJykucmVtb3ZlQ2xhc3MoJ2luJyk7XG4gICAgfSk7XG4gICAgXG4gICAgJCgnI21lbnVDaGFtcCcpLmhpZGUoKTtcbiAgICAkKCcjY2hhbXAnKS5tb3VzZW92ZXIoZnVuY3Rpb24oKSB7XG4gICAgICAgICQoJyNtZW51Q2hhbXAnKS5zaG93KCk7XG4gICAgfSkubW91c2VvdXQoZnVuY3Rpb24oKSB7XG4gICAgICAgICQoJyNtZW51Q2hhbXAnKS5oaWRlKCk7XG4gICAgfSk7XG5cblx0XHQkKFwic2VsZWN0XCIpLmNob3Nlbih7XG5cdFx0XHRub19yZXN1bHRzX3RleHQ6IFwi0J3QtSDQvdCw0YjQu9C+0YHRjFwiLFxuXHRcdFx0c2VhcmNoX2NvbnRhaW5zOiB0cnVlLFxuXHRcdFx0d2lkdGg6ICcxODBweCdcblx0XHR9KTtcblxuXHRcdCQoJy5zY3JvbGwtdG8tYnRuJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuXHRcdCAgdmFyIHRvID0gJCh0aGlzKS5hdHRyKCdocmVmJykgfHwgJCh0aGlzKS5kYXRhKCdocmVmJyk7XG5cdFx0ICBzY3JvbGxUb0Jsb2NrKHRvKTtcblx0XHQgIHJldHVybiBmYWxzZTtcblx0XHR9KTtcblxuXHRcdCQoXCJzZWxlY3RbbmFtZT10ZWFtc11cIikuY2hhbmdlKGZ1bmN0aW9uKCl7XG5cdFx0XHR2YXIgdXJsID0gUm91dGluZy5nZW5lcmF0ZSgncGxheWVyJywge1xuXHRcdFx0XHQndGVhbSc6ICQodGhpcykudmFsKCksICdjb3VudHJ5JzogJCh0aGlzKS5kYXRhKCdjb3VudHJ5Jylcblx0XHRcdH0pO1xuXHRcdFx0d2luZG93LmxvY2F0aW9uLmhyZWYgPSB1cmw7XG5cdFx0fSk7XG5cblx0XHQkKFwic2VsZWN0W25hbWU9Y291bnRyeV1bcGxhY2Vob2xkZXI90KHRgtGA0LDQvdCwXVwiKS5jaGFuZ2UoZnVuY3Rpb24oKXtcblx0XHRcdHZhciB1cmwgPSBSb3V0aW5nLmdlbmVyYXRlKCdwbGF5ZXInLCB7XG5cdFx0XHRcdCdjb3VudHJ5JzogJCh0aGlzKS52YWwoKSwgJ3RlYW0nOiAkKHRoaXMpLmRhdGEoJ3RlYW0nKVxuXHRcdFx0fSk7XG5cdFx0XHR3aW5kb3cubG9jYXRpb24uaHJlZiA9IHVybDtcblx0XHR9KTtcbiAgICAkKFwic2VsZWN0W25hbWU9Y291bnRyeV1bcGxhY2Vob2xkZXI90JPRgNCw0LbQtNCw0L3RgdGC0LLQvl1cIikuY2hhbmdlKGZ1bmN0aW9uKCl7XG5cdFx0XHR2YXIgdXJsID0gUm91dGluZy5nZW5lcmF0ZSgncGxheWVyX2FsbCcsIHtcblx0XHRcdFx0J2NvdW50cnknOiAkKHRoaXMpLnZhbCgpLCAndGVhbSc6ICQodGhpcykuZGF0YSgndGVhbScpXG5cdFx0XHR9KTtcblx0XHRcdHdpbmRvdy5sb2NhdGlvbi5ocmVmID0gdXJsO1xuXHRcdH0pO1xuXG4gICAgLy/QltC40LLQvtC5INC/0L7QuNGB0LpcbiAgXHQkKCcuc2VhcmNoX2tleXdvcmRzJykuYmluZChcImtleXVwXCIsIGZ1bmN0aW9uKCkge1xuICAgICAgaWYodGhpcy52YWx1ZS5sZW5ndGggPj0gMSl7XG4gICAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgICAgdHlwZTogJ3Bvc3QnLFxuICAgICAgICAgICAgICB1cmw6IFJvdXRpbmcuZ2VuZXJhdGUoJ25ld3Nfc2VhcmNoJyksXG4gICAgICAgICAgICAgIGRhdGE6IHtxdWVyeTogdGhpcy52YWx1ZX0sXG4gICAgICAgICAgICAgIGRhdGFUeXBlOiAnanNvbicsXG4gICAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKGRhdGEpe1xuICAgICAgICAgICAgICAgICAgJChcIi5zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLmVtcHR5KCkuaGlkZSgpO1xuICAgICAgICAgICAgICAgICAgaWYoZGF0YSl7XG4gICAgICAgICAgICAgICAgICAgICAgJChcIi5zZWFyY2hfcmVzdWx0LCAuc2VhcmNoX3Jlc3VsdF9pdGVtc1wiKS5zaG93KCk7XG4gICAgICAgICAgICAgICAgICAgICAgJC5lYWNoKGRhdGEsIGZ1bmN0aW9uKHRyYW5zbGl0LCBuYW1lKXtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgJChcIi5zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpXG4gICAgICAgICAgICAgICAgICAgICAgICAgIC5hcHBlbmQoXCI8YSBocmVmPScvXCIrdHJhbnNsaXQrXCInPlwiK25hbWUrXCI8L2E+XCIpO1xuXG4gICAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgICAgICAgJChcImJvZHlcIikubm90KFwiLnNlYXJjaC10b3BcIikuY2xpY2soZnVuY3Rpb24oKXtcbiAgICAgICAgICAgICAgICAgICAgICAgICQoXCIuc2VhcmNoX3Jlc3VsdCwgLnNlYXJjaF9yZXN1bHRfaXRlbXNcIikuaGlkZSgpO1xuICAgICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgICAgICAkKFwiLnNlYXJjaF9yZXN1bHQsIC5zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKGRhdGEpO1xuICAgICAgICAgICAgIH0sXG4gICAgICAgZXJyb3I6IGZ1bmN0aW9uICh4aHIsIGFqYXhPcHRpb25zLCB0aHJvd25FcnJvcikge1xuICAgICAgICB9XG4gICAgICB9KTtcbiAgICAgIH0gZWxzZSB7XG4gICAgICAgICQoXCIuc2VhcmNoX3Jlc3VsdCwgLnNlYXJjaF9yZXN1bHRfaXRlbXNcIikuaGlkZSgpO1xuICAgICAgfVxuICB9KTtcblxuICAkKGRvY3VtZW50KS5vbihcImtleXVwXCIsICcjcnVzX3BsYXllcicsIGZ1bmN0aW9uKCkge1xuICAgIGlmKHRoaXMudmFsdWUubGVuZ3RoID49IDEpe1xuICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgdHlwZTogJ3Bvc3QnLFxuICAgICAgICAgICAgdXJsOiBSb3V0aW5nLmdlbmVyYXRlKCduZXdzX3NlYXJjaCcpLFxuICAgICAgICAgICAgZGF0YToge3F1ZXJ5OiB0aGlzLnZhbHVlLCBmb3JtX3BsYXllcjogJ3knfSxcbiAgICAgICAgICAgIGRhdGFUeXBlOiAnanNvbicsXG4gICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhKXtcbiAgICAgICAgICAgICAgICAkKFwiLnBsYXllcl9zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLmVtcHR5KCkuaGlkZSgpO1xuICAgICAgICAgICAgICAgIGlmKGRhdGEpe1xuICAgICAgICAgICAgICAgICAgICAkKFwiLnBsYXllcl9zZWFyY2hfcmVzdWx0LCAucGxheWVyX3NlYXJjaF9yZXN1bHRfaXRlbXNcIikuc2hvdygpO1xuICAgICAgICAgICAgICAgICAgICAkLmVhY2goZGF0YSwgZnVuY3Rpb24oaWQsIG5hbWUpe1xuICAgICAgICAgICAgICAgICAgICAgICAgJChcIi5wbGF5ZXJfc2VhcmNoX3Jlc3VsdF9pdGVtc1wiKVxuICAgICAgICAgICAgICAgICAgICAgICAgLmFwcGVuZChcIjxkaXYgY2xhc3M9XFxcInBsYXllcl9mb3JtX3NlYXJjaFxcXCIgZGF0YS1pZD0nXCIraWQrXCInPlwiK25hbWUrXCI8L2Rpdj5cIik7XG5cbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgICAgICQoXCJib2R5XCIpLm5vdChcIi5zZWFyY2gtdG9wXCIpLmNsaWNrKGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgICAgICAgJChcIi5wbGF5ZXJfc2VhcmNoX3Jlc3VsdCwgLnBsYXllcl9zZWFyY2hfcmVzdWx0X2l0ZW1zXCIpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgICAgICQoZG9jdW1lbnQpLm9uKCdjbGljaycsICcucGxheWVyX2Zvcm1fc2VhcmNoJywgZnVuY3Rpb24oKXtcbiAgICAgICAgICAgICAgICAgICAgICAkKFwiI3J1c19wbGF5ZXJcIikudmFsKCQodGhpcykudGV4dCgpKTtcbiAgICAgICAgICAgICAgICAgICAgICAkKFwiI3J1c19wbGF5ZXJfaGlkZGVuXCIpLnZhbCgkKHRoaXMpLmRhdGEoJ2lkJykpO1xuICAgICAgICAgICAgICAgICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICAgICAgICAgICAgICB0eXBlOiAncG9zdCcsXG4gICAgICAgICAgICAgICAgICAgICAgICB1cmw6IFJvdXRpbmcuZ2VuZXJhdGUoJ3Nlc3Npb25fcGxheWVyX2FkZCcsIHsnaWQnOiAkKHRoaXMpLmRhdGEoJ2lkJyl9KSxcbiAgICAgICAgICAgICAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKHJlc3BvbnNlKXtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyhyZXNwb25zZSk7XG4gICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICAkKFwiLnBsYXllcl9zZWFyY2hfcmVzdWx0LCAucGxheWVyX3NlYXJjaF9yZXN1bHRfaXRlbXNcIikuaGlkZSgpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyhkYXRhKTtcbiAgICAgICAgICAgfSxcbiAgICAgZXJyb3I6IGZ1bmN0aW9uICh4aHIsIGFqYXhPcHRpb25zLCB0aHJvd25FcnJvcikge1xuICAgICAgfVxuICAgIH0pO1xuICAgIH0gZWxzZSB7XG4gICAgICAkKFwiLnBsYXllcl9zZWFyY2hfcmVzdWx0LCAucGxheWVyX3NlYXJjaF9yZXN1bHRfaXRlbXNcIikuaGlkZSgpO1xuICAgIH1cbn0pO1xuXG4kKGRvY3VtZW50KS5vbignY2xpY2snLCAnLnRvdXJfanMnLCBmdW5jdGlvbigpe1xuICBsZXQgJHRoaXMgPSAkKHRoaXMpO1xuICBsZXQgdG91ciA9ICR0aGlzLmRhdGEoJ3RvdXInKTtcbiAgbGV0IGNvdW50cnkgPSAkdGhpcy5kYXRhKCdjb3VudHJ5Jyk7XG4gIGxldCBzZWFzb24gPSAkdGhpcy5kYXRhKCdzZWFzb24nKTtcbiAgJC5hamF4KHtcbiAgICB0eXBlOiAncG9zdCcsXG4gICAgdXJsOiBSb3V0aW5nLmdlbmVyYXRlKCdjaGFtcGlvbnNoaXBzX3RvdXInLCB7J3RvdXInOnRvdXIsICdzZWFzb24nOiBzZWFzb24sICdjb3VudHJ5JzogY291bnRyeX0pLFxuICAgIGRhdGFUeXBlOiAnanNvbicsXG4gICAgc3VjY2VzczogZnVuY3Rpb24ocmVzcG9uc2Upe1xuICAgICAgJChcIi5jaGFtcHNoaXAtdGFibGUgdGJvZHlcIikuaHRtbChyZXNwb25zZS5yZXNwb25zZSk7XG4gICAgICAkKFwiLnRvdXJfdGV4dCBzcGFuXCIpLnRleHQodG91cik7XG4gICAgICAkKFwiLnRvdXJfanNcIikucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuICAgICAgJHRoaXMuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xuICAgICAgaGlzdG9yeS5wdXNoU3RhdGUobnVsbCwgJycsIFJvdXRpbmcuZ2VuZXJhdGUoJ2NoYW1waW9uc2hpcHMnLCB7J3RvdXInOnRvdXIsICdzZWFzb24nOiBzZWFzb24sICdjb3VudHJ5JzogY291bnRyeX0pKVxuICAgIH0sXG4gICAgZXJyb3I6IGZ1bmN0aW9uICh4aHIsIGFqYXhPcHRpb25zLCB0aHJvd25FcnJvcikge1xuICAgICAgY29uc29sZS5sb2coeGhyLnN0YXR1cyk7XG4gICAgICBjb25zb2xlLmxvZyh0aHJvd25FcnJvcik7XG4gICAgfVxufSk7XG59KTtcblxuICAkKFwiI3NoaXBwbGF5ZXJzVXBkYXRlXCIpLmNsaWNrKGZ1bmN0aW9uKCl7XG4gICAgdmFyIGFyR2FtZXMgPSBbXTtcblx0XHR2YXIgY2hhbXAgPSAkKHRoaXMpLmRhdGEoJ2NoYW1wJyk7XG4gICAgJChcIi5zaGlwcGxheWVyLWlucHV0XCIpLmVhY2goZnVuY3Rpb24oKXtcbiAgICAgIHZhciBnYW1lID0gJCh0aGlzKS52YWwoKTtcbiAgICAgIGlmKGdhbWUgIT0gMCl7XG4gICAgICAgIGFyR2FtZXMucHVzaChbXG4gICAgICAgICAgJCh0aGlzKS5kYXRhKCdpZCcpLFxuICAgICAgICAgICQodGhpcykuZGF0YSgncGxheWVyJyksXG4gICAgICAgICAgcGFyc2VJbnQoZ2FtZSlcbiAgICAgICAgXSk7XG4gICAgICB9XG4gICAgfSk7XG4gICAgJC5hamF4KHtcbiAgICAgICAgdHlwZTogJ3Bvc3QnLFxuICAgICAgICB1cmw6IFJvdXRpbmcuZ2VuZXJhdGUoJ3NoaXBwbGF5ZXJzX3VwZGF0ZScpLFxuICAgICAgICBkYXRhOiB7cXVlcnk6IGFyR2FtZXMsIGNoYW1wOiBjaGFtcH0sXG4gICAgICAgIGRhdGFUeXBlOiAnanNvbicsXG4gICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKHJlc3BvbnNlKXtcbiAgICAgICAgICB2YXIgYXJyID0gSlNPTi5wYXJzZShyZXNwb25zZSk7XG4gICAgICAgICAgYXJyLmZvckVhY2goZnVuY3Rpb24oaXRlbSwgaSwgYXJyKSB7XG4gICAgICAgICAgICAkKFwiW2RhdGEtaWQ9XCIraXRlbVswXStcIl1bZGF0YS1wYXJhbT0nZ2FtZSddXCIpLnRleHQoaXRlbVsxXSk7XG4gICAgICAgICAgfSk7XG4gICAgICAgIH0sXG4gICAgICAgIGVycm9yOiBmdW5jdGlvbiAoeGhyLCBhamF4T3B0aW9ucywgdGhyb3duRXJyb3IpIHtcbiAgICAgICAgICBjb25zb2xlLmxvZyh4aHIuc3RhdHVzKTtcbiAgICAgICAgICBjb25zb2xlLmxvZyh0aHJvd25FcnJvcik7XG4gICAgICAgIH1cbiAgICB9KTtcbiAgfSk7XG5cbiAgJChcIi5jaGFuZ2VHYW1lR29hbFBsYXllclwiKS5jbGljayhmdW5jdGlvbigpe1xuICAgIHZhciBjaGFuZ2UgPSAkKHRoaXMpLmRhdGEoJ2NoYW5nZScpO1xuICAgIHZhciBpZCA9ICQodGhpcykuZGF0YSgnaWQnKTtcbiAgICB2YXIgc2Vhc29uID0gJCh0aGlzKS5kYXRhKCdzZWFzb24nKTtcbiAgICB2YXIgdGVhbSA9ICQodGhpcykuZGF0YSgndGVhbScpO1xuICAgIHZhciByb3V0ZSA9ICQodGhpcykuZGF0YSgncGF0aCcpO1xuXHRcdHZhciB0dXJuaXIgPSAkKHRoaXMpLmRhdGEoJ3R1cm5pcicpO1xuXHRcdHZhciAkdGhpcyA9ICQodGhpcyk7XG5cdFx0dmFyIHBhcmFtcyA9IHsnaWQnOiBpZCwgJ3NlYXNvbic6IHNlYXNvbiwgJ2NoYW5nZSc6IGNoYW5nZX07XG5cdFx0JChcIi5sb2FkaW5nW2RhdGEtaWQ9XCIraWQrXCJdXCIpLmNzcygnZGlzcGxheScsICdpbmxpbmUtYmxvY2snKTtcblx0XHRpZih0dXJuaXIgIT0gdW5kZWZpbmVkKXtcblx0XHRcdHBhcmFtc1sndHVybmlyJ10gPSB0dXJuaXI7XG5cdFx0fVxuXHRcdGlmKHJvdXRlICE9ICdwbGF5ZXJfZWRpdFNiJyl7XG5cdFx0XHRwYXJhbXNbJ3RlYW0nXSA9IHRlYW07XG5cdFx0fVxuICAgICQuYWpheCh7XG4gICAgICAgIHR5cGU6ICdwb3N0JyxcbiAgICAgICAgdXJsOiBSb3V0aW5nLmdlbmVyYXRlKHJvdXRlLCBwYXJhbXMpLFxuICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhKXtcblx0XHRcdFx0XHRjb25zb2xlLmxvZyhkYXRhKTtcbiAgICAgICAgICBjb25zb2xlLmxvZyhyb3V0ZSk7XG4gICAgICAgICAgICAkKFwiLnNwaXNraS5zZWxlY3RlZFwiKS5yZW1vdmVDbGFzcygnc2VsZWN0ZWQnKTtcbiAgICAgICAgICAgICQoXCIuc3Bpc2tpW2RhdGEtaWQ9XCIraWQrXCJdXCIpLmFkZENsYXNzKCdzZWxlY3RlZCcpO1xuXHRcdFx0XHRcdFx0aWYocm91dGUgPT0gJ3BsYXllcmFkbWluX2VkaXRDaGFtcFRvdGFsJyl7XG5cdFx0XHRcdFx0XHRcdCQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0ndG90YWxnYW1lJ11cIikudGV4dChkYXRhWydnYW1lJ10pO1xuICAgICAgICAgICAgXHQkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J3RvdGFsZ29hbCddXCIpLnRleHQoZGF0YVsnZ29hbCddKTtcblx0XHRcdFx0XHRcdH0gZWxzZSBpZihyb3V0ZSA9PSAncGxheWVyYWRtaW5fZWRpdE5hdGlvbkN1cCcpe1xuXHQgICAgICAgICAgICBcdCQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nY3VwJ11cIikudGV4dChkYXRhWydnb2FsJ10pO1xuXHRcdFx0XHRcdFx0fSBlbHNlIGlmKHJvdXRlID09ICdwbGF5ZXJhZG1pbl9lZGl0TmF0aW9uU3VwZXJjdXAnKXtcblx0XHRcdFx0XHRcdFx0XHQkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J3N1cGVyY3VwJ11cIikudGV4dChkYXRhWydnb2FsJ10pO1xuXHRcdFx0XHRcdFx0fSBlbHNlIGlmKHJvdXRlID09ICdwbGF5ZXJhZG1pbl9lZGl0TmF0aW9uRXVyb2N1cCcpe1xuXHRcdFx0XHRcdFx0XHRcdCQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nZXVyb2N1cCddXCIpLnRleHQoZGF0YVsnZ29hbCddKTtcblx0XHRcdFx0XHRcdH0gZWxzZSBpZihyb3V0ZSA9PSAncGxheWVyYWRtaW5fZWRpdE5hdGlvblNib3JuaWUnKXtcblx0XHRcdFx0XHRcdFx0XHQkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J3Nib3JuaWUnXVwiKS50ZXh0KGRhdGFbJ2dvYWwnXSk7XG5cdFx0XHRcdFx0XHR9IGVsc2Uge1xuICAgICAgICAgICAgICBjb25zb2xlLmxvZygkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J2dvYWxQbyddXCIpKVxuICAgICAgICAgICAgXHQkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J2dhbWUnXVwiKS50ZXh0KGRhdGFbJ2dhbWUnXSk7XG4gICAgICAgICAgICBcdCQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nZ29hbCddXCIpLnRleHQoZGF0YVsnZ29hbCddKTtcbiAgICAgICAgICAgICAgJChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSdnYW1lUG8nXVwiKS50ZXh0KGRhdGFbJ2dhbWVQbyddKTtcbiAgICAgICAgICAgIFx0JChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSdnb2FsUG8nXVwiKS50ZXh0KGRhdGFbJ2dvYWxQbyddKTtcblx0XHRcdFx0XHRcdH1cbiAgICAgICAgICAgICQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nYXNzaXN0J11cIikudGV4dChkYXRhWydhc3Npc3QnXSk7XG4gICAgICAgICAgICAkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J3Njb3JlJ11cIikudGV4dChkYXRhWydzY29yZSddKTtcbiAgICAgICAgICAgICQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nbWlzc2VkJ11cIikudGV4dChkYXRhWydtaXNzZWQnXSk7XG4gICAgICAgICAgICAkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J3plcm8nXVwiKS50ZXh0KGRhdGFbJ3plcm8nXSk7XG4gICAgICAgICAgICAkKFwiW2RhdGEtaWQ9XCIraWQrXCJdW2RhdGEtcGFyYW09J2Fzc2lzdFBvJ11cIikudGV4dChkYXRhWydhc3Npc3RQbyddKTtcbiAgICAgICAgICAgICQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nc2NvcmVQbyddXCIpLnRleHQoZGF0YVsnc2NvcmVQbyddKTtcbiAgICAgICAgICAgICQoXCJbZGF0YS1pZD1cIitpZCtcIl1bZGF0YS1wYXJhbT0nbWlzc2VkUG8nXVwiKS50ZXh0KGRhdGFbJ21pc3NlZFBvJ10pO1xuICAgICAgICAgICAgJChcIltkYXRhLWlkPVwiK2lkK1wiXVtkYXRhLXBhcmFtPSd6ZXJvUG8nXVwiKS50ZXh0KGRhdGFbJ3plcm9QbyddKTtcblx0XHRcdFx0XHRcdCQoXCIubG9hZGluZ1tkYXRhLWlkPVwiK2lkK1wiXVwiKS5oaWRlKCk7XG5cdFx0XHRcdFx0XHQkdGhpcy5hZGRDbGFzcygnY2hhbmdlZC1wbGF5ZXInKTtcbiAgICAgICAgfSxcbiAgICAgICAgZXJyb3I6IGZ1bmN0aW9uICh4aHIsIGFqYXhPcHRpb25zLCB0aHJvd25FcnJvcikge1xuICAgICAgICAgIGNvbnNvbGUubG9nKHhoci5zdGF0dXMpO1xuICAgICAgICAgIGNvbnNvbGUubG9nKHRocm93bkVycm9yKTtcbiAgICAgICAgfVxuICAgICAgfSk7XG4gIH0pO1xuXG4gICQoXCIubGV0dGVycy1saXN0IGxpXCIpLmNsaWNrKGZ1bmN0aW9uKCl7XG4gICAgdmFyIGxldHRlciA9ICQodGhpcykudGV4dCgpO1xuICAgICQuYWpheCh7XG4gICAgICAgIHR5cGU6ICdwb3N0JyxcbiAgICAgICAgdXJsOiBSb3V0aW5nLmdlbmVyYXRlKCd0ZWFtX2dldF9ieV9sZXR0ZXInLCB7J2xldHRlcic6bGV0dGVyfSksXG4gICAgICAgIGRhdGFUeXBlOiAnanNvbicsXG4gICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKGRhdGEpe1xuICAgICAgICAgICAgdmFyIG5ld0h0bWwgPSBcIlwiO1xuICAgICAgICAgICAgZm9yKHZhciBpPTAsIGNudD1kYXRhLnRlYW1zLmxlbmd0aDsgaSA8IGNudDsgaSsrKXtcbiAgICAgICAgICAgICAgdmFyIGRldGFpbFVybCA9IFJvdXRpbmcuZ2VuZXJhdGUoJ3RlYW1fc2hvdycsIHtcbiAgICAgICAgICAgICAgICAnY29kZSc6IGRhdGEudGVhbXNbaV1bMV19KTtcblxuICAgICAgICAgICAgICBuZXdIdG1sICs9IFwiPGxpPjxhIGhyZWY9J1wiKyBkZXRhaWxVcmwgK1wiJyBjbGFzcz0nc3Bpc2tpJz5cIlxuICAgICAgICAgICAgICAgICsgZGF0YS50ZWFtc1tpXVswXSArIFwiPC9hPjwvbGk+XCI7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICAkKFwiLmNsdWJzLWxpc3RcIikuaHRtbChuZXdIdG1sKTtcbiAgICAgICAgfSxcbiAgICAgICAgZXJyb3I6IGZ1bmN0aW9uICh4aHIsIGFqYXhPcHRpb25zLCB0aHJvd25FcnJvcikge1xuICAgICAgICAgIGNvbnNvbGUubG9nKHhoci5zdGF0dXMpO1xuICAgICAgICAgIGNvbnNvbGUubG9nKHRocm93bkVycm9yKTtcbiAgICAgICAgfVxuICAgICAgfSk7XG4gIH0pO1xuXG4gICQoXCIjc2VsZWN0UGFnZU1hdGNoZXNcIikuY2hhbmdlKGZ1bmN0aW9uKCl7XG4gICAgdmFyIG1heE1hdGNoZXMgPSAkKHRoaXMpLnZhbCgpLFxuICAgICAgcGFyYW1zID0gcGFyc2VVcmxRdWVyeSgpLFxuICAgICAgbmV3QXJyID0gW107XG5cbiAgICAgIHBhcmFtc1snbWF4J10gPSBtYXhNYXRjaGVzO1xuICAgICAgZm9yIChrZXkgaW4gcGFyYW1zKXtcbiAgICAgICAgbmV3QXJyLnB1c2goa2V5ICsgJz0nICsgcGFyYW1zW2tleV0pO1xuICAgICAgfVxuICAgICAgd2luZG93LmxvY2F0aW9uLnNlYXJjaCA9IG5ld0Fyci5qb2luKCcmJyk7XG4gIH0pO1xuXG4gICQoXCJib2R5XCIpLm9uKFwiY2xpY2tcIiwgXCIubmhsLWRhdGVzIHNwYW5bZGF0YS1kYXRlXVwiLCBmdW5jdGlvbigpe1xuICAgIHZhciBkYXRhID0gJCh0aGlzKS5kYXRhKCdkYXRlJyk7XG4gICAgJChcIi5uaGwtbWF0Y2hlcy5jaGFtcHNcIikubG9hZChcIi9uaGwvZGF0ZS9cIiArIGRhdGEgKyBcIiAubmhsLW1hdGNoZXMuY2hhbXBzXCIpO1xuICB9KTtcblxuICAkKFwiI2RhdGVwaWNrZXJcIikuZGF0ZXBpY2tlcigpO1xuXG5cbn0pO1xuXG5mdW5jdGlvbiBzbGljZU1haW5NZW51KHJlc2l6ZSl7XG5cblx0dmFyICRtYWluTWVudSA9ICQoXCIjc3ViTWVudVwiKTtcblx0aWYocmVzaXplID09IHRydWUpe1xuXHRcdCRtYWluTWVudS5maW5kKFwiLnJlbW92ZWRcIikuZWFjaChmdW5jdGlvbihpLCBuZXh0RWxlbWVudCl7XG5cdFx0XHR2YXIgJG5leHRFbGVtZW50ID0gJChuZXh0RWxlbWVudCk7XG5cdFx0XHQkbWFpbk1lbnUuYXBwZW5kKFxuXHRcdFx0XHQkbmV4dEVsZW1lbnQucmVtb3ZlQ2xhc3MoXCJyZW1vdmVkXCIpXG5cdFx0XHQpXG5cdFx0fSk7XG5cdFx0JG1haW5NZW51LmZpbmQoXCIucmVtb3ZlZEl0ZW1zTGlua1wiKS5yZW1vdmUoKTtcblx0fVxuXG5cdHZhciAkbWFpbk1lbnVJdGVtcyA9ICRtYWluTWVudS5jaGlsZHJlbihcImxpXCIpO1xuXHR2YXIgdmlzaWJsZU1lbnVXaWR0aCA9ICRtYWluTWVudS53aWR0aCgpIC0gMTAwO1xuXHR2YXIgd2luZG93V2lkdGggPSAkKHdpbmRvdykud2lkdGgoKSAtIDEyMDtcblx0dmFyIHRvdGFsU3VtTWVudVdpZHRoID0gMDtcblxuXHRcdCRtYWluTWVudUl0ZW1zLmVhY2goZnVuY3Rpb24oaSwgbmV4dEVsZW1lbnQpe1xuXHRcdFx0dmFyICRuZXh0RWxlbWVudCA9ICQobmV4dEVsZW1lbnQpO1xuXHRcdFx0dG90YWxTdW1NZW51V2lkdGggKz0gJG5leHRFbGVtZW50Lm91dGVyV2lkdGgodHJ1ZSk7XG5cblx0XHRcdGlmKHRvdGFsU3VtTWVudVdpZHRoID4gd2luZG93V2lkdGgpe1xuXHRcdFx0XHQkbmV4dEVsZW1lbnQuYWRkQ2xhc3MoXCJyZW1vdmVkXCIpO1xuXHRcdFx0fVxuXHRcdH0pO1xuXHRcdHZhciAkcmVtb3ZlZEl0ZW1zID0gJG1haW5NZW51LmZpbmQoXCIucmVtb3ZlZFwiKTtcblx0XHRpZigkcmVtb3ZlZEl0ZW1zLmxlbmd0aCA+IDApe1xuXHRcdFx0dmFyICRyZW1vdmVkSXRlbXNMaXN0ID0gJChcIjx1bC8+XCIpLmFkZENsYXNzKFwicmVtb3ZlZEl0ZW1zTGlzdFwiKTtcblx0XHRcdHZhciAkcmVtb3ZlZEl0ZW1zTGluayA9ICQoXCI8bGkvPlwiKS5hZGRDbGFzcyhcInJlbW92ZWRJdGVtc0xpbmtcIikuYXBwZW5kKCQoYDxidXR0b24gdHlwZT1cImJ1dHRvblwiIGNsYXNzPVwibmF2YmFyLXRvZ2dsZS1zdWJcIj5cblx0XHRcdFx0XHQ8c3BhbiBjbGFzcz1cImljb24tYmFyXCI+PC9zcGFuPlxuXHRcdFx0XHRcdDxzcGFuIGNsYXNzPVwiaWNvbi1iYXJcIj48L3NwYW4+XG5cdFx0XHRcdFx0PHNwYW4gY2xhc3M9XCJpY29uLWJhclwiPjwvc3Bhbj5cblx0XHRcdDwvYnV0dG9uPmApKTtcblx0XHRcdCRyZW1vdmVkSXRlbXMuZWFjaChmdW5jdGlvbihpLCBuZXh0RWxlbWVudCl7XG5cdFx0XHRcdHZhciAkbmV4dEVsZW1lbnQgPSAkKG5leHRFbGVtZW50KTtcblx0XHRcdFx0JHJlbW92ZWRJdGVtc0xpc3QuYXBwZW5kKFxuXHRcdFx0XHRcdCRuZXh0RWxlbWVudFxuXHRcdFx0XHQpXG5cdFx0XHR9KTtcblx0XHRcdCRtYWluTWVudS5hcHBlbmQoJHJlbW92ZWRJdGVtc0xpbmsuYXBwZW5kKCRyZW1vdmVkSXRlbXNMaXN0KSk7XG5cdFx0XHQvKiRyZW1vdmVkSXRlbXNMaXN0LmNzcyh7XG5cdFx0XHRcdGxlZnQ6ICRyZW1vdmVkSXRlbXNMaW5rLm9mZnNldCgpLmxlZnQgKyBcInB4XCJcblx0XHRcdH0pOyovXG5cdFx0XHQkKFwiLm5hdmJhci10b2dnbGUtc3ViXCIpLm1vdXNlb3ZlcihmdW5jdGlvbigpe1xuXHRcdFx0XHQkKFwiLnJlbW92ZWRJdGVtc0xpc3RcIikuc2hvdygpO1xuXHRcdFx0fSk7XG5cdFx0fVxuXG5cdFx0dmFyIF9fc2VjdGlvbk1lbnVBY3RpdmUgPSBcImFjdGl2ZURyb3BcIjtcblx0XHR2YXIgX19zZWN0aW9uTWVudU1lbnVJRCA9IFwibWVudUNhdGFsb2dTZWN0aW9uXCI7XG5cdFx0dmFyIF9fc2VjdGlvbk1lbnVPcGVuZXIgPSBcIm1lbnVTZWN0aW9uXCI7XG5cdFx0dmFyIF9fc2VjdGlvbk1lbnVEcm9wXHQgPSBcImRyb3BcIjtcblx0XHR2YXIgX19hY3RpdmUgPSBcImFjdGl2ZURyb3BcIjtcblx0XHR2YXIgX19tZW51SUQgPSBcIm1haW5NZW51XCI7XG5cdFx0dmFyIF9fb3BlbmVyID0gXCJlQ2hpbGRcIjtcblx0XHR2YXIgX19kcm9wXHQgPSBcImRyb3BcIjtcblxuXHRcdHZhciAkX3NlbGYgPSAkKFwiI1wiICsgX19tZW51SUQpO1xuXHRcdHZhciAkX2VDaGlsZCA9ICRfc2VsZi5jaGlsZHJlbihcIi5cIiArIF9fb3BlbmVyKTtcblxuXHRcdHZhciBvcGVuQ2hpbGQgPSBmdW5jdGlvbigpe1xuXG5cdFx0XHR2YXIgJF90aGlzID0gJCh0aGlzKTtcblx0XHRcdGlmKCEkX3RoaXMuaGFzQ2xhc3MoXCJyZW1vdmVkXCIpKXtcblxuXHRcdFx0XHRfX21lbnVGaXJzdE9wZW5UaW1lb3V0SUQgPSBzZXRUaW1lb3V0KGZ1bmN0aW9uKCl7XG5cdFx0XHRcdFx0aWYoJF90aGlzLmlzKFwiOmhvdmVyXCIpKXtcblx0XHRcdFx0XHRcdGNsZWFyVGltZW91dChfX21lbnVGaXJzdE9wZW5UaW1lb3V0SUQpO1xuXHRcdFx0XHRcdFx0JF9zZWN0aW9uTWVudUVDaGlsZC5yZW1vdmVDbGFzcyhfX3NlY3Rpb25NZW51QWN0aXZlKS5maW5kKFwiLlwiICsgX19zZWN0aW9uTWVudURyb3ApLmhpZGUoKTtcblx0XHRcdFx0XHRcdCRfZUNoaWxkLnJlbW92ZUNsYXNzKF9fYWN0aXZlKS5maW5kKFwiLlwiICsgX19kcm9wKS5oaWRlKCk7XG5cdFx0XHRcdFx0XHQkX3RoaXMuYWRkQ2xhc3MoX19hY3RpdmUpLmZpbmQoXCIuXCIgKyBfX2Ryb3ApLmNzcyhcImRpc3BsYXlcIiwgXCJ0YWJsZVwiKTtcblx0XHRcdFx0XHRcdHJldHVybiBjbGVhclRpbWVvdXQoX19tZW51VGltZW91dElEKTtcblx0XHRcdFx0XHR9XG5cdFx0XHRcdH0sIDMwMCk7XG5cblx0XHR9XG4gICAgXG5cblx0fVxuXG5cdHZhciBjbG9zZUNoaWxkID0gZnVuY3Rpb24oKXtcblx0XHR2YXIgJF9jYXB0dXJlVGhpcyA9ICQodGhpcyk7XG5cdFx0X19tZW51VGltZW91dElEID0gc2V0VGltZW91dChmdW5jdGlvbigpe1xuXHRcdFx0JF9jYXB0dXJlVGhpcy5yZW1vdmVDbGFzcyhfX2FjdGl2ZSkuZmluZChcIi5cIiArIF9fZHJvcCkuaGlkZSgpO1xuXHRcdH0sIDUwMCk7XG5cdH1cblxuXHQkX2VDaGlsZC5ob3ZlcihvcGVuQ2hpbGQsIGNsb3NlQ2hpbGQpO1xuICAkbWFpbk1lbnUucmVtb3ZlQ2xhc3MoJ3N0YXJ0X21lbnUnKTtcbn1cblxuJCh3aW5kb3cpLm9uKFwicmVzaXplXCIsIGZ1bmN0aW9uKCl7XG5cdHNsaWNlTWFpbk1lbnUodHJ1ZSk7XG59KTtcblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oZXZlbnQpe1xuXHRzbGljZU1haW5NZW51KGZhbHNlKTtcbn0pO1xuXG5cbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ0RPTUNvbnRlbnRMb2FkZWQnLCAoKSA9PiB7XG5cbiAgICBjb25zdCBnZXRTb3J0ID0gKHsgdGFyZ2V0IH0pID0+IHtcbiAgICAgICAgY29uc3Qgb3JkZXIgPSAodGFyZ2V0LmRhdGFzZXQub3JkZXIgPSAtKHRhcmdldC5kYXRhc2V0Lm9yZGVyIHx8IC0xKSk7XG4gICAgICAgIGNvbnN0IGluZGV4ID0gWy4uLnRhcmdldC5wYXJlbnROb2RlLmNlbGxzXS5pbmRleE9mKHRhcmdldCk7XG4gICAgICAgIGNvbnN0IGNvbGxhdG9yID0gbmV3IEludGwuQ29sbGF0b3IoWydlbicsICdydSddLCB7IG51bWVyaWM6IHRydWUgfSk7XG4gICAgICAgIGNvbnN0IGNvbXBhcmF0b3IgPSAoaW5kZXgsIG9yZGVyKSA9PiAoYSwgYikgPT4gb3JkZXIgKiBjb2xsYXRvci5jb21wYXJlKFxuICAgICAgICAgICAgYi5jaGlsZHJlbltpbmRleF0uaW5uZXJUZXh0LFxuICAgICAgICAgICAgYS5jaGlsZHJlbltpbmRleF0uaW5uZXJUZXh0XG4gICAgICAgICk7XG5cbiAgICAgICAgZm9yKGNvbnN0IHRCb2R5IG9mIHRhcmdldC5jbG9zZXN0KCd0YWJsZScpLnRCb2RpZXMpXG4gICAgICAgICAgICB0Qm9keS5hcHBlbmQoLi4uWy4uLnRCb2R5LnJvd3NdLnNvcnQoY29tcGFyYXRvcihpbmRleCwgb3JkZXIpKSk7XG5cbiAgICAgICAgZm9yKGNvbnN0IGNlbGwgb2YgdGFyZ2V0LnBhcmVudE5vZGUuY2VsbHMpXG4gICAgICAgICAgICBjZWxsLmNsYXNzTGlzdC50b2dnbGUoJ3NvcnRlZCcsIGNlbGwgPT09IHRhcmdldCk7XG4gICAgfTtcblx0XHRjb25zdCB0aGVhZCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy50YWJsZV9zb3J0IHRoZWFkIHRyJylbMV07XG5cdFx0Ly9jb25zb2xlLmxvZyh0aGVhZCk7XG5cdFx0aWYodGhlYWQgIT0gdW5kZWZpbmVkKVxuICAgIFx0dGhlYWQuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiBnZXRTb3J0KGV2ZW50KSk7XG5cbn0pO1xuIl0sIm5hbWVzIjpbIiQiLCJkYXRlcGlja2VyIiwicmVnaW9uYWwiLCJjbG9zZVRleHQiLCJwcmV2VGV4dCIsIm5leHRUZXh0IiwiY3VycmVudFRleHQiLCJtb250aE5hbWVzIiwibW9udGhOYW1lc1Nob3J0IiwiZGF5TmFtZXMiLCJkYXlOYW1lc1Nob3J0IiwiZGF5TmFtZXNNaW4iLCJ3ZWVrSGVhZGVyIiwiZGF0ZUZvcm1hdCIsImZpcnN0RGF5IiwiaXNSVEwiLCJzaG93TW9udGhBZnRlclllYXIiLCJ5ZWFyU3VmZml4Iiwic2V0RGVmYXVsdHMiLCJwYXJzZVVybFF1ZXJ5IiwiZGF0YSIsImxvY2F0aW9uIiwic2VhcmNoIiwicGFpciIsInN1YnN0ciIsInNwbGl0IiwiaSIsImxlbmd0aCIsInBhcmFtIiwic2Nyb2xsVG9CbG9jayIsInRvIiwic3BlZWQiLCJvZmZzZXQiLCJzdG9wIiwiYW5pbWF0ZSIsInNjcm9sbFRvcCIsInRvcCIsIm9uIiwiZXZlbnQiLCJwcmV2ZW50RGVmYXVsdCIsInRvZ2dsZUNsYXNzIiwicmVtb3ZlQ2xhc3MiLCJoaWRlIiwibW91c2VvdmVyIiwic2hvdyIsIm1vdXNlb3V0IiwiY2hvc2VuIiwibm9fcmVzdWx0c190ZXh0Iiwic2VhcmNoX2NvbnRhaW5zIiwid2lkdGgiLCJhdHRyIiwiY2hhbmdlIiwidXJsIiwiUm91dGluZyIsImdlbmVyYXRlIiwidmFsIiwid2luZG93IiwiaHJlZiIsImJpbmQiLCJ2YWx1ZSIsImFqYXgiLCJ0eXBlIiwicXVlcnkiLCJkYXRhVHlwZSIsInN1Y2Nlc3MiLCJlbXB0eSIsImVhY2giLCJ0cmFuc2xpdCIsIm5hbWUiLCJhcHBlbmQiLCJub3QiLCJjbGljayIsImNvbnNvbGUiLCJsb2ciLCJlcnJvciIsInhociIsImFqYXhPcHRpb25zIiwidGhyb3duRXJyb3IiLCJkb2N1bWVudCIsImZvcm1fcGxheWVyIiwiaWQiLCJ0ZXh0IiwicmVzcG9uc2UiLCIkdGhpcyIsInRvdXIiLCJjb3VudHJ5Iiwic2Vhc29uIiwiaHRtbCIsImFkZENsYXNzIiwiaGlzdG9yeSIsInB1c2hTdGF0ZSIsInN0YXR1cyIsImFyR2FtZXMiLCJjaGFtcCIsImdhbWUiLCJwdXNoIiwicGFyc2VJbnQiLCJhcnIiLCJKU09OIiwicGFyc2UiLCJmb3JFYWNoIiwiaXRlbSIsInRlYW0iLCJyb3V0ZSIsInR1cm5pciIsInBhcmFtcyIsImNzcyIsInVuZGVmaW5lZCIsImxldHRlciIsIm5ld0h0bWwiLCJjbnQiLCJ0ZWFtcyIsImRldGFpbFVybCIsIm1heE1hdGNoZXMiLCJuZXdBcnIiLCJrZXkiLCJqb2luIiwibG9hZCIsInNsaWNlTWFpbk1lbnUiLCJyZXNpemUiLCIkbWFpbk1lbnUiLCJmaW5kIiwibmV4dEVsZW1lbnQiLCIkbmV4dEVsZW1lbnQiLCJyZW1vdmUiLCIkbWFpbk1lbnVJdGVtcyIsImNoaWxkcmVuIiwidmlzaWJsZU1lbnVXaWR0aCIsIndpbmRvd1dpZHRoIiwidG90YWxTdW1NZW51V2lkdGgiLCJvdXRlcldpZHRoIiwiJHJlbW92ZWRJdGVtcyIsIiRyZW1vdmVkSXRlbXNMaXN0IiwiJHJlbW92ZWRJdGVtc0xpbmsiLCJfX3NlY3Rpb25NZW51QWN0aXZlIiwiX19zZWN0aW9uTWVudU1lbnVJRCIsIl9fc2VjdGlvbk1lbnVPcGVuZXIiLCJfX3NlY3Rpb25NZW51RHJvcCIsIl9fYWN0aXZlIiwiX19tZW51SUQiLCJfX29wZW5lciIsIl9fZHJvcCIsIiRfc2VsZiIsIiRfZUNoaWxkIiwib3BlbkNoaWxkIiwiJF90aGlzIiwiaGFzQ2xhc3MiLCJfX21lbnVGaXJzdE9wZW5UaW1lb3V0SUQiLCJzZXRUaW1lb3V0IiwiaXMiLCJjbGVhclRpbWVvdXQiLCIkX3NlY3Rpb25NZW51RUNoaWxkIiwiX19tZW51VGltZW91dElEIiwiY2xvc2VDaGlsZCIsIiRfY2FwdHVyZVRoaXMiLCJob3ZlciIsInJlYWR5IiwiYWRkRXZlbnRMaXN0ZW5lciIsImdldFNvcnQiLCJfcmVmIiwidGFyZ2V0Iiwib3JkZXIiLCJkYXRhc2V0IiwiaW5kZXgiLCJfdG9Db25zdW1hYmxlQXJyYXkiLCJwYXJlbnROb2RlIiwiY2VsbHMiLCJpbmRleE9mIiwiY29sbGF0b3IiLCJJbnRsIiwiQ29sbGF0b3IiLCJudW1lcmljIiwiY29tcGFyYXRvciIsImEiLCJiIiwiY29tcGFyZSIsImlubmVyVGV4dCIsIl9pdGVyYXRvciIsIl9jcmVhdGVGb3JPZkl0ZXJhdG9ySGVscGVyIiwiY2xvc2VzdCIsInRCb2RpZXMiLCJfc3RlcCIsInMiLCJuIiwiZG9uZSIsInRCb2R5IiwiYXBwbHkiLCJyb3dzIiwic29ydCIsImVyciIsImUiLCJmIiwiX2l0ZXJhdG9yMiIsIl9zdGVwMiIsImNlbGwiLCJjbGFzc0xpc3QiLCJ0b2dnbGUiLCJ0aGVhZCIsInF1ZXJ5U2VsZWN0b3JBbGwiXSwic291cmNlUm9vdCI6IiJ9