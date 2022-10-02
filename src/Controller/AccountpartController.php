<?php

namespace App\Controller;

use App\Repository\PartnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountpartController extends AbstractController
{
    #[Route('/profilpart', name: 'app_accountpart')]
    public function index(PartnersRepository $repo): Response
    {
        return $this->render('accountpart/index.html.twig', [
            'controller_name' => 'AccountpartController',
        ]);
    }
}
