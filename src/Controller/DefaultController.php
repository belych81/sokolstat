<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Rfplmatch;
use App\Entity\Eurocup;
use App\Entity\Shipplayer;
use App\Entity\Shiptable;
use App\Entity\Cup;
use App\Entity\RusSupercup;
use App\Entity\NationSupercup;
use App\Entity\UefaSupercup;
use App\Entity\NationCup;
use App\Entity\Player;
use App\Entity\Team;
use App\Entity\News;
use App\Service\Rating;
use App\Service\Props;
use App\Service\Functions;
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
      $bombTotal = $this->getDoctrine()->getRepository(Shipplayer::class)
        ->getBombSum($props->getLastSeason());
      $currentMatches = $this->getDoctrine()->getRepository(Rfplmatch::class)
          ->getCurMatches();
      $curcup = $this->getDoctrine()->getRepository(Cup::class)
          ->getCurMatches();
      $curRscMatches = $this->getDoctrine()->getRepository(RusSupercup::class)
          ->getCurMatches();
      $cursupercup = $this->getDoctrine()->getRepository(NationSupercup::class)
          ->getCurMatches();
      $curUsupercup = $this->getDoctrine()->getRepository(UefaSupercup::class)
          ->getCurMatches();
      $curNcup = $this->getDoctrine()->getRepository(NationCup::class)
          ->getCurMatches();
      $curEcMatches = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getCurMatches();
      $curMatches5 = $this->getDoctrine()->getRepository(Tour::class)
          ->getCurMatches();
      $curmatch = array_merge($currentMatches, $curEcMatches,
        $curMatches5, $curRscMatches, $curcup,
        $cursupercup, $curNcup, $curUsupercup);
      $tomMatches = $this->getDoctrine()->getRepository(Rfplmatch::class)
          ->getTomMatches();
      $tomcup = $this->getDoctrine()->getRepository(Cup::class)
          ->getTomMatches();
      $tomRscMatches = $this->getDoctrine()->getRepository(RusSupercup::class)
          ->getTomMatches();
      $tomsupercup = $this->getDoctrine()->getRepository(NationSupercup::class)
          ->getTomMatches();
      $tomUsupercup = $this->getDoctrine()->getRepository(UefaSupercup::class)
          ->getTomMatches();
      $tomNcup = $this->getDoctrine()->getRepository(NationCup::class)
          ->getTomMatches();
      $tomEcMatches = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getTomMatches();
      $tomMatches5 = $this->getDoctrine()->getRepository(Tour::class)
          ->getTomMatches();
      $tommatch = array_merge($tomMatches, $tomEcMatches,
        $tomMatches5, $tomRscMatches, $tomcup,
        $tomsupercup, $tomNcup, $tomUsupercup);
      $yescup = $this->getDoctrine()->getRepository(Cup::class)
          ->getYesterdayMatches();
      $yesterdayMatches = $this->getDoctrine()->getRepository(Rfplmatch::class)
              ->getYesterdayMatches();
      $yesterdayRscMatches = $this->getDoctrine()->getRepository(RusSupercup::class)
              ->getYesterdayMatches();
      $yessupercup = $this->getDoctrine()->getRepository(NationSupercup::class)
          ->getYesterdayMatches();
      $yesUsupercup = $this->getDoctrine()->getRepository(UefaSupercup::class)
          ->getYesterdayMatches();
      $yesNcup = $this->getDoctrine()->getRepository(NationCup::class)
          ->getYesterdayMatches();
      $yesterdayEcMatches = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getYesterdayMatches();
      $yesterdayMatches5 = $this->getDoctrine()->getRepository(Tour::class)
          ->getYesterdayMatches5();
      $yestmatch = array_merge($yesterdayMatches, $yesterdayEcMatches,
        $yesterdayMatches5, $yesterdayRscMatches, $yescup,
        $yessupercup, $yesNcup, $yesUsupercup);

      uasort($tommatch, ['App\Service\Sort', 'sortByDate']);
      uasort($curmatch, ['App\Service\Sort', 'sortByDate']);
      uasort($yestmatch, ['App\Service\Sort', 'sortByDate']);

      $birthdays = $this->getDoctrine()->getRepository(Player::class)
        ->getBirthdayPlayer(date('m-d'));
      $lastPlayers = $this->getDoctrine()->getRepository(Player::class)
        ->getLastPlayer();

      $entities = $this->getDoctrine()->getRepository(News::class)->getNews(10, 0);
      foreach ($entities as $v) {
        $v->setText($functions->truncateText($v->getText(), 500));
      }

      return $this->render('default/index.html.twig', [
          'entities' => $entities,
          'yestmatch' => $yestmatch,
          'curmatch' => $curmatch,
          'tommatch' => $tommatch,
          'bombTotal' => $bombTotal,
          'birthdays' => $birthdays,
          'lastPlayers' => $lastPlayers
      ]);
  }

  public function newspaper(Props $props)
  {
    $options = new Options();
    $options->setIsRemoteEnabled(true);
    $dompdf = new Dompdf($options);
    $html = file_get_contents(__DIR__."/test.html");
    $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();
    $x          = 505;
    $y          = 790;
    $text       = "{PAGE_NUM}";
    $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');
    $size       = 10;
    $color      = array(0,0,0);
    $word_space = 0.0;
    $char_space = 0.0;
    $angle      = 0.0;

    $dompdf->getCanvas()->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    /*$canvas = $dompdf->getCanvas();
    $canvas->page_script(
        'Pdf:outputPageNumbers($pdf, $fontMetrics, $PAGE_NUM, $PAGE_COUNT);'
    );*/

    // Output the generated PDF to Browser
    $dompdf->stream('football_'.date("Y_m_d").'.pdf', ["Attachment" => true]);
    return new Response("<h1>Футбол</h1>");
  }

  public function newspaperData(Props $props)
  {
    $today = date('j.m.Y');
    $fromDate = new \DateTime('now');
    $fromDate->setTime(0, 0, 0);
    $fromDate->modify('-24 days');
    $lastSeason = $props->getLastSeason();

    $em = $this->getDoctrine();
    $rfplMatch = $em->getRepository(Rfplmatch::class)->findByLastYear($fromDate);
    $matches = $this->getDoctrine()->getRepository(Tour::class)
      ->findByLastWeek($fromDate);
    foreach ($matches as &$match) {
      $match->getTeam()->setName(
        mb_convert_case($match->getTeam()->getName(), MB_CASE_TITLE, "UTF-8")
      );
      $match->getTeam2()->setName(
        mb_convert_case($match->getTeam2()->getName(), MB_CASE_TITLE, "UTF-8")
      );
    }
    $tours = [];
    foreach ($matches as $match) {
      $country = $match->getCountry()->getName();
      $tour = $match->getTour();
      $tours[$country]['tour'][$tour][] = $match;
    }
    $rfplTours = [];
    foreach ($rfplMatch as $value) {
      $tour = $value->getTour();
      if(!in_array($tour, $rfplTours))
      {
        $rfplTours[] = $tour;
      }
    }

    $entities = $this->getDoctrine()->getRepository(Shiptable::class)
            ->getTableAll($lastSeason);
    foreach ($entities as $ent) {
      $tours[$ent->getCountry()->getName()]['table'][] = $ent;
    }

    $lch = $this->getDoctrine()->getRepository(Eurocup::class)
            ->getEntityByWeek($fromDate, 'leagueChampions');
    $le = $this->getDoctrine()->getRepository(Eurocup::class)
            ->getEntityByWeek($fromDate, 'leagueEuropa');
    $bombs = $this->getDoctrine()->getRepository(Shipplayer::class)
        ->getBomb5All($lastSeason);

    return $this->render('default/newspaper.html.twig', [
      'rfplTours' => $rfplTours,
      'rfplMatch' => $rfplMatch,
      'tours' => $tours,
      'today' => $today,
      'lch' => $lch,
      'le' => $le
    ]);
  }

  public function soglasie()
  {
      return $this->render('default/soglasie.html.twig', []);
  }

  public function search(Request $request)
  {
      $query = htmlspecialchars($request->request->get('query'));
      $arQuery = explode(" ", $query);
      $em = $this->getDoctrine()->getManager();

      $responsePlayer = $em->getRepository(Player::class)->searchPlayers($arQuery);
      $responseTeam = $em->getRepository(Team::class)->searchTeams($arQuery);
      $player = [];
      foreach($responsePlayer as $val){
          $player['player/'.$val->getTranslit().'/'] = $val->getName();
      }
      $team = [];
      foreach($responseTeam as $val){
          $team['team/'.$val->getTranslit()] = $val->getName();
      }
      return new JsonResponse(array_merge($player, $team));
  }

  public function rating(Rating $rating)
  {
    $fromDate = new \DateTime('now');
    $fromDate->setTime(0, 0, 0);
    $fromDate->modify('-1 year');
    $notStadia = [18, 19, 20, 21, 25];
    $matches = $this->getDoctrine()->getRepository(Tour::class)
      ->findByLastWeek($fromDate);
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
      if($rating->checkCountry($match->getTeam()->getCountry()->getName())){
        if(array_key_exists($team, $teamsRating)){
          $teamsRating[$team] += $score1 * $addMonth * $coef;
        } else {
          $teamsRating[$team] = $score1 * $addMonth * $coef;
        }
      }
      if($rating->checkCountry($match->getTeam2()->getCountry()->getName())){
        if(array_key_exists($team2, $teamsRating)){
          $teamsRating[$team2] += $score2 * $addMonth * $coef2;
        } else {
          $teamsRating[$team2] = $score2 * $addMonth * $coef2;
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
      $addMonth = $rating->getAddMonth($diffDate, $monthSec);
      $differ = $goal1 - $goal2;
      $arScores = $rating->getScore($differ);
      $score1 = $arScores[0];
      $score2 = $arScores[1];

      $coef = $rating->getCoef($score1, $country);
      $coef2 = $rating->getCoef($score2, $country);

      if(array_key_exists($team, $teamsRating)){
        $teamsRating[$team] += $score1 * $addMonth * $coef;
      } else {
        $teamsRating[$team] = $score1 * $addMonth * $coef;
      }
      if(array_key_exists($team2, $teamsRating)){
        $teamsRating[$team2] += $score2 * $addMonth * $coef2;
      } else {
        $teamsRating[$team2] = $score2 * $addMonth * $coef2;
      }
    }

    \arsort($teamsRating);

    return $this->render('default/rating.html.twig', [
            'matches' => $matches,
            'rating' => $teamsRating
        ]);
  }
}
