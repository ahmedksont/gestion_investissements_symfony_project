<?php
// src/Controller/Admin/EasyAdminCrudController.php

namespace App\Controller\Admin;

use App\Entity\Convention;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EasyAdminCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/convention', name: 'app_convention_admin', methods: ['GET'])]
    public function showAllConventions(): Response
    {
        $conventions = $this->entityManager->getRepository(Convention::class)->findAll();

        return $this->render('admin/convention/index.html.twig', [
            'conventions' => $conventions,
        ]);
    }

    public static function getEntityFqcn(): string
    {
        return Convention::class;
    }
}
