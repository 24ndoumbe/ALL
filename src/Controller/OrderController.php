<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    #[Route('/ajout', name: 'add')]
    public function add(SessionInterface $session, ProduitsRepository $produitsRepository, EntityManagerInterface $em): Response
    {
       // $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $session->get('panier', []);

        if($panier === []){
            $this->addFlash('message', 'Votre panier est vide');
            return $this->redirectToRoute('rayon');
        }

        //Le panier n'est pas vide, on crée la commande
        $commande = new Commande();

        // On remplit la commande
       // $commande->setUsers($this->getUser());
        
        // On parcourt le panier pour créer les détails de commande
        foreach($panier as $item => $quantite){
            $produits = new produits();

            // On va chercher le produit
            $produit = $produitsRepository->find($item);
            
            /*$prixproduit = $produit->getPrixproduit();
           // $prixproduit = $produit->getQuantite();

            // On crée le détail de commande
           
            $produit->setPrixproduit($prixproduit);
            $produit->setQuantite($quantite);
            //$prixproduit = $produit->getQuantite();*/

            $commande->addProduit($produit);
        }

        // On persiste et on flush
        $em->persist($commande);
        $em->flush();

        $session->remove('panier');

        $this->addFlash('message', 'Commande créée avec succès');
        return $this->redirectToRoute('rayon');
    }
}

