<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiPlayerController extends AbstractApiController
{
    public function index(Request $request): Response
    {
        $limit = (int)$request->get('limit');
        $players = $this->getDoctrine()->getRepository(Player::class)->getListPlayer($limit);

        return $this->json($players);
    }

    public function create(Request $request): Response
    {
        $form = $this->buildForm(PlayerType::class);
        $form->handleRequest($request);

        if(!$form->isSubmitted() || !$form->isValid())
        {
            print 'Error';
            exit;
        }

        /** @var Player $player */
        $player = $form-getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($player);
        $em->flush();

        return $this->json($player);
    }
}