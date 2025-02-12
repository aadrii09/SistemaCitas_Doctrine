<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ClientecitaController extends AbstractController
{
    #[Route('/clientecita', name: 'app_clientecita')]
    public function index(): Response
    {
        return $this->render('clientecita/index.html.twig', [
            'controller_name' => 'ClientecitaController',
        ]);
    }
}
