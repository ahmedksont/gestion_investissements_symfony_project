<?php
// src/Controller/HomeController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Projet;
use App\Repository\ProjetRepository;

use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(ProjetRepository $projetRepository): Response
{
    return $this->render('home/index.html.twig', [
        'projets' => $projetRepository->findAll(),
    ]);
}

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        // Logic for about page
        return $this->render('home/about.html.twig');
    }

/**
     * @Route("/admin", name="admin_dashboard")
     */
    public function adminDashboard(): Response
    {
        // Logic for admin dashboard page
        return $this->render('home/admin_dashboard.html.twig');
    }
}
