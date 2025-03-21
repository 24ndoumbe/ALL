<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/client', name: 'app_client')]
    public function index(commandesRepository $commandes): Response
    {
        return $this->render("admin/commandes.html.twig", [
            'commandes' => $commandes->findAll()
        ]);
    }
        
    }

    

