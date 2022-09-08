<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountpartController extends AbstractController
{
    #[Route('/accountpart', name: 'app_accountpart')]
    public function index(): Response
    {
        return $this->render('accountpart/index.html.twig', [
            'controller_name' => 'AccountpartController',
        ]);
    }
}
