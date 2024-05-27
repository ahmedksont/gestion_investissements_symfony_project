<?php

namespace App\Controller\Admin;

use App\Entity\Projet;
use App\Entity\User;
use App\Entity\Convention;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Optionally redirect to some specific page
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Entities');
        
        // Menu item to manage projects (view, create, delete)
        yield MenuItem::linkToCrud('Projects', 'fa fa-folder', Projet::class);

        // Menu item to view users
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class);

        // Menu item to view conventions
        yield MenuItem::linkToCrud('Conventions', 'fa fa-handshake-o', Convention::class);

        // Additional custom links can be added here
        
        yield MenuItem::linkToUrl('Navigate like user   ', 'fa fa-home', '/');

    }
}
