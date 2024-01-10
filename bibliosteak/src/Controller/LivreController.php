<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LivreRepository;

class LivreController extends AbstractController
{
    #[Route('/recherche', name: 'recherche_livre')]
    public function recherche(): Response
    {
        return $this->render('livre/recherche.html.twig', [
            'controller_name' => 'LivreController',
        ]);
    }
    
    #[Route('/livres', name: 'afficher_livres')]
    public function affichage(): Response
    {
        return $this->render('livre/livres.html.twig', [
            'controller_name' => 'LivreController',
        ]);
    }

    #[Route('/livre/detail/{id_livre}', name: 'detail_book')]
    public function index(int $id_livre, LivreRepository $repo): Response
    {
        $livreSelected = $repo->find($id_livre);
        return $this->render('livre/detail.html.twig', [
            'livreSelected' => $livreSelected,
        ]);
    }
}
