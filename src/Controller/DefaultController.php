<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Rfplmatch;
use App\Entity\Eurocup;
use App\Service\Rating;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{

  public function rating(Rating $rating)
  {
    $fromDate = new \DateTime('now');
    $fromDate->setTime(0, 0, 0);
    $fromDate->modify('-1 year');
    $club = 'РЕАЛ';
    $notStadia = [18, 19, 20, 21, 25];
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
      $stadia = $match->getStadia()->getId();
      if(in_array($stadia, $notStadia)) continue;

      if($team == $club || $team2 == $club){
        //echo $team." - ".$team2." - ".$match->getScore();
      }
      $data = strtotime($match->getData()->format('d.m.Y'));
      $diffDate = strtotime('now') - $data;
      $monthSec = 30*24*60*60;
      $addMonth = $rating->getAddMonth($diffDate, $monthSec);
      $differ = $goal1 - $goal2;
      $arScores = $rating->getScore($differ);
      $score1 = $arScores[0];
      $score2 = $arScores[1];

      $coef = $rating->getCoefEc($score1, $turnir);
      $coef2 = $rating->getCoefEc($score2, $turnir);
//var_dump($match->getTeam2()->getCountry()->getName());
//var_dump($rating->checkCountry($match->getTeam2()->getCountry()->getName()));
//echo "<br/>";
      if($rating->checkCountry($match->getTeam()->getCountry()->getName())){
        if(array_key_exists($team, $teamsRating)){
          $teamsRating[$team] += $score1 * $addMonth * $coef;
          if($team == $club){
            /*var_dump($score1);
            var_dump($addMonth);
            var_dump($coef);
            var_dump($score1 * $addMonth * $coef);
            echo "<br/>";*/
          }
        } else {
          $teamsRating[$team] = $score1 * $addMonth * $coef;
          if($team == $club){
            /*var_dump($score1);
            var_dump($addMonth);
            var_dump($coef);
            var_dump($score1 * $addMonth * $coef);
            echo "<br/>";*/
          }
        }
      }
      if($rating->checkCountry($match->getTeam2()->getCountry()->getName())){
        if(array_key_exists($team2, $teamsRating)){
          if($team2 == $club){
            /*var_dump($score2);
            var_dump($addMonth);
            var_dump($coef2);
            var_dump($score2 * $addMonth * $coef2);
            echo "<br/>";*/
          }
          $teamsRating[$team2] += $score2 * $addMonth * $coef2;
        } else {
          $teamsRating[$team2] = $score2 * $addMonth * $coef2;
          if($team2 == $club){
            /*var_dump($score2);
            var_dump($addMonth);
            var_dump($coef2);
            var_dump($score2 * $addMonth * $coef2);
            echo "<br/>";*/
          }
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
      //echo $team." - ".$team2." - ".$goal1.":".$goal2;
      }
      $addMonth = $rating->getAddMonth($diffDate, $monthSec);
      $differ = $goal1 - $goal2;
      $arScores = $rating->getScore($differ);
      $score1 = $arScores[0];
      $score2 = $arScores[1];

      $coef = $rating->getCoef($score1, $country);
      $coef2 = $rating->getCoef($score2, $country);

      if(array_key_exists($team, $teamsRating)){
        $teamsRating[$team] += $score1 * $addMonth * $coef;
        if($team == $club){
          /*var_dump($score1);
          var_dump($addMonth);
          var_dump($coef);
          var_dump($score1 * $addMonth * $coef);
          echo "<br/>";*/
        }
      } else {
        $teamsRating[$team] = $score1 * $addMonth * $coef;
        if($team == $club){
          /*var_dump($score1);
          var_dump($addMonth);
          var_dump($coef);
          var_dump($score1 * $addMonth * $coef);
          echo "<br/>";*/
        }
      }
      if(array_key_exists($team2, $teamsRating)){
        $teamsRating[$team2] += $score2 * $addMonth * $coef2;
        if($team2 == $club){
          /*var_dump($score2);
          var_dump($addMonth);
          var_dump($coef2);
          var_dump($score2 * $addMonth * $coef2);
          echo "<br/>";*/
        }
      } else {
        $teamsRating[$team2] = $score2 * $addMonth * $coef2;
        if($team2 == $club){
          /*var_dump($score2);
          var_dump($addMonth);
          var_dump($coef2);
          var_dump($score2 * $addMonth * $coef2);
          echo "<br/>";*/
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
