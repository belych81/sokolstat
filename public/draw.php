<?php
$pot1 = [
    'москва',
    'спб',
    'екб',
    'казань',
    'нн',
    'самара',
    'ростов',
    'пермь',
    'воронеж'
];
$pot2 = [
    'волгоград',
    'саратов',
    'тюмень',
    'ульяновск',
    'ярославль',
    'рязань',
    'пенза',
    'липецк',
    'киров'
];
$pot3 = [
    'тула',
    'сочи',
    'тверь',
    'иваново',
    'владимир',
    'вологда',
    'смоленск',
    'кострома',
    'зеленоград'
];
$pot4 = [
    'волоколамск',
    'мурманск',
    'тамбов',
    'новгород',
    'псков',
    'анапа',
    'углич',
    'коломна',
    'долгопрудный'
];
$arPots = array_merge($pot1, $pot2, $pot3, $pot4);
$rows = [];
$arResult = [];
$arSelected = [];
$seats = [];

$nextKey = 0;
foreach($arPots as $key => $team){
    $rows[$nextKey][] = $team;
    $nextKey++;
    if($nextKey > 8){
        $nextKey = 0;
    }
    $arResult[$team] = [];
}
//echo "<pre>"; var_dump($rows); echo "</pre>";

function init($team, $numbPot, $n, $arResult, $arSelected, $seats)
{
    global $pot1, $pot2, $pot3, $pot4;

    
    file_put_contents(__DIR__."/logDraw.txt", 'team - ' . $team . "\n", FILE_APPEND);
    //file_put_contents(__DIR__."/logDraw.txt", 'arResult - ' . var_export($arResult, 1) . "\n", FILE_APPEND);
    file_put_contents(__DIR__."/logDraw.txt", 'arSelected - ' . var_export($arSelected, 1) . "\n", FILE_APPEND);

    $pots = [$pot1, $pot2, $pot3, $pot4];

    $teams = [];

    $cntResultTeams = count($arResult[$team]);
    $cntSelected = count($arSelected);
    file_put_contents(__DIR__."/logDraw.txt", 'cntResultTeams - ' . var_export($cntResultTeams, 1) . "\n", FILE_APPEND);
    $drawed = [];

    foreach($arResult as $tt => $arr){
        if(count($arr) == 8){
            $keyDraw = 0;
            foreach($arr as $keySel => $teamSel){
                if($keySel > 1 && $keySel % 2 == 0){
                    $keyDraw++;
                }
                if($drawed[$keyDraw][$teamSel]){
                    $drawed[$keyDraw][$teamSel]++;
                } else {
                    $drawed[$keyDraw][$teamSel] = 1;
                }
            }
        }
    }
    file_put_contents(__DIR__."/logDraw.txt", 'drawed - ' . var_export($drawed, 1) . "\n", FILE_APPEND);
    file_put_contents(__DIR__."/logDraw.txt", 'seats_old - ' . var_export($seats, 1) . "\n", FILE_APPEND);
    foreach($pots as $numb => $pot){
        if($numbPot == $numb){
            unset($pot[$n]);

        }
        $cntDrawed = 0;
        if($drawed[$numb]){
            $cntDrawed = count($drawed[$numb]);
        }
        file_put_contents(__DIR__."/logDraw.txt", 'cntDrawed - ' . var_export($cntDrawed, 1) . "\n", FILE_APPEND);

        foreach($pot as $kt => $tm){
            if(in_array($tm, $arSelected)){
                unset($pot[$kt]);
                continue;
            }
            if($drawed[$numb][$tm] == (2 * ($numbPot +1))){
                unset($pot[$kt]);
            }
        }
        

        $cntDraw = 2;
        
        if($numb == 0){
            $cntDraw -= $cntResultTeams;
        } elseif($cntResultTeams > $numb * 2) {
            $cntDraw = ($numb + 1) * $cntDraw - $cntResultTeams;
        }
        if($numbPot == $numb && $cntSelected == 5 + (9 * $numbPot)){
            if(count($drawed[$numbPot]) < 8){
                foreach($pot as $kt => $tm){
                    if(key_exists($tm, $drawed[$numb])){
                        unset($pot[$kt]);
                    }
                }
            }
        }
        if($cntSelected == 5 + (9 * $numbPot)){
            if($cntDraw == 1 && count($pot) == 2){
                $isDeleteKey = false;
                $deleteKey = false;
                foreach($pot as $kt => $tm){
                    if(!key_exists($tm, $drawed[$numb])){
                        $isDeleteKey = true;
                    } else {
                        $deleteKey = $kt;
                    }
                }
                if($isDeleteKey){
                    unset($pot[$deleteKey]);
                }
            }
        }
        if($cntSelected == 7 + (9 * $numbPot) || ($cntSelected == 6 + (9 * $numbPot) && $cntDrawed < 9)){
            $tm1 = [];
            foreach($drawed[$numb] as $dr => $cntDr){
                if($cntDr == 1){
                    $tm1[] = $dr;
                }
            }
            if(count($tm1) == 2){
                foreach($pot as $kt => $tm){
                    if($tm == $tm1[0]){
                        unset($pot[$kt]);
                        break;
                    }
                }
            }
        }
        if($cntDrawed > 4 && $cntSelected < 7 && $cntDrawed - $cntSelected - ($numbPot * 9) < 2){
            foreach($pot as $kt => $tm){
                if(key_exists($tm, $drawed[$numb])){
                    unset($pot[$kt]);
                }
            }
        }
        file_put_contents(__DIR__."/logDraw.txt", 'pot - ' . var_export($pot, 1) . "\n", FILE_APPEND);
        file_put_contents(__DIR__."/logDraw.txt", 'cntDraw - ' . var_export($cntDraw, 1) . "\n", FILE_APPEND);
        if($cntDraw > 0){
            $randTeamsKeys = [];
            $randTeams = [];
            $rtKey1 = array_rand($pot, 1);
            $seatsKey1 = $numb * 2;
            if(is_array($seats[$seatsKey1]) && in_array($pot[$rtKey1], $seats[$seatsKey1])){
                file_put_contents(__DIR__."/logDraw.txt", 'in_array - ' . var_export($pot[$rtKey1], 1) . "\n", FILE_APPEND);
                file_put_contents(__DIR__."/logDraw.txt", 'seatsKey1 - ' . var_export($seatsKey1, 1) . "\n", FILE_APPEND);
                unset($pot[$rtKey1]);
                $rtKey1 = array_rand($pot, 1);
            }
            $randTeams[] = $pot[$rtKey1];
            unset($pot[$rtKey1]);
            $randTeamsKeys[] = $rtKey1;

            if($cntDraw == 2){
                $rtKey2 = array_rand($pot, 1);
                $seatsKey2 = $numb * 2 + 1;
                if(is_array($seats[$seatsKey2]) && in_array($pot[$rtKey2], $seats[$seatsKey2])){
                    file_put_contents(__DIR__."/logDraw.txt", 'in_array - ' . var_export($pot[$rtKey2], 1) . "\n", FILE_APPEND);
                    file_put_contents(__DIR__."/logDraw.txt", 'seatsKey2 - ' . var_export($seatsKey2, 1) . "\n", FILE_APPEND);
                    unset($pot[$rtKey2]);
                    $rtKey2 = array_rand($pot, 1);
                }
                $randTeams[] = $pot[$rtKey2];
                $randTeamsKeys[] = $rtKey2;
            }
            //$randTeamsKeys = (array)array_rand($pot, $cntDraw);
            $cntDrawTeams = count($teams);
            file_put_contents(__DIR__."/logDraw.txt", 'randTeams - ' . var_export($randTeams, 1) . "\n", FILE_APPEND);
            foreach($randTeams as $krt => $itemRt){
                if(!empty($seats) && in_array($itemRt, $seats[$cntDrawTeams + $krt])){
                    if($krt == 0){
                        $teams[$cntDrawTeams + 1] = $itemRt;
                        $teams[$cntDrawTeams] = $randTeams[1];
                    } else {
                        $teams[$cntDrawTeams] = $itemRt;
                        $teams[$cntDrawTeams + 1] = $randTeams[0];
                    }
                    break 1;
                } else {
                    $teams[] = $itemRt;
                }
            }
        }
    }

    

    $allTeams = array_merge($arResult[$team], $teams);

    $ar1 = [0, 2, 4, 6];
    $ar2 = [1, 3, 5, 7];
    file_put_contents(__DIR__."/logDraw.txt", 'allTeams - ' . var_export($allTeams, 1) . "\n", FILE_APPEND);
    foreach($allTeams as $kat => $tat){
        /*if($seats[$kat] && in_array($tat, $seats[$kat])){
            if(in_array($kat, $ar1)){
                $allTeams[$kat] = $allTeams[$kat+1];
                $allTeams[$kat+1] = $tat;
                $seats[$kat][] = $allTeams[$kat+1];
            } else {
                $allTeams[$kat] = $allTeams[$kat-1];
                $allTeams[$kat-1] = $tat;
                $seats[$kat][] = $allTeams[$kat-1];
            }
        } else {*/
            $seats[$kat][] = $tat;
        //}
    }
    file_put_contents(__DIR__."/logDraw.txt", 'seats - ' . var_export($seats, 1) . "\n", FILE_APPEND);
    $result = [];
    $result['team'] = $team;
    $result['teams'] = $teams;
    $result['drawed'] = $drawed;
    $result['all_teams'] = $allTeams;
    $arResult[$team] = array_merge($arResult[$team], $teams);

    foreach($teams as $item){
        $arResult[$item][] = $team;
    }
    $result['arResult'] = $arResult;
    $result['seats'] = $seats;
    
    $arSelected[] = $team;
    $result['arSelected'] = $arSelected;

    echo json_encode($result);
    //echo "<pre>"; var_dump($teams); echo "</pre>";
}

if($_POST['team']){
    $team = htmlspecialchars($_POST['team']);
    $pot = intval($_POST['pot']);
    $n = intval($_POST['n']);
    $arResult = json_decode($_POST['arResult'], 1);
    $arSelected = json_decode($_POST['arSelected'], 1);
    $seats = json_decode($_POST['seats'], 1);

    init($team, $pot, $n, $arResult, $arSelected, $seats);

    die();
}
?>
<!DOCTYPE html>
    <head>
        <title>Жеребьевка</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            table {
                max-width: 800px;
            }
            td {
                cursor: pointer;
            }
            td.select {
                background: green;
                color: #fff;
                cursor: auto;
            }
            td.selected {
                background: #936;
                color: #fff;
                cursor: auto;
            }
            .head_block {
                display: flex;
                align-items: flex-start;
                gap: 50px;
            }
            .current_result {
                width: 200px;
            }
            .all_results {
                max-height: 800px;
                overflow-y: scroll;
               
                margin-bottom: 15px;
            }
            .team_results {
                border: 1px solid #ccc;
            }
            .team_results td {
                width: 150px;
                height: 40px;
                border: 1px solid #ccc;
                border-collapse: collapse;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <div class="head_block">
            <table class="table">
                <thead>
                    <th>Корзина 1</th>
                    <th>Корзина 2</th>
                    <th>Корзина 3</th>
                    <th>Корзина 4</th>
                </thead>
                <tbody>      
                    <? foreach($rows as $n => $row){ ?>     
                        <tr>
                            <? foreach($row as $key => $team){ ?>
                                <td data-pot="<?= $key ?>" data-n="<?= $n ?>"><?= $team ?></td>
                            <? } ?>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
            <div class="current_result">
                <h2></h2>
                <ol></ol>
            </div>
            <div class="all_results">
                <? foreach($arPots as $item){ ?>
                    <div data-team="<?= $item ?>">
                        <h3><?= $item ?></h3>
                        <table class="team_results">
                            <tbody>
                                <tr>
                                    <td data-n="0"></td><td data-n="1"></td><td data-n="2"></td><td data-n="3"></td>
                                </tr>
                                <tr>
                                    <td data-n="4"></td><td data-n="5"></td><td data-n="6"></td><td data-n="7"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <? } ?>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>   
    
    <script>
        let arResult = <?= json_encode($arResult) ?>;
        let arSelected = <?= json_encode($arSelected) ?>;
        let seats = <?= json_encode($seats) ?>;
        //console.log(arResult)
        $(document).on('click', 'td:not(.selected):not(.select)', function(){
            let th = $(this);
            let pot = th.data('pot');
            let n = th.data('n');
            let team = th.text();
            console.log(pot);
            console.log(team);
            //console.log(arResult)
            $('td.select').removeClass('select').addClass('selected');
            th.addClass('select');
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {team: team, pot: pot, n: n, arResult: JSON.stringify(arResult), arSelected: JSON.stringify(arSelected), seats: JSON.stringify(seats)},
                success: function(response){
                    console.log('success', response);
                    $(".current_result h2").text(response.team)
                    $(".current_result ol").html('');
                    response.all_teams.forEach((element, i) => setTimeout(() => $(".current_result ol").append("<li>" + element + "</li>"), i * 400));
                    let teamsTd = {};
                    console.log(pot == 0);
                    let seatDraw;
                    if(pot == 0){
                        seatDraw = [
                            1, 0, 1, 0, 1, 0, 1, 0
                        ];
                    }else if(pot == 1){
                        seatDraw = [
                            3, 2, 3, 2, 3, 2, 3, 2
                        ];
                    }else if(pot == 2){
                        seatDraw = [
                            5, 4, 5, 4, 5, 4, 5, 4
                        ];
                    } else {
                        seatDraw = [
                            7, 6, 7, 6, 7, 6, 7, 6
                        ];
                    }
                    let replaceSeat = [1, 0, 3, 2, 5, 4, 7, 6];
                    let isReplace = false;
                    let oldTeamSeat = '';
                    response.teams.forEach((element, i) => setTimeout(() => {
                        $(".all_results [data-team='"+ response.team +"'] .team_results td").each(function(index){
                            if($(this).text() == ''){
                                isReplace = false; 
                                oldTeamSeat = '';
                                /*$(".all_results .team_results td[data-n="+index+"]").each(function(ind){
                                    if($(this).text() == element){
                                        console.log('element', element)
                                        console.log('index', index)
                                        console.log('ind', ind)
                                        $(".all_results [data-team='"+ response.team +"'] .team_results td").each(function(i){
                                            if(i == replaceSeat[index]){
                                                if($(this).text() != ''){
                                                    oldTeamSeat = $(this).text();
                                                }
                                                $(this).text(element);
                                            }
                                        });
                                        if(oldTeamSeat != ''){
                                            $(".all_results [data-team='"+ response.team +"'] .team_results td").each(function(i){
                                                if(i == index){
                                                    $(this).text(oldTeamSeat);
                                                    oldTeamSeat = '';
                                                }
                                            });
                                        }
                                        isReplace = true;
                                    }
                                });*/
                                if(!isReplace){
                                    $(this).text(element);
                                }
                                teamsTd[element] = index;
                                return false;
                            }
                        });
                    }, i * 400));
                    console.log(teamsTd);
                    response.all_teams.forEach((element, i) => setTimeout(() => {
                        $(".all_results [data-team='"+ element +"'] .team_results td").each(function(index){
                            if(index == seatDraw[teamsTd[element]]){
                                $(this).text(response.team);
                            }
                        });
                    }, i * 400));
                    
                    arResult = response.arResult;
                    arSelected = response.arSelected;
                    seats = response.seats;

                },
                error: function(xhr, status, text){
                    console.log('xhr', xhr);
                    console.log('status', status);
                    console.log('text', text);
                }
            })
        })
    </script>
</body>
</html>