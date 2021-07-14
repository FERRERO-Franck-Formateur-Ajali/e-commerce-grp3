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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $session;
    private $em;
    public function __construct(EntityManagerInterface $em , SessionInterface $session )
    {
        $this->em= $em;
        $this->session= $session;
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
     * @Route("/register", name="app_register_user")
     */
    public function register(Request $request , UserPasswordHasherInterface $passwordEncoder): Response
    {

        // actuellement l'ajout de client est possible mais de User je pense qu'il faut ajouter un set pour le role et lier le client_id au user (peut etre sperarer l'inscription sur 2 page ?)
        // creation d'un nouvelle objet user et client
        $user = new User();
        // $client = new Client();
        // creation du formulaire en utilisant le form symfony
        // $formClient = $this->createForm(ClientType::class, $client);
        $formUser = $this->createForm(UserType::class, $user);
        // $tableauObservation = $this->getDoctrine()->getRepository(TableauObservationMainCourante::class)->findBy(['Entete' => $declarationMainCourante->getId()]);
        // request gere ce qui a ete envoyer dans le formulaire
        // $formClient->handleRequest($request);
        $formUser->handleRequest($request);
        // a ajouter dans le if && isValid
        if ($formUser->isSubmitted() && $formUser->isValid()) {
            // assigne le resultat du formulaire au $client
            // $client = $formClient->getData();
            // $user = $formUser->getData();
            $password = $passwordEncoder->hashPassword($user, $user->getPassword());
            $user->setPassword($password);
            // $user->setRoles(['ROLE_CLIENT']);
            // $setClient = $user->getClient($client);
            // $user->setClient($setClient);
            // genere la requete SQL mais ne l'envoie pas
            // $this->em->persist($client);
            $this->em->persist($user);
            // envoi la requete SQL
            $this->em->flush();
            // renvoie a la page register (a modifier pour renvoyer a l'accueil)
            // dump($client);
            $this->addFlash('message', 'Compte Créer');
            return $this->redirectToRoute('home');
            }
        dump($user);
        return $this->render('security/register.html.twig', [
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
