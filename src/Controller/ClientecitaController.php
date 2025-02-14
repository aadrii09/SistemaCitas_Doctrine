<?php

namespace App\Controller;

use App\Entity\Cliente;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

final class ClientecitaController extends AbstractController
{
    #[Route('/list', name: 'listar')]
    public function listarCliente(EntityManagerInterface $entityManagerInterface ): Response
    {

        $listaClientes=$entityManagerInterface->getRepository(Cliente::class)->findAll();
        
        $cuenta=count($listaClientes);

        return $this->render('clientecita/index.html.twig', [
            'listaClientes'=>$listaClientes,
            'cuenta'=>$cuenta,
        ]);
    }


    #[Route('/cliente/eliminar/{id}', name: 'eliminar_cliente')]
    public function eliminar(int $id, ManagerRegistry $doctrine): Response
    {
        $cliente = $doctrine->getRepository(Cliente::class)->find($id);
        if (!$cliente) {
            throw $this->createNotFoundException('Cliente no encontrado');
        }

        $entityManager = $doctrine->getManager();
        $entityManager->remove($cliente);
        $entityManager->flush();

        return $this->redirectToRoute('listar');
    }

}
