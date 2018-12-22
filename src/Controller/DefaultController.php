<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Rfplmatch;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{

  public function rating()
  {
    $fromDate = new \DateTime('now');
    $fromDate->setTime(0, 0, 0);
    $fromDate->modify('-1 year');

    $matches = $this->getDoctrine()->getRepository(Tour::class)
      ->findByLastYear($fromDate);
    $matchesRus = $this->getDoctrine()->getRepository(Rfplmatch::class)
        ->findByLastYear($fromDate);
    $matches = array_merge($matches, $matchesRus);

    $teamsRating = [];
    foreach ($matches as $key => $match) {
      $goal1 = $match->getGoal1();
      $goal2 = $match->getGoal2();
      $team = $match->getTeam()->getName();
      $team2 = $match->getTeam2()->getName();
      $country = $match->getTeam()->getCountry()->getName();
                                                                                                                                                  
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

}
      if(array_key_exists($team, $teamsRating)){
        $teamsRating[$team] += $score1;
      } else {
        $teamsRating[$team] = $score1;
      }
      if(array_key_exists($team2, $teamsRating)){
        $teamsRating[$team2] += $score2;
      } else {
        $teamsRating[$team2] = $score2;
      }
    }
    \arsort($teamsRating);

    return $this->render('default/index.html.twig', [
            'matches' => $matches,
            'rating' => $teamsRating
        ]);
  }
}
