<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Produits;
use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProduitsRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }


    
    #[Route('/commander', name: 'app_commande')]
    public function Commande(SessionInterface $session, ProduitsRepository $produitsRepository, EntityManagerInterface $entityManager, ManagerRegistry $doctrine)
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_historiqueCommandes');
        }

        $panier = $session->get("panier", []);
        $dataPanier = [];
        $total = 0;
        $quantiteTotale = 0;

        $commande = new Commandes;


        // On boucle sur chaque produit du panier
        foreach ($panier as $id => $quantite) {
            $produit = $produitsRepository->find($id);
            if (!$produit) {
                throw $this->createNotFoundException('Le produit demandé n\'existe pas');
            }

            

            $entityManager = $doctrine->getManager();
            $entityManager->persist($produit);

            // On ajoute les informations du produit dans $dataPanier
            $dataPanier[] = [
                "produit" => $produit,
                "quantite" => $quantite,
            ];

            $produit = $produitRepo->find($id);
            // On ajoute le prix total pour tous les produits
            $total += $produit->getPrix() * $quantite;

            // On ajoute la quantité du produit à la quantité totale
            $quantiteTotale += $quantite;

            // On ajoute le produit à la commande
            $commande->addProduit($produit);
            $commande->setEtat("En cours")
                ->setUser($this->getUser())
                ->setTotal($total)
                ->setDate(new \DateTimeImmutable());
        }

        // On définit la quantité totale de tous les produits dans la commande
        $commande->setQuantite($quantiteTotale);

        // On persiste la commande
        $entityManager->persist($commande);
        $entityManager->flush();

        // On supprime ce qu'il y a dans le panier
        $session->set('panier', []);

        $this->addFlash('success', 'La commande a été transmise avec succès.');

        return $this->redirectToRoute('app_historiqueCommandes');
    }

    
    #[Route('/commandes', name: 'app_historiqueCommandes')]
    public function commandes(CommandeRepository $commandeRepository)
    {
        // Assurez-vous que vous obtenez l'utilisateur actuel à partir de $this->getUser()
        $user = $this->getUser();
        $commandes = $commandeRepository->findBy(['user' => $user]);

        return $this->render('historique/commandes.html.twig', [
            'commandes' => $commandes,
        ]);
    }
}

