<?php

namespace App\Controller;

use App\Repository\PartenairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountpartController extends AbstractController
{
    #[Route('/accountpart', name: 'app_accountpart')]
    public function index(PartenairesRepository $repo): Response
    {
        return $this->render('accountpart/index.html.twig', [
            'controller_name' => 'AccountpartController',
        ]);
    }
}
