<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\NhlReg;
use App\Entity\NhlPlayer;
use App\Form\NhlRegType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NhlController extends AbstractController
{
    /**
     * Lists all News entities.
     *
     */
    public function add(Request $request)
    {
      $nhlReg = new NhlReg();
      $form = $this->createForm(NhlRegType::class, $nhlReg);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          // $form->getData() holds the submitted values
          // but, the original `$task` variable has also been updated
          $nhlReg = $form->getData();
          $playerId = $nhlReg->getPlayer()->getId();
          $goal = $nhlReg->getGoal();
          // ... perform some action, such as saving the task to the database
          // for example, if Task is a Doctrine entity, save it!
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($nhlReg);
          $entityManager->flush();

          $this->getDoctrine()->getRepository(NhlPlayer::class)
            ->updateNhlPlayer($playerId, $goal, 1);
          //return $this->redirectToRoute('nhl_add');
      }

      return $this->render('nhl/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
