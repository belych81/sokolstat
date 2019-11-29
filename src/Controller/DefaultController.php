<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Rfplmatch;
use App\Entity\Eurocup;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{

  public function rating()
  {
    $fromDate = new \DateTime('now');
    $fromDate->setTime(0, 0, 0);
    $fromDate->modify('-1 year');
    $club = 'АЙНТРАХТ Ф';

    $matches = $this->getDoctrine()->getRepository(Tour::class)
      ->findByLastYear($fromDate);
    $matchesRus = $this->getDoctrine()->getRepository(Rfplmatch::class)
        ->findByLastYear($fromDate);
    $matchesEc = $this->getDoctrine()->getRepository(Eurocup::class)
        ->findByLastYear($fromDate);
    $matches = array_merge($matches, $matchesRus);

    $teamsRating = [];
    foreach ($matchesEc as $key => $match) {
      $arScore = explode("-", $match->getScore());
      $goal1 = $arScore[0];
      $goal2 = intval($arScore[1]);
      $team = $match->getTeam()->getName();
      $team2 = $match->getTeam2()->getName();
      $turnir = $match->getTurnir()->getName();
      if($team == $club || $team2 == $club){
      echo $team." - ".$team2." - ".$match->getScore();
    }
      $data = strtotime($match->getData()->format('d.m.Y'));
      $diffDate = strtotime('now') - $data;
      $monthSec = 30*24*60*60;
      if($diffDate > $monthSec*11){
        $addMonth = 0;
      } elseif($diffDate > $monthSec*10){
        $addMonth = 1;
      } elseif($diffDate > $monthSec*9){
        $addMonth = 2;
      } elseif($diffDate > $monthSec*8){
        $addMonth = 3;
      } elseif($diffDate > $monthSec*7){
        $addMonth = 4;
      } elseif($diffDate > $monthSec*6){
        $addMonth = 5;
      } elseif($diffDate > $monthSec*5){
        $addMonth = 6;
      } elseif($diffDate > $monthSec*4){
        $addMonth = 7;
      } elseif($diffDate > $monthSec*3){
        $addMonth = 8;
      } elseif($diffDate > $monthSec*2){
        $addMonth = 9;
      } elseif($diffDate > $monthSec){
        $addMonth = 10;
      } else {
        $addMonth = 11;
      }
      $differ = $goal1 - $goal2;
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
      }

      if($score1 > 0){
        switch ($turnir) {
          case 'ЛЧ' :
          case 'СК' :
            $coef = 9;
            break;
            case 'ЛЕ' :
              $coef = 6;
              break;
        }
      } else {
        switch ($turnir) {
          case 'ЛЧ' :
          case 'СК' :
            $coef = 4;
            break;
            case 'ЛЕ' :
              $coef = 5;
              break;
        }
      }

      if($score2 > 0){
        switch ($turnir) {
          case 'ЛЧ' :
          case 'СК' :
            $coef2 = 9;
            break;
            case 'ЛЕ' :
              $coef2 = 6;
              break;
        }
      } else {
        switch ($turnir) {
          case 'ЛЧ' :
          case 'СК' :
            $coef2 = 2;
            break;
            case 'ЛЕ' :
              $coef2 = 5;
              break;
        }
      }

      if(array_key_exists($team, $teamsRating)){
        $teamsRating[$team] += ($score1 + $addMonth) * $coef;
        if($team == $club){
          var_dump($score1);
          var_dump($addMonth);
          var_dump($coef);
          var_dump(($score1 + $addMonth) * $coef);
          echo "<br/>";
        }
      } else {
        $teamsRating[$team] = ($score1 + $addMonth)*$coef;
        if($team == $club){
          var_dump($score1);
          var_dump($addMonth);
          var_dump($coef);
          var_dump(($score1 + $addMonth) * $coef);
          echo "<br/>";
        }
      }
      if(array_key_exists($team2, $teamsRating)){
        if($team2 == $club){
          var_dump($score2);
          var_dump($addMonth);
          var_dump($coef2);
          var_dump(($score2 + $addMonth) * $coef2);
          echo "<br/>";
        }
        $teamsRating[$team2] += ($score2 + $addMonth)*$coef2;
      } else {
        $teamsRating[$team2] = ($score2 + $addMonth)*$coef2;
        if($team2 == $club){
          var_dump($score2);
          var_dump($addMonth);
          var_dump($coef2);
          var_dump(($score2 + $addMonth) * $coef2);
          echo "<br/>";
        }
      }
    }

    foreach ($matches as $key => $match) {
      $goal1 = $match->getGoal1();
      $goal2 = $match->getGoal2();
      $team = $match->getTeam()->getName();
      $team2 = $match->getTeam2()->getName();
      $country = $match->getTeam()->getCountry()->getName();
      $data = strtotime($match->getData()->format('d.m.Y'));
      $diffDate = strtotime('now') - $data;
      $monthSec = 30*24*60*60;
      if($team == $club || $team2 == $club){
      echo $team." - ".$team2." - ".$goal1.":".$goal2;
    }
      if($diffDate > $monthSec*11){
        $addMonth = 0;
      } elseif($diffDate > $monthSec*10){
        $addMonth = 1;
      } elseif($diffDate > $monthSec*9){
        $addMonth = 2;
      } elseif($diffDate > $monthSec*8){
        $addMonth = 3;
      } elseif($diffDate > $monthSec*7){
        $addMonth = 4;
      } elseif($diffDate > $monthSec*6){
        $addMonth = 5;
      } elseif($diffDate > $monthSec*5){
        $addMonth = 6;
      } elseif($diffDate > $monthSec*4){
        $addMonth = 7;
      } elseif($diffDate > $monthSec*3){
        $addMonth = 8;
      } elseif($diffDate > $monthSec*2){
        $addMonth = 9;
      } elseif($diffDate > $monthSec){
        $addMonth = 10;
      } else {
        $addMonth = 11;
      }
      $differ = $goal1 - $goal2;
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
              case -1:
              $score2 = -2;
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
        default:
          // code...
          break;
      }

      if($score1 > 0){
        switch ($country) {
          case 'Англия' :
          case 'Испания' :
            $coef = 6;
            break;
            case 'Италия' :
            case 'Германия' :
              $coef = 6;
              break;
              case 'Франция' :
                $coef = 5;
                break;
                case 'Россия' :
                  $coef = 4;
                  break;
        }
      } else {
        switch ($country) {
          case 'Англия' :
          case 'Испания' :
            $coef = 6;
            break;
            case 'Италия' :
            case 'Германия' :
              $coef = 6;
              break;
              case 'Франция' :
                $coef = 7;
                break;
                case 'Россия' :
                  $coef = 8;
                  break;
        }
      }

      if(array_key_exists($team, $teamsRating)){
        $teamsRating[$team] += ($score1 + $addMonth) * $coef;
        if($team == $club){
          var_dump(($score1 + $addMonth) * $coef);
          echo "<br/>";
        }
      } else {
        $teamsRating[$team] = ($score1 + $addMonth)*$coef;
        if($team == $club){
          var_dump(($score1 + $addMonth) * $coef);
          echo "<br/>";
        }
      }
      if(array_key_exists($team2, $teamsRating)){
        $teamsRating[$team2] += ($score2 + $addMonth)*$coef;
        if($team2 == $club){
          var_dump(($score2 + $addMonth) * $coef);
          echo "<br/>";
        }
      } else {
        $teamsRating[$team2] = ($score2 + $addMonth)*$coef;
        if($team2 == $club){
          var_dump(($score2 + $addMonth) * $coef);
          echo "<br/>";
        }
      }
    }

    \arsort($teamsRating);

    return $this->render('default/index.html.twig', [
            'matches' => $matches,
            'rating' => $teamsRating
        ]);
  }
}
