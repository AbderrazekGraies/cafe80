<?php

namespace App\Controller;

use App\Entity\Songs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Songs = $em->getRepository(Songs::class)->findAll();

        return $this->render('homepage/index.html.twig', [
            'Songs' => $Songs,
        ]);
    }
}
