<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PublicController extends AbstractController
{
    #[Route('/', name: 'public')]
    public function public(): Response
    {
        
        return $this->render('public/index.html.twig', [
        ]);
    }

    #[Route('/mentions-legales', name: 'ml')]
    public function ml(Request $request):Response {

        return $this->render('public/ml.html.twig', [
        ]);
    }
}
