<?php

namespace App\Controller;

use App\Entity\Client;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ApiConnexionClientController extends AbstractController
{
    #[Route('/api/connexion/client', name: 'app_api_connexion_client', methods: ['POST'])]
    public function post(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'] ?? null;
        $motDePasse = $data['motDePasse'] ?? null;

        if (!$email || !$motDePasse) {
            return new JsonResponse(['status' => 'error', 'message' => 'Email et mot de passe requis'], 400);
        }

        $client = $doctrine->getRepository(Client::class)->findOneBy(['email' => $email]);

        if (!$client || !$passwordHasher->isPasswordValid($client, $motDePasse)) {
            return new JsonResponse(['status' => 'unauthorized', 'message' => 'Email ou mot de passe incorrect'], 401);
        }

        return new JsonResponse([
            'status' => 'ok',
            'message' => 'Connexion réussie',
            'token' => bin2hex(random_bytes(32)) // Remplace par JWT dans une vraie app
        ]);
    }
}
