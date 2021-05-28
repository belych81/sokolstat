<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Admin;
use App\Service\Sort;
use App\Service\Functions;
use App\Entity\Rfplmatch;
use App\Entity\Tour;
use App\Entity\Seasons;
use App\Entity\Team;
use App\Entity\Country;

class AdminController extends AbstractController
{
    /**
     * @Route("/adminka", name="adminka")
     */
    public function index(Admin $admin): Response
    {
      $params = $admin->getParams();
      $adminEntities = \array_keys($params['entities']);

        return $this->render('admin/index.html.twig', [
            'adminEntities' => $adminEntities
        ]);
    }

    /**
     * @Route("/adminka/show/{entity}/", name="adminka_show")
     */
    public function show(Sort $sort, Functions $func, Request $request, Admin $admin, $entity): Response
    {
      $params = $admin->getParams();
      $adminEntities = \array_keys($params['entities']);
      $cols = $params['entities'][$entity]['fields'];
      $filter = $params['entities'][$entity]['filter'] ?? [];
      $entityClass = 'App\Entity\\'.$entity;
      $page = intval($request->query->get('page') ?? 1);
      $sortField = $request->query->get('sortField') ?? 'id';
      $sortOrder = $request->query->get('sortOrder') ?? 'desc';
      $prepareSort = $sort->prepareSort($cols, $sortField, $sortOrder);
      $arFilter = [];
      foreach ($filter as $value) {
        $arFilter[$value] = $request->query->get($value);
      }
      $filterEntity = [];
      if(\key_exists('season', $arFilter)){
        $filterEntity['season'] = $this->getDoctrine()->getRepository(Seasons::class)->getSeasons();
      }
      if(\key_exists('team', $arFilter)){
        $filterEntity['team'] = $this->getDoctrine()->getRepository(Team::class)->getTeams();
      }
      if(\key_exists('country', $arFilter)){
        $filterEntity['country'] = $this->getDoctrine()->getRepository(Country::class)->getCountryAll();
      }
      $total = $this->getDoctrine()->getRepository($entityClass)->countEntity($arFilter);
      $lastPage = ceil($total / $params['limit']);
      $previousPage = $page > 1 ? $page-1 : 1;
      $nextPage = $page < $lastPage ? $page+1 : $lastPage;

      $elems = $this->getDoctrine()->getRepository($entityClass)
             ->getEntity($params['limit'], ($page-1)*$params['limit'], $sortField, $sortOrder, $arFilter);



      $filterUrl = $func->filterToUrl($arFilter);

        return $this->render('admin/show.html.twig', [
            'entity' => $entity,
            'adminEntities' => $adminEntities,
            'elems' => $elems,
            'cols' => $cols,
            'fieldsSortOrder' => $prepareSort['fieldsSortOrder'],
            'lastPage' => $lastPage,
            'previousPage' => $previousPage,
            'currentPage' => $page,
            'nextPage' => $nextPage,
            'total' => $total,
            'arFilter' => $arFilter,
            'filterUrl' => $filterUrl,
            'filterEntity' => $filterEntity
        ]);
    }
}
