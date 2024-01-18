<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitsRepository;
use App\Repository\RayonRepository;
use App\Repository\PhotoRepository;



class ProduitsController extends AbstractController
{
    #[Route('/produits', name: 'app_produits')]
    public function listeProduits(ProduitsRepository $ProduitsRepository, RayonRepository $RayonRepository): Response
    {
        $produits = $ProduitsRepository->findAll();
        $rayon = $RayonRepository->findAll();
        return $this->render('produits/liste.html.twig', [
            'controller_name' => 'ProduitsController',
            'produits' => $produits,
            'rayons' => $rayon
            
        ]);
    }

    #[Route('/detailsproduits/{id}', name: 'app_detailsproduits')]
    public function detailsProduits($id,ProduitsRepository $ProduitsRepository,RayonRepository $RayonRepository,PhotoRepository $PhotoRepository): Response
    {
        $produit = $ProduitsRepository->find($id);
        $photo = $PhotoRepository->findAll();

        //$rayon = $RayonRepository->findAll();
        return $this->render('produits/détails.html.twig', [
            'controller_name' => 'ProduitsController',
            'produit' => $produit,
           // 'rayon' => $rayons
           'photo' => $photo
            
        ]);
    }

    #[Route('/addproduit', name: 'add_produit')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $produit = new produit();
        $produit->setNom($this->getNom());
        $produit->setPrix($this->getPrix());
        $commande->handleRequest($request);
        if ($commande->isSubmitted() && $commande->isValid()) {
            $produit = $commande->getData();
            // on sauvegarde en bdd
            $em->persist($produit);
            $em->flush(); // Execute en bdd les requetes sql (insert, update)
            return $this->redirectToRoute('app_commande');
        }
        return $this->render('produit/addproduit.html.twig', [
            'commande' => $commande
        ]);
    }


}
