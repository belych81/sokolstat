<?php
namespace App\Service;

use App\Entity\Game;
use App\Entity\Ectable;
use App\Entity\Mundial;
use App\Entity\MundialTable;
use App\Service\Props;
use App\Service\Functions;
use Doctrine\ORM\EntityManagerInterface;


class Newspaper
{

  private $em;
  private $props;
  private $functions;
  private $newspaperDate = '-30 days';

  public function __construct(EntityManagerInterface $em, Props $props, Functions $functions)
  {
    $this->em = $em;
    $this->props = $props;
    $this->functions = $functions;
  }

  public function getNewspaperDate(): \DateTime
  {
    $fromDate = new \DateTime('now');
    $fromDate->setTime(0, 0, 0);
    $fromDate->modify($this->newspaperDate);

    return $fromDate;
  }

  public function getEurocup(string $turnir) :array
  {
    $lchStadia = false;
    $lchGroups = false;
    $isLchEmblems = false;

    $fromDate = $this->getNewspaperDate();
    $ecTomm = $this->em->getRepository(Game::class)->getMatchesTomm();
    $ecCalend = $this->functions->getCalendar($ecTomm, 'ec');
    $lch = $this->em->getRepository(Game::class)->getEntityByWeek($fromDate, $turnir);
    if(!empty($lch)){
      $lchStadia = $lch[0]->getStadia()->getAlias();
      $isLchEmblems = true;
      if (strpos($lchStadia, 'group') !== false) {
        foreach ($lch as $match) {
          $lchGroups[$match->getStadia()->getAlias()]['matches'][] = $match;
        }
        foreach($lchGroups as $key => $group) {
          $lchGroups[$key]['table'] = $this->em->getRepository(Ectable::class)
             ->getEcTable($turnir, $this->props->getLastSeason(), $key);
           if(key_exists($turnir, $ecCalend)){
             $lchGroups[$key]['tomm'] = $ecCalend[$turnir][$key];
          }
        }
      }
    }
    return [
      'lchStadia' => $lchStadia,
      'isLchEmblems' => $isLchEmblems,
      'lchGroups' => $lchGroups,
      'lch' => $lch
    ];
  }

  public function getMundial(string $turnir) :array
  {
    $lchStadia = false;
    $lchGroups = false;

    $fromDate = $this->getNewspaperDate();
    $lch = $this->em->getRepository(Mundial::class)->getEntityByWeek($fromDate, $turnir);
    if(!empty($lch)){
      $lchStadia = $lch[0]->getStadia()->getAlias();
      if (strpos($lchStadia, 'group') !== false) {
        foreach ($lch as $match) {
          $lchGroups[$match->getStadia()->getAlias()]['matches'][] = $match;
        }
        foreach($lchGroups as $key => $group) {
          $lchGroups[$key]['table'] = $this->em->getRepository(MundialTable::class)
             ->getTable($turnir, $this->props->getLastMundSeason(), $key);
        }
      }
    }
    return [
      'lchStadia' => $lchStadia,
      'lchGroups' => $lchGroups,
      'lch' => $lch
    ];
  }
}
