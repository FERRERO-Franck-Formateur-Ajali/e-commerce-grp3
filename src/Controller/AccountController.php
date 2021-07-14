<?php

namespace App\Controller;

use App\Form\EditclientType;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @IsGranted("ROLE_USER")
 */
class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     */
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    /**
     * @Route("/account/modifierclient", name="account_modifierclient")
     */
    public function editclient(Request $request): Response
    {
        $user = $this->getUser()->getClient();
        $formclient = $this->createForm(EditclientType::class, $user);
        dump($this->getUser()->getClient());
        
        $formclient->handleRequest($request);
        // $client = $clientRep->findClientID($user);

        if($formclient->isSubmitted() && $formclient->isValid()){
            // $user->setClient($client);
            $manager= $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            #refresh la page 
            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirect($request->getUri());
        }

        return $this->render('account/modifierclient.html.twig', [
            'controller_name' => 'AccountController',
            'formclient' => $formclient
        ]);
    }

    /**
     * @Route("/account/adresselivraison", name="account_adresselivraison")
     */
    public function ajoutadresselivraison(Request $request): Response
    {
        $user = $this->getUser()->getClient();
        $formclient = $this->createForm(EditclientType::class, $user);
        dump($this->getUser()->getClient());
        
        $formclient->handleRequest($request);
        // $client = $clientRep->findClientID($user);

        if($formclient->isSubmitted() && $formclient->isValid()){
            // $user->setClient($client);
            $manager= $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            #refresh la page 
            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirect($request->getUri());
        }

        return $this->render('account/modifierclient.html.twig', [
            'controller_name' => 'AccountController',
            'formclient' => $formclient
        ]);
    }

    /**
     * @Route("/account/adressefacturation", name="account_adressefacturation")
     */
    public function ajoutadressefacturation(Request $request): Response
    {
        $user = $this->getUser()->getClient();
        $formclient = $this->createForm(EditclientType::class, $user);
        dump($this->getUser()->getClient());
        
        $formclient->handleRequest($request);
        // $client = $clientRep->findClientID($user);

        if($formclient->isSubmitted() && $formclient->isValid()){
            // $user->setClient($client);
            $manager= $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            #refresh la page 
            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirect($request->getUri());
        }

        return $this->render('account/modifierclient.html.twig', [
            'controller_name' => 'AccountController',
            'formclient' => $formclient
        ]);
    }

    /**
     * @Route("/account/commandes", name="account_commandes")
     */
    public function commandes(Request $request): Response
    {
        $user = $this->getUser()->getClient();
        $formclient = $this->createForm(EditclientType::class, $user);
        dump($this->getUser()->getClient());
        
        $formclient->handleRequest($request);
        // $client = $clientRep->findClientID($user);

        if($formclient->isSubmitted() && $formclient->isValid()){
            // $user->setClient($client);
            $manager= $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            #refresh la page 
            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirect($request->getUri());
        }

        return $this->render('account/modifierclient.html.twig', [
            'controller_name' => 'AccountController',
            'formclient' => $formclient
        ]);
    }

    
}