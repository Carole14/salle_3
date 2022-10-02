<?php

namespace App\Controller;


use App\Repository\StructuresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/profil', name: 'app_account')]
    public function index(StructuresRepository $repo, Request $request): Response
    {
        $structure = $repo -> findall();
        return $this->render('account/index.html.twig');
    }
}
