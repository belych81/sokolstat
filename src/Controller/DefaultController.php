<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
  public function index($name)
  {
    return $this->render('default/index.html.twig', [
            'name' => $name
        ]);
  }
}
