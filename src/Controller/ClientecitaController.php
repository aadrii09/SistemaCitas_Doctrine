<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Form\CitasFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    
    #[Route('/cliente/crear', name: 'crear_cliente')]
    public function crear(Request $request , EntityManagerInterface $entityManagerInterface): Response
    {
        $crearCliente=new Cliente;
        $form=$this->createForm(CitasFormType::class, $crearCliente);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $entityManagerInterface->persist($crearCliente);
            $entityManagerInterface->flush();
            return $this->redirectToRoute("listar");
        }
        return $this->render('clientecita/new.html.twig', [
            "form"=>$form->createView(),
        ]);
    }

    #[Route('/cliente/editar/{id}', name: 'editar_cliente')]
    public function editar(Cliente $cliente, Request $request , EntityManagerInterface $entityManagerInterface): Response
    {
       
        $form=$this->createForm(CitasFormType::class, $cliente);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $entityManagerInterface->flush();
            return $this->redirectToRoute("listar");
        }
        return $this->render('clientecita/new.html.twig', [
            "form"=>$form->createView(),
        ]);
    }

}
