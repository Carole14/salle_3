<?php

namespace App\Controller;

use App\Entity\Perms;
use App\Form\PermsType;
use App\Repository\PermsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/perms')]
class PermsController extends AbstractController
{
    #[Route('/', name: 'app_perms_index', methods: ['GET'])]
    public function index(PermsRepository $permsRepository): Response
    {
        return $this->render('perms/index.html.twig', [
            'perms' => $permsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_perms_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PermsRepository $permsRepository): Response
    {
        $perm = new Perms();
        $form = $this->createForm(PermsType::class, $perm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $permsRepository->add($perm, true);

            return $this->redirectToRoute('app_perms_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('perms/new.html.twig', [
            'perm' => $perm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_perms_show', methods: ['GET'])]
    public function show(Perms $perm): Response
    {
        return $this->render('perms/show.html.twig', [
            'perm' => $perm,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_perms_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Perms $perm, PermsRepository $permsRepository): Response
    {
        $form = $this->createForm(PermsType::class, $perm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $permsRepository->add($perm, true);

            return $this->redirectToRoute('app_perms_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('perms/edit.html.twig', [
            'perm' => $perm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_perms_delete', methods: ['POST'])]
    public function delete(Request $request, Perms $perm, PermsRepository $permsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$perm->getId(), $request->request->get('_token'))) {
            $permsRepository->remove($perm, true);
        }

        return $this->redirectToRoute('app_perms_index', [], Response::HTTP_SEE_OTHER);
    }
}
