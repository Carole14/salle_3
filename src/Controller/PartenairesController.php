<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Partenaires;
use App\Entity\Partners;
use App\Form\PartenairesType;
use App\Form\PartnersType;
use App\Entity\User;
use App\Form\SearchForm;
use App\Repository\UserRepository;
use App\Repository\PartenairesRepository;
use App\Repository\PartnersRepository;
use App\Repository\PermsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/partenaires')]
class PartenairesController extends AbstractController
{
    #[Route('/', name: 'app_partenaires_index', methods: ['GET', 'POST'])]
    public function index (Request $request, PartnersRepository $partnersRepository, PermsRepository $permsRepository): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $partnerFilter = $partnersRepository->findAll();
        $perms = $permsRepository->findAll();
        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $partnerFilter = $partnersRepository->findSearch($request->get('q'));
            }
            return $this->render('partenaires/index.html.twig', [
                'partenaires' => $partnerFilter,
                'form' => $form->createView()
        ]);
    }

    #[Route('/new', name: 'app_partenaires_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PartnersRepository $partnersRepository, 
    UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository): Response
    {
        $partners = new Partners();
        $user = new User();
        $form = $this->createForm(PartnersType::class, $partners);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $partnersRepository->add($partners, true);
            $user
            ->setPassword($passwordHasher->hashPassword(
                $user,
                $request->request->get('email')
            ))
            ->setRoles([$request->request->get('role')])
            ->setPartner($partners)
            ->setEmail($request->request->get('email'));
            $userRepository->add($user, true);
        return $this->redirectToRoute('app_partenaires_index', [], Response::HTTP_SEE_OTHER);
     }

        return $this->renderForm('partenaires/new.html.twig', [
            'partenaire' => $partners,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partenaires_show', methods: ['GET'])]
    public function show(Partners $partners): Response
    {
        return $this->render('partenaires/show.html.twig', [
            'partenaire' => $partners,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_partenaires_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Partners $partners, PartnersRepository $partnersRepository): Response
    {
        $form = $this->createForm(PartnersType::class, $partners);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $partnersRepository->add($partners, true);

            return $this->redirectToRoute('app_partenaires_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('partenaires/edit.html.twig', [
            'partenaire' => $partners,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partenaires_delete', methods: ['POST'])]
    public function delete(Request $request, Partners $partners, PartnersRepository $partnersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partners->getId(), $request->request->get('_token'))) {
            $partnersRepository->remove($partners, true);
        }

        return $this->redirectToRoute('app_partenaires_index', [], Response::HTTP_SEE_OTHER);
    }
}