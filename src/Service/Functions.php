<?php
namespace App\Service;

class Functions
{
  public function truncateText($text, $max)
  {
      $length = \strlen($text);
      $truncateText = ($length > $max ? substr($text, 0, strpos($text, ' ', $max)).'...' : $text);
      return $truncateText;
  }

  public function getParamUrl($param, $url)
  {
      $paramsUrl = [];
      $urlComponents = parse_url($url);

      if (\array_key_exists('query', $urlComponents)) {
          parse_str(($urlComponents['query'] ?? ''), $paramsUrl);
          if(\array_key_exists($param, $paramsUrl)) {
            return $paramsUrl[$param];
          }
      }
      return false;
  }

  public function filterToUrl(array $filter) :string
  {
    $str = '';
    foreach ($filter as $key => $value) {
      if($value){
        $str .= '&'.$key.'='.$value;
      }
    }
    return $str;
  }

  public function getBombSum(array $bombs, int $limit = 0) :array
  {
    $bombSum = [];
    foreach ($bombs as $val) {
      $name = $val->getPlayer()->getName();
      $goal = $val->getGoal();
      $team = $val->getTeam()->getName();
      if(key_exists($name, $bombSum)){
        $bombSum[$name]['goal'] += $goal;
        $bombSum[$name]['team'] .= " / ".$team;
      } else {
        $bombSum[$name] = ['player' => $val, 'goal' => $goal, 'team' => $team];
      }
    }
    uasort($bombSum, ['App\Service\Sort', 'sortByGoal']);
    if($limit) {
      $bombSum = array_slice($bombSum, 0, $limit);
    }
    return $bombSum;
  }

  public function getNewspaperBomb(array $bombs) :array
  {
    $min = 5;
    $max = 10;

    $arBombs = [];
    $i = 0;
    foreach ($bombs as $name => $bomb) {
      if($i <= $min || ($i <= $max && key_exists($bomb['goal'], $arBombs))) {
        $arBombs[$bomb['goal']][] = $name.' ('.$bomb['team'].')';
      }
      ++$i;
    }
    foreach ($arBombs as $goal => &$arr) {
      $arr = implode(', ', $arr);
    }
    return $arBombs;
  }

  public function morph(int $n, string $f1, string $f2, string $f5) :string
  {
      $n = abs(intval($n)) % 100;
      if ($n > 10 && $n < 20) return $f5;
      $n = $n % 10;
      if ($n > 1 && $n < 5) return $f2;
      if ($n == 1) return $f1;
      return $f5;
  }

  public function getCalendar(array $obMatches, bool $isRussia = false): array
  {
    $calend = [];
    foreach($obMatches as $match) {
      $date = $match->getData()->format('j.n');
      if($isRussia){
        $calend[$date][] = $match;
      } else {
        $country = $match->getCountry()->getName();
        $calend[$country][$date][] = $match;
      }
    }
    return $calend;
  }

}
