<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\ConnexionType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class ConnexionController extends AbstractController
{
    #[Route('/connexion', name: 'app_connexion')]
    public function index(Request $request, AuthenticationUtils $authenticationUtils, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(ConnexionType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $email = $data['email'];

            // Fetch the user from the database
            $userRepository = $this->getDoctrine()->getRepository(Client::class);
            $user = $userRepository->findOneBy(['email' => $email]);

            if ($user) {
                // Use the encoder to check the password
                if ($user && $passwordEncoder->isPasswordValid($user, $data['mdp'])) {
                  // L'authentification a réussi, Symfony gérera automatiquement la connexion de l'utilisateur
              
                  return $this->redirectToRoute('your_dashboard_route');
              }
            }

            $this->addFlash('error', 'Invalid credentials');
        }

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}