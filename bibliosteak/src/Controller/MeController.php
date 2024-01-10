<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class MeController extends AbstractController
{
    // #[Route('/me', name: 'app_me')]

    public function __construct(private Security $security)
    {
        
    }

    public function __invoke()
    {
        $user = $this->security->getUser();
        return $user;
    }
}
