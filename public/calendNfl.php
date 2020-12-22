<?php
$teams = [
  1 => [
    1=> [
      'real', 'atletico', 'barcelona', 'sevilla', 'lyon'
    ],
    2=> [
      'liverpool', 'volverhampton', 'lester', 'psg', 'lilles'
    ],
    3=> [
      'man-city', 'man-united', 'chelsea', 'tottenham', 'arsenal'
    ]
  ],
  2 => [
    4 => [
      'juventus', 'milano', 'inter', 'roma', 'lazio'
    ],
    5 => [
      'borussia', 'bayern', 'leipzig', 'shakhtar', 'atalanta'
    ],
    6 => [
      'zenit', 'spartak', 'cska', 'lokomotiv', 'krasnodar'
    ]
  ]
];

$matches = [];

$i = 0;
foreach($teams as $key => $conf){
  foreach($conf as $k => $divis){
    foreach ($divis as $team) {
      $sm = array_fill(0, 8, $team);
      $matches = array_merge($matches, $sm);
      foreach($matches as $val){
        if($val != $team && ($i+1)*8 > $k)
      }
      $i++;
    }
  }
}

echo "<pre>";
var_dump($matches);
echo "</pre>";
?>
