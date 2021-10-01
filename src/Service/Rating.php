<?php
namespace App\Service;

class Rating
{
    public function getAddMonth($diffDate, $monthSec)
    {
      if($diffDate > $monthSec*11){
        $addMonth = 1;
      } elseif($diffDate > $monthSec*10){
        $addMonth = 2;
      } elseif($diffDate > $monthSec*9){
        $addMonth = 3;
      } elseif($diffDate > $monthSec*8){
        $addMonth = 4;
      } elseif($diffDate > $monthSec*7){
        $addMonth = 5;
      } elseif($diffDate > $monthSec*6){
        $addMonth = 6;
      } elseif($diffDate > $monthSec*5){
        $addMonth = 7;
      } elseif($diffDate > $monthSec*4){
        $addMonth = 8;
      } elseif($diffDate > $monthSec*3){
        $addMonth = 9;
      } elseif($diffDate > $monthSec*2){
        $addMonth = 10;
      } elseif($diffDate > $monthSec){
        $addMonth = 11;
      } else {
        $addMonth = 12;
      }

      return $addMonth;
    }

    public function getScore($differ)
    {
      switch ($differ) {
        case 0:
          $score1 = $score2 = 1;
          break;
        case 1:
          $score1 = 2;
          $score2 = -1;
            break;
        case 2:
          $score1 = 3;
          $score2 = -2;
            break;
        case 3:
          $score1 = 4;
          $score2 = -3;
          break;
        case 4:
          $score1 = 5;
          $score2 = -4;
          break;
        case 5:
          $score1 = 6;
          $score2 = -5;
            break;
        case 6:
          $score1 = 7;
          $score2 = -6;
            break;
        case 7:
          $score1 = 8;
          $score2 = -7;
            break;
        case 8:
          $score1 = 9;
          $score2 = -8;
            break;
        case 9:
          $score1 = 10;
          $score2 = -9;
            break;
        case -1:
          $score2 = 2;
          $score1 = -1;
            break;
        case -2:
          $score2 = 3;
          $score1 = -2;
            break;
        case -3:
          $score2 = 4;
          $score1 = -3;
            break;
        case -4:
          $score2 = 5;
          $score1 = -4;
            break;
        case -5:
          $score2 = 6;
          $score1 = -5;
            break;
        case -6:
          $score2 = 7;
          $score1 = -6;
            break;
        case -7:
          $score2 = 8;
          $score1 = -7;
            break;
        case -8:
          $score2 = 9;
          $score1 = -8;
            break;
        case -9:
          $score1 = 10;
          $score2 = -9;
            break;
      }

      return [$score1, $score2];
    }

    public function getCoefEc($score, $turnir)
    {
      if($score > 0){
        switch ($turnir) {
          case 'ЛЧ' :
          case 'СК' :
            $coef = 9;
            break;
          case 'ЛЕ' :
          case 'КЧМ' :
            $coef = 7;
            break;
          case 'ЛК' :
            $coef = 6;
            break;
        }
      } else {
        switch ($turnir) {
          case 'ЛЧ' :
          case 'СК' :
            $coef = 1;
            break;
          case 'ЛЕ' :
          case 'КЧМ' :
            $coef = 3;
            break;
          case 'ЛК' :
            $coef = 4;
            break;
        }
      }
      return $coef;
    }

    public function getCoef($score, $country)
    {
      if($score > 0){
        switch ($country) {
          case 'Англия' :
          case 'Испания' :
            $coef = 5;
            break;
          case 'Италия' :
          case 'Германия' :
            $coef = 5;
            break;
          case 'Франция' :
            $coef = 5;
            break;
          case 'Россия' :
            $coef = 3;
            break;
        }
      } else {
        switch ($country) {
          case 'Англия' :
          case 'Испания' :
            $coef = 5;
            break;
          case 'Италия' :
          case 'Германия' :
            $coef = 5;
            break;
          case 'Франция' :
            $coef = 5;
            break;
          case 'Россия' :
            $coef = 7;
            break;
        }
      }
      return $coef;
    }

    public function checkCountry($country){
      $arCountry = ['Россия', 'Англия', 'Испания', 'Италия', 'Германия', 'Франция'];
      if(in_array($country, $arCountry)){
        return true;
      }
      return false;
    }

}
 ?>
