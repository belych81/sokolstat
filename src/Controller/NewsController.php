<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\News;
use App\Service\Functions;

class NewsController extends AbstractController
{
    /**
     * @Route("/news", name="news")
     */
    public function index(Functions $functions, $page = 1): Response
    {
      $em = $this->getDoctrine();

      $countNews = $em->getRepository(News::class)->countNews();

      $lastPage = ceil($countNews / 10);
      $previousPage = $page > 1 ? $page-1 : 1;
      $nextPage = $page < $lastPage ? $page+1 : $lastPage;

      $entities = $em->getRepository(News::class)->getNews(10, ($page-1)*10);
      foreach ($entities as $v) {
        $v->setText($functions->truncateText($v->getText(), 500));
      }

      return $this->render('news/index.html.twig', [
          'entities' => $entities,
          'lastPage' => $lastPage,
          'previousPage' => $previousPage,
          'currentPage' => $page,
          'nextPage' => $nextPage
      ]);
    }

    public function show($translit)
    {
        $em = $this->getDoctrine();

        $entity = $em->getRepository(News::class)->findOneByTranslit($translit);

        return $this->render('news/show.html.twig', [
            'entity'      => $entity
        ]);
    }
}
