<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Partenaires;
use App\Form\PartenairesType;
use App\Form\SearchForm;
use App\Repository\PartenairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


#[Route('/partenaires')]
class PartenairesController extends AbstractController
{
    #[Route('/', name: 'app_partenaires_index', methods: ['GET', 'POST'])]
    public function index (Request $request, PartenairesRepository $partenairesRepository): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $partnerFilter = $partenairesRepository->findAll();
        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $partnerFilter = $partenairesRepository->findSearch($request->get('q'));
            }
            return $this->render('partenaires/index.html.twig', [
                'partenaires' => $partnerFilter,
                'form' => $form->createView()
        ]);
    }

    #[Route('/new', name: 'app_partenaires_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PartenairesRepository $partenairesRepository): Response
    {
        $partenaire = new Partenaires();
        $form = $this->createForm(PartenairesType::class, $partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $partenairesRepository->add($partenaire, true);

            return $this->redirectToRoute('app_partenaires_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('partenaires/new.html.twig', [
            'partenaire' => $partenaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partenaires_show', methods: ['GET'])]
    public function show(Partenaires $partenaire): Response
    {
        return $this->render('partenaires/show.html.twig', [
            'partenaire' => $partenaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_partenaires_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Partenaires $partenaire, PartenairesRepository $partenairesRepository): Response
    {
        $form = $this->createForm(PartenairesType::class, $partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $partenairesRepository->add($partenaire, true);

            return $this->redirectToRoute('app_partenaires_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('partenaires/edit.html.twig', [
            'partenaire' => $partenaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partenaires_delete', methods: ['POST'])]
    public function delete(Request $request, Partenaires $partenaire, PartenairesRepository $partenairesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partenaire->getId(), $request->request->get('_token'))) {
            $partenairesRepository->remove($partenaire, true);
        }

        return $this->redirectToRoute('app_partenaires_index', [], Response::HTTP_SEE_OTHER);
    }
}