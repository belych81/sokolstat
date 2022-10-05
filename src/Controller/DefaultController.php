<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Rfplmatch;
use App\Entity\Eurocup;
use App\Entity\Shipplayer;
use App\Entity\Fnlplayer;
use App\Entity\Rusplayer;
use App\Entity\Gamers;
use App\Entity\Shiptable;
use App\Entity\Cup;
use App\Entity\RusSupercup;
use App\Entity\NationSupercup;
use App\Entity\UefaSupercup;
use App\Entity\NationCup;
use App\Entity\CupLeague;
use App\Entity\Player;
use App\Entity\Team;
use App\Entity\News;
use App\Entity\Mundial;
use App\Entity\Ectable;
use App\Entity\Game;
use App\Entity\Transfer;
use App\Service\Rating;
use App\Service\Props;
use App\Service\Functions;
use App\Service\Newspaper;
use App\Service\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends AbstractController
{
  public function index(Props $props, Functions $functions)
  {
      $bombTotal5 = $this->getDoctrine()->getRepository(Shipplayer::class)
        ->getBombSum($props->getLastSeason());
      $bombTotalRus = $this->getDoctrine()->getRepository(Gamers::class)
        ->getBombSum($props->getLastSeason());
      $bombTotal = array_merge($bombTotal5, $bombTotalRus);
      uasort($bombTotal, ['App\Service\Sort', 'sortBySum']);
      $bombTotal = array_slice($bombTotal, 0, 20);

      $curmatch = $this->getDoctrine()->getRepository(Game::class)
          ->getCurMatches();
      $tommatch = $this->getDoctrine()->getRepository(Game::class)
          ->getTomMatches();
      $yestmatch = $this->getDoctrine()->getRepository(Game::class)
          ->getYesterdayMatches();

      $birthdays = $this->getDoctrine()->getRepository(Player::class)
        ->getBirthdayPlayer(date('m-d'));
      $lastPlayers = $this->getDoctrine()->getRepository(Player::class)
        ->getLastPlayer();

      $entities = $this->getDoctrine()->getRepository(News::class)->getNews(10, 0);
      foreach ($entities as $v) {
        $v->setText($functions->truncateText($v->getText(), 500));
      }
      $limitRusplayers = 10;
      $topMatchesRus = $this->getDoctrine()->getRepository(Rusplayer::class)
        ->getTopPlayers($limitRusplayers, 'game');
      $topMatchesRusCurr = $this->getDoctrine()->getRepository(Rusplayer::class)
        ->getTopPlayersCurr($limitRusplayers, 'game', $props->getLastSeason());
      $topGoalsRus = $this->getDoctrine()->getRepository(Rusplayer::class)
        ->getTopPlayers($limitRusplayers, 'goal');
      $topGoalsRusCurr = $this->getDoctrine()->getRepository(Rusplayer::class)
        ->getTopPlayersCurr($limitRusplayers, 'goal', $props->getLastSeason());
      $topGoalkeepers = $this->getDoctrine()->getRepository(Rusplayer::class)
        ->getTopGoalkeepers($limitRusplayers);
      $topGoalkeepersCurr = $this->getDoctrine()->getRepository(Rusplayer::class)
        ->getTopGoalkeepersCurr($limitRusplayers, $props->getLastSeason());
      $maxAgePlayers = $this->getDoctrine()->getRepository(Gamers::class)
              ->getAgeListPlayers($props->getLastSeason(), 'ASC');
      $minAgePlayers = $this->getDoctrine()->getRepository(Gamers::class)
              ->getAgeListPlayers($props->getLastSeason(), 'DESC');

      return $this->render('default/index.html.twig', [
          'entities' => $entities,
          'yestmatch' => $yestmatch,
          'curmatch' => $curmatch,
          'tommatch' => $tommatch,
          'bombTotal' => $bombTotal,
          'birthdays' => $birthdays,
          'lastPlayers' => $lastPlayers,
          'topMatchesRus' => $topMatchesRus,
          'topMatchesRusCurr' => $topMatchesRusCurr,
          'topGoalsRus' => $topGoalsRus,
          'topGoalsRusCurr' => $topGoalsRusCurr,
          'topGoalkeepers' => $topGoalkeepers,
          'topGoalkeepersCurr' => $topGoalkeepersCurr,
          'maxAgePlayers' => $maxAgePlayers,
          'minAgePlayers' => $minAgePlayers
      ]);
  }

  public function newspaper(Props $props)
  {
    $htmlFile = file_get_contents('newspapers/5.html');
    return $this->render('newspaper/index.html.twig', [
      'htmlFile' => $htmlFile
    ]);
  }

  public function newspaperData(Props $props, Functions $functions, Newspaper $newspaper)
  {
    $today = date('j.m.Y');
    $fromDate = $newspaper->getNewspaperDate();
    $lastSeason = $props->getLastSeason();

    $em = $this->getDoctrine();
    $rfplMatch = [];
    $rfplMatch = $em->getRepository(Game::class)->findByLastWeek($fromDate, false, 'russia-champ');
    $rfplCupMatch = $newspaper->getEurocup('russia-cup');
    $matches = $this->getDoctrine()->getRepository(Game::class)
      ->findByLastWeek($fromDate, true);
    $tours = [];
    foreach ($matches as $match) {
      $turnirAlias = $match->getTurnir()->getRussianalias();
      $country = $match->getTeam()->getCountry()->getName();
      //var_dump($turnirAlias);
      $tour = $match->getTour();
      if($tour){
        $tours[$country]['tour'][$tour][] = $match;
      }
      $stadia = $match->getStadia();
      if($stadia){
        $stadiaName = $stadia->getName();
        $tours[$country]['stadia'][$stadiaName]['turnir'] = $turnirAlias;
        $tours[$country]['stadia'][$stadiaName]['matches'][] = $match;
      }
      $tours[$country]['turnir'] = $turnirAlias;
    }
    $rfplTours = [];
    foreach ($rfplMatch as $value) {
      $tur = $value->getTour();
      if(!in_array($tur, $rfplTours))
      {
        $rfplTours[] = $tur;
      }
    }

    $entities = $this->getDoctrine()->getRepository(Shiptable::class)
            ->getTableAll($lastSeason);
    foreach ($entities as $ent) {
      $tours[$ent->getCountry()->getName()]['table'][] = $ent;
    }

    $mund = $newspaper->getMundial('otbor-worldcup');
    $nationsleague = $newspaper->getMundial('nationsleague');
    $lch = $newspaper->getEurocup('leagueChampions');
    $le = $newspaper->getEurocup('leagueEuropa');
    $lk = $newspaper->getEurocup('conference-league');

    $bombs = [];
    $top5 = $props->getTops();
    $topEmblem = $props->getTopEmblem();
    foreach($top5 as $champ) {
      $bombsEng = $this->getDoctrine()->getRepository(Shipplayer::class)
          ->getBomb5($lastSeason, $champ);
      $arBombEng = $functions->getBombSum($bombsEng, 11);
      $bombs[$champ] = $functions->getNewspaperBomb($arBombEng);
    }

    $bombsRus = $this->getDoctrine()->getRepository(Gamers::class)
          ->getBomb($lastSeason);
    $arBombSum = $functions->getBombSum($bombsRus, 11);
    $rusBombs = $functions->getNewspaperBomb($arBombSum);

    $bombsFnl = $this->getDoctrine()->getRepository(Fnlplayer::class)
          ->getBomb5($lastSeason);
    $arBombFnl = $functions->getBombSum($bombsFnl, 11);
    $fnlBombs = $functions->getNewspaperBomb($arBombFnl);

    $rfplMatchTomm = [];
    $rfplMatchCalend = [];
    $rfplMatchCalend = $functions->getCalendar($rfplMatchTomm);

    $tourTomm = $em->getRepository(Game::class)->getMatchesTomm();
    $rfplMatchCalend = $functions->getCalendar($tourTomm);
    $tourCalend = $functions->getCalendar($tourTomm, 'tour');
    $host = $_SERVER['SERVER_NAME'];

    $transfers = $em->getRepository(Transfer::class)->findByPeriod(5);

    return $this->render('default/newspaper.html.twig', [
      'rfplTours' => $rfplTours,
      'rfplMatch' => $rfplMatch,
      'rfplCupMatch' => $rfplCupMatch,
      'rfplMatchCalend' => $rfplMatchCalend,
      'tourCalend' => $tourCalend,
      'tours' => $tours,
      'today' => $today,
      'lk' => $lk,
      'lch' => $lch,
      'le' => $le,
      'mund' => $mund,
      'nationsleague' => $nationsleague,
      'rusBombs' => $rusBombs,
      'fnlBombs' => $fnlBombs,
      'bombs' => $bombs,
      'topEmblem' => $topEmblem,
      'host' => $host,
      'top5' => $top5,
      'transfers' => $transfers
    ]);
  }

  public function soglasie()
  {
      return $this->render('default/soglasie.html.twig', []);
  }

  public function rating(Rating $rating)
  {
    $fromDate = new \DateTime('now');
    $fromDate->setTime(0, 0, 0);
    $fromDate->modify('-1 year');
    $notStadia = [18, 19, 20, 21, 25];
    $matches = $this->getDoctrine()->getRepository(Game::class)
      ->findByLastWeek($fromDate, false, false, 'fnl');

    $teamsRating = [];
    foreach ($matches as $key => $match) {
      $arScore = explode("-", $match->getScore());
      
      if(count($arScore) == 2 && $match->getScore() != '0-0'){
        $goal1 = $arScore[0];
        $goal2 = intval($arScore[1]);
      } else {
        $goal1 = $match->getGoal1();
        $goal2 = $match->getGoal2();
      }
      $team = $match->getTeam()->getName();
      $team2 = $match->getTeam2()->getName();
      $turnir = $match->getTurnir()->getName();
      if($match->getStadia()){
        $stadia = $match->getStadia()->getId();
        if(in_array($stadia, $notStadia)) continue;
      }
      
      $data = strtotime($match->getData()->format('d.m.Y'));
      $diffDate = strtotime('now') - $data;
      $monthSec = 30*24*60*60;
      $addMonth = $rating->getAddMonth($diffDate, $monthSec);
      $differ = $goal1 - $goal2;
      $arScores = $rating->getScore($differ);
      $score1 = $arScores[0];
      $score2 = $arScores[1];

      if(in_array($turnir, ['ЛЧ', 'ЛЕ', 'ЛК', 'КЧМ', 'СК'])){
        $coef = $rating->getCoefEc($score1, $turnir);
        $coef2 = $rating->getCoefEc($score2, $turnir);
      } else {
        $country = $match->getTeam()->getCountry()->getName();
        $coef = $rating->getCoef($score1, $country);
        $coef2 = $rating->getCoef($score2, $country);
      }
      if($rating->checkCountry($match->getTeam()->getCountry()->getName())){
        if(array_key_exists($team, $teamsRating)){
          $teamsRating[$team]['sum'] += $score1 * $addMonth * $coef;
          $teamsRating[$team]['matches'] += 1;
          $teamsRating[$team]['mz'] += $goal1;
          $teamsRating[$team]['mp'] += $goal2;
          if($differ > 0){
            $teamsRating[$team]['wins'] += 1;
          } elseif($differ < 0){
            $teamsRating[$team]['porazh'] += 1;
          } else {
            $teamsRating[$team]['nich'] += 1;
          }
        } else {
          $teamsRating[$team]['sum'] = $score1 * $addMonth * $coef;
          $teamsRating[$team]['matches'] = 1;
          $teamsRating[$team]['mz'] = $goal1;
          $teamsRating[$team]['mp'] = $goal2;
          if($differ > 0){
            $teamsRating[$team]['wins'] = 1;
            $teamsRating[$team]['porazh'] = 0;
            $teamsRating[$team]['nich'] = 0;
          } elseif($differ < 0){
            $teamsRating[$team]['wins'] = 0;
            $teamsRating[$team]['porazh'] = 1;
            $teamsRating[$team]['nich'] = 0;
          } else {
            $teamsRating[$team]['wins'] = 0;
            $teamsRating[$team]['porazh'] = 0;
            $teamsRating[$team]['nich'] = 1;
          }
        }
      }
      if($rating->checkCountry($match->getTeam2()->getCountry()->getName())){
        if(array_key_exists($team2, $teamsRating)){
          $teamsRating[$team2]['sum'] += $score2 * $addMonth * $coef2;
          $teamsRating[$team2]['matches'] += 1;
          $teamsRating[$team2]['mz'] += $goal2;
          $teamsRating[$team2]['mp'] += $goal1;
          if($differ < 0){
            $teamsRating[$team2]['wins'] += 1;
          } elseif($differ > 0){
            $teamsRating[$team2]['porazh'] += 1;
          } else {
            $teamsRating[$team2]['nich'] += 1;
          }
        } else {
          $teamsRating[$team2]['sum'] = $score2 * $addMonth * $coef2;
          $teamsRating[$team2]['matches'] = 1;
          $teamsRating[$team2]['mz'] = $goal2;
          $teamsRating[$team2]['mp'] = $goal1;
          if($differ < 0){
            $teamsRating[$team2]['wins'] = 1;
            $teamsRating[$team2]['porazh'] = 0;
            $teamsRating[$team2]['nich'] = 0;
          } elseif($differ > 0){
            $teamsRating[$team2]['wins'] = 0;
            $teamsRating[$team2]['porazh'] = 1;
            $teamsRating[$team2]['nich'] = 0;
          } else {
            $teamsRating[$team2]['wins'] = 0;
            $teamsRating[$team2]['porazh'] = 0;
            $teamsRating[$team2]['nich'] = 1;
          }
        }
      }
    }

    foreach($teamsRating as $team => $arr){
      if($arr['matches'] < 10){
        unset($teamsRating[$team]);
      }
    }
    uasort($teamsRating, ['App\Service\Sort', 'sortBySum']);

    return $this->render('default/rating.html.twig', [
            'matches' => $matches,
            'rating' => $teamsRating
        ]);
  }
}
