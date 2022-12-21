<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAjaxController extends AbstractController
{
    #[Route('/admin/ajax', name: 'app_admin_ajax')]
    public function index(): Response
    {
        return $this->render('admin_ajax/index.html.twig', [
            'controller_name' => 'AdminAjaxController',
        ]);
    }
}
