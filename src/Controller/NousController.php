<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NousController extends AbstractController
{
    #[Route('/a-propos', name: 'app_nous')]
    public function index(): Response
    {
        return $this->render('nous/index.html.twig', [
            'controller_name' => 'NousController',
        ]);
    }
}
