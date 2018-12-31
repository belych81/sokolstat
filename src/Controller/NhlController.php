<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\NhlReg;
use App\Form\NhlRegType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NhlController extends AbstractController
{
    /**
     * Lists all News entities.
     *
     */
    public function add()
    {
      $nhlReg = new NhlReg();
      $form = $this->createForm(NhlRegType::class, $nhlReg);

      return $this->render('nhl/add.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
