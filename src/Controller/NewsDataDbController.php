<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Transfer;

class NewsDataDbController extends AbstractController
{
  /**
   * @Route("/admin/news-data-db/{slug}/", name="newsDataDb")
   */
   public function index($slug): Response
   {
     $em = $this->getDoctrine();
     $entities = $em->getRepository(Transfer::class)->findByPeriod($slug);
     return $this->render('newsDataDb/index.html.twig', [
         'entities' => $entities
     ]);
   }
}
