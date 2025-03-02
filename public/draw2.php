<?php
echo rand(1, 6);
return;

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

    foreach($pots as $kPot => $potItem){
        foreach($potItem as $kP => $pit){
            if($pit == $team){
                unset($pots[$kPot][$kP]);
            }
        }
    }

    foreach($pots as $kPot => $potItem){
        $keyDraw = array_rand($potItem, 1);
        $teams[] = $potItem[$keyDraw];
        unset($potItem[$keyDraw]);
        $keyDraw = array_rand($potItem, 1);
        $teams[] = $potItem[$keyDraw];
    }

    

    $allTeams = array_merge($arResult[$team], $teams);
    file_put_contents(__DIR__."/logDraw.txt", 'allTeams - ' . var_export($allTeams, 1) . "\n", FILE_APPEND);
    $result = [];
    $result['team'] = $team;
    $result['teams'] = $teams;
    $result['all_teams'] = $allTeams;
    $arResult[$team] = array_merge($arResult[$team], $teams);

    foreach($teams as $item){
        $arResult[$item][] = $team;
    }
    $result['arResult'] = $arResult;
    
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
                data: {team: team, pot: pot, n: n, arResult: JSON.stringify(arResult), arSelected: JSON.stringify(arSelected)},
                success: function(response){
                    $(".current_result h2").text(response.team)
                    $(".current_result ol").html('');
                    response.all_teams.forEach((element, i) => setTimeout(() => $(".current_result ol").append("<li>" + element + "</li>"), i * 400));
                    
                    arResult = response.arResult;
                    arSelected = response.arSelected;

                    console.log('success', response);
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