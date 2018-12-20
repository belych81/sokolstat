<?php

namespace App\Controller;

use App\Entity\Cup;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{

  public function rating()
  {
    $cups = $this->getDoctrine()->getRepository(Cup::class)->findAll();

    $cup = new Cup();

    return $this->render('default/index.html.twig', [
            'cups' => $cups
        ]);
  }
}
