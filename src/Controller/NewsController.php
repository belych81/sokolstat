<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\News;
use App\Entity\Period;
use App\Entity\Transfer;
use App\Service\Functions;

class NewsController extends AbstractController
{
    const NEWS_ON_PAGE = 10;
    const NEWS_TRUNCATE = 500;

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/news", name="news")
     */
    public function index(Functions $functions, $page = 1): Response
    {
      $em = $this->entityManager;

      $countNews = $em->getRepository(News::class)->countNews();

      $lastPage = ceil($countNews / self::NEWS_ON_PAGE);
      $previousPage = $page > 1 ? $page-1 : 1;
      $nextPage = $page < $lastPage ? $page+1 : $lastPage;

      $entities = $em->getRepository(News::class)->getNews(self::NEWS_ON_PAGE, ($page-1)*self::NEWS_ON_PAGE);
      foreach ($entities as $v) {
        $v->setText($functions->truncateText($v->getText(), self::NEWS_TRUNCATE));
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
        $em = $this->entityManager;

        $entity = $em->getRepository(News::class)->findOneByTranslit($translit);
        $period = $em->getRepository(Period::class)->getByNews($entity->getId());
        $transfers = [];
        if($period) {
          $transfers = $em->getRepository(Transfer::class)->findByPeriod($period[0]->getId());
        }
        return $this->render('news/show.html.twig', [
            'entity' => $entity,
            'transfers' => $transfers
        ]);
    }
}
