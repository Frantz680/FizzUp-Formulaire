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
            'controller_name' => 'PublicController',
        ]);
    }

    #[Route('/mentions-legales', name: 'ml')]
    public function ml(Request $request):Response {

        //On recherche toutes les catégories
        $allCategories = $this->doctrine->getManager()->getRepository(Categorie::class)->findAll();

        return $this->render('public/ml.html.twig', [
            'allCategories' => $allCategories,
        ]);
    }
}
