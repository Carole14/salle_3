<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Entity\Structures;
use App\Form\StructuresType;
use App\Repository\StructuresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/structures')]
class StructuresController extends AbstractController
{
    #[Route('/', name: 'app_structures_index', methods: ['GET', 'POST'])]
    public function index(Request $request, StructuresRepository $structuresRepository): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $structureFilter = $structuresRepository->findAll() ;
        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $structureFilter = $structuresRepository->findSearch($request->get('q'));
            }

        return $this->render('structures/index.html.twig', [
            'structure' => $structureFilter,
            'form' => $form->createView()
        ]);
    }

    #[Route('/new', name: 'app_structures_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StructuresRepository $structuresRepository): Response
    {
        $structure = new Structures();
        $form = $this->createForm(StructuresType::class, $structure);
        $form->handleRequest($request);
        
        

    

        if ($form->isSubmitted() && $form->isValid()) {
            $structuresRepository->add($structure, true);

            return $this->redirectToRoute('app_structures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('structures/new.html.twig', [
            'structure' => $structure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_structures_show', methods: ['GET'])]
    public function show(Structures $structure): Response
    {
        return $this->render('structures/show.html.twig', [
            'structure' => $structure,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_structures_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Structures $structure, StructuresRepository $structuresRepository): Response
    {
        $form = $this->createForm(StructuresType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $structuresRepository->add($structure, true);

            return $this->redirectToRoute('app_structures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('structures/edit.html.twig', [
            'structure' => $structure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_structures_delete', methods: ['POST'])]
    public function delete(Request $request, Structures $structure, StructuresRepository $structuresRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$structure->getId(), $request->request->get('_token'))) {
            $structuresRepository->remove($structure, true);
        }

        return $this->redirectToRoute('app_structures_index', [], Response::HTTP_SEE_OTHER);
    }
}
