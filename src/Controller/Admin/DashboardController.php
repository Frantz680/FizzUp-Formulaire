<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\Avis;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private ChartBuilderInterface $chartBuilder,
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FizzUp');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Home');
        yield MenuItem::linkToRoute('Voir le site', 'fa fa-house', 'public');

        yield MenuItem::section('Dashboard');
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-dashboard');

        yield MenuItem::section('Produits');
        yield MenuItem::linkToCrud('Liste des Produits', 'fas fa-list', Product::class);

        yield MenuItem::section('Avis');
        yield MenuItem::linkToCrud('Liste des avis', 'fas fa-list', Avis::class);
    }
}
