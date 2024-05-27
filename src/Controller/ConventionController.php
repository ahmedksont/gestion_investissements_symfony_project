<?php
namespace App\Controller;

use App\Entity\Convention;
use App\Form\ConventionType;
use App\Repository\ConventionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Projet;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/convention')]
class ConventionController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_convention_index', methods: ['GET'])]
    public function index(ConventionRepository $conventionRepository): Response
    {
        return $this->render('convention/index.html.twig', [
            'conventions' => $conventionRepository->findAll(),
        ]);
    }
    #[Route('/convention/new/{projectId}', name: 'app_convention_new', methods: ['GET', 'POST'])]
    public function new(Request $request, int $projectId): Response
    {
        // Get the current logged-in user
        $user = $this->getUser();
        
        // Create a new Convention instance
        $convention = new Convention();
        
        // Set the user to the Mat property of the Convention entity
        $convention->setMat($user);
        $convention->setMat($user);

        
        // Find the project by ID and set it to the CodeP property of the Convention entity
        $project = $this->entityManager->getRepository(Projet::class)->find($projectId);
        if (!$project) {
            throw $this->createNotFoundException('Project not found');
        }
        $convention->setCodeP($project);
        
        // Create the form
        $form = $this->createForm(ConventionType::class, $convention);
        
        // Handle form submission
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Persist the convention to the database
            $this->entityManager->persist($convention);
            $this->entityManager->flush();
            
            // Handle form submission success
            $this->addFlash('success', 'Convention created successfully.');
            return $this->redirectToRoute('app_user_conventions', [], Response::HTTP_SEE_OTHER);
        }
    
        // Render the form template
        return $this->render('convention/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/convention/userc', name: 'app_user_conventions', methods: ['GET'])]
public function userConventions(): Response
{
    $user = $this->getUser();
    if (!$user) {
        throw $this->createAccessDeniedException('You need to be logged in to view this page.');
    }

    $conventions = $this->entityManager->getRepository(Convention::class)->findBy(['mat' => $user]);

    return $this->render('convention/user_conventions.html.twig', [
        'conventions' => $conventions,
    ]);
}

    #[Route('/{id}', name: 'app_convention_show', methods: ['GET'])]
    public function show(Convention $convention): Response
    {
        return $this->render('convention/show.html.twig', [
            'convention' => $convention,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_convention_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Convention $convention, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConventionType::class, $convention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_convention_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('convention/edit.html.twig', [
            'convention' => $convention,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_convention_delete', methods: ['POST'])]
    public function delete(Request $request, Convention $convention, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $convention->getId(), $request->request->get('_token'))) {
            $entityManager->remove($convention);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_convention_index', [], Response::HTTP_SEE_OTHER);
    }
}
