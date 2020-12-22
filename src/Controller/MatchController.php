<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Player;
use App\Entity\NhlPlayer;
use App\Entity\Rusplayer;
use App\Entity\Cup;
use App\Entity\Team;
use App\Entity\Rfplmatch;
use App\Entity\Eurocup;
use App\Entity\NationSupercup;
use App\Entity\UefaSupercup;
use App\Entity\NationCup;
use App\Entity\Shipplayer;
use App\Entity\Shiptable;
use App\Entity\RusSupercup;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatchController extends AbstractController
{
    public function index(Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      $params = $request->query->all();
      $max = $request->query->get('max') ? (int)$request->query->get('max') : 20;

      $totalMatches = $this->getDoctrine()->getRepository(Rfplmatch::class)
        ->countMatches();
      $page = $request->query->get('page') &&
        (int)$request->query->get('page') > 0 ? (int)$request->query->get('page') : 1;
      $lastPage = ceil($totalMatches / $max);
      $previousPage = $page > 1 ? $page-1 : 1;
      $nextPage = $page < $lastPage ? $page+1 : $lastPage;
      unset($params['page']);
      $strParams = '';
      if(!empty($params))
      {
        foreach ($params as $key => $value) {
          $strParams .= '&'.$key.'='.$value;
        }

      }
      $offset = ($page-1)*$max ?? 0;
      $rus = $em->getRepository(Rfplmatch::class)->getList($max, $offset);

      return $this->render('match/index.html.twig', [
          'matches' => $rus,
          'lastPage' => $lastPage,
          'previousPage' => $previousPage,
          'currentPage' => $page,
          'max' => $max,
          'nextPage' => $nextPage,
          'strParams' => $strParams,
          'totalMatches' => $totalMatches
      ]);
    }

}
