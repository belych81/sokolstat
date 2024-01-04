<?php
namespace App\Service;

class Functions
{
  public function truncateText($text, $max, $letter = ' ')
  {
      $length = \strlen($text);
      if($length <= $max)
        return $text;

      $pos = strpos($text, $letter, $max);
      if($pos === false){
        $pos = strpos($text, ' ', $max);
      }
      $truncateText = substr($text, 0, $pos).'...';
      
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

  public function getBombSum(array $bombs, int $limit = 0, string $param = 'goal') :array
  {
    $bombSum = [];
    foreach ($bombs as $val) {
      $name = $val->getPlayer()->getName();
      switch ($param) {
        case 'assist':
          $goal = $val->getAssist();
          break;
        case 'score':
          $goal = $val->getScore();
          break;
        default:
          $goal = $val->getGoal();
          break;
      }
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

  public function getCalendar(array $obMatches, string $entity = 'rfpl'): array
  {
    $calend = [];
    foreach($obMatches as $match) {
      $date = $match->getData()->format('j.n');
      switch($entity) {
        case 'rfpl':
          if($match->getTurnir()->getAlias() == 'russia-champ'){
            $calend['rfpl'][$date][] = $match;
          }
          break;
        case 'tour':
          $turnir = $match->getTurnir()->getAlias();
          $calend[$turnir][$date][] = $match;
            break;
        case 'ec':
          if($match->getStadia()){
            $turnir = $match->getTurnir()->getAlias();
            $stadia = $match->getStadia()->getAlias();
            $calend[$turnir][$stadia][$date][] = $match;
          }
            break;
      }
    }
    return $calend;
  }

}
