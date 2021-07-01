<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use App\Form\UserType;
use App\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    private $em;
    public function __construct(EntityManagerInterface $em )
    {
        $this->em= $em;
    }
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request): Response
    {
        // actuellement l'ajout de client est possible mais de User je pense qu'il faut ajouter un set pour le role et lier le client_id au user (peut etre sperarer l'inscription sur 2 page ?)
        // creation d'un nouvelle objet user et client
        $user = new User();
        $client = new Client();
        // creation du formulaire en utilisant le form symfony
        $formClient = $this->createForm(ClientType::class, $client);
        $formUser = $this->createForm(UserType::class, $user);
        // request gere ce qui a ete envoyer dans le formulaire
        $formClient->handleRequest($request);
        $formUser->handleRequest($request);
        // a ajouter dans le if && isValid
        if ($formClient->isSubmitted()) {
            // assigne le resultat du formulaire au $client
            $client = $formClient->getData();
            // genere la requete SQL mais ne l'envoie pas
            $this->em->persist($client);
            // envoi la requete SQL
            $this->em->flush();
            // renvoie a la page register (a modifier pour renvoyer a l'accueil)
            return $this->redirectToRoute('app_register');
            }
        if ($formUser->isSubmitted()) {
            $user = $formUser->getData();
            $this->em->persist($user);
            $this->em->flush();

            return $this->redirectToRoute('app_register');
            }
        return $this->render('security/register.html.twig', [
            'formClient' => $formClient->createView(),
            'formUser' => $formUser->createView()
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        //throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
