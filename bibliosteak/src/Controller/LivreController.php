<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    #[Route('/recherche', name: 'app_livre')]
    public function index(): Response
    {
        return $this->render('livre/recherche.html.twig', [
            'controller_name' => 'LivreController',
        ]);
    }
}
