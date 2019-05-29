<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
    public function index($id)
    {
      $tasks = $this->getDoctrine()->getRepository(Task::class)
              ->findActiveTask();
      return $this->render('task/index.html.twig', [
        'tasks' => $tasks,
        'id' => $id
      ]);
    }

    public function new()
    {
        $entity  = new Task();
        $form   = $this->createForm(TaskType::class, $entity);

        return $this->render('task/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function create(Request $request)
    {
        $entity  = new Task();
        $form = $this->createForm(TaskType::class, $entity);
        $entity->setStatus(1);
        $entity->setData(new \DateTime());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $lastId = $entity->getId();
            return $this->redirect($this->generateUrl('task', ['id' => $lastId]));
        }

        return $this->render('task/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function close($id)
    {
        $tasks = $this->getDoctrine()->getRepository(Task::class)
                ->deactiveTask($id, new \DateTime());

        return $this->redirect($this->generateUrl('task'));
    }
}
