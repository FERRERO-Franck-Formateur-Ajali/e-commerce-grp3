<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Form\EditclientType;
use App\Entity\Adresselivraison;
use App\Entity\Adressefacturation;
use App\Form\AdresselivraisonType;
use App\Form\AdressefacturationType;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AdresselivraisonRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AdressefacturationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @IsGranted("ROLE_USER")
 */
class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="account", methods={"GET"})
     */
    public function index(ClientRepository $clientRepository, AdressefacturationRepository $adressefacturationRepository, AdresselivraisonRepository $adresselivraisonRepository): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
            'client' => $clientRepository->findAll(),
            'adressefacturation' => $adressefacturationRepository->findAll(),
            'adresselivraison' => $adresselivraisonRepository->findAll()
        ]);
    }

    // /**
    //  * @Route("/account/modifierclient", name="account_modifierclient")
    //  */
    // public function editclient(Request $request): Response
    // {
    //     $user = $this->getUser()->getClient();
    //     $formclient = $this->createForm(EditclientType::class, $user);
    //     dump($this->getUser()->getClient());
        
    //     $formclient->handleRequest($request);
    //     // $client = $clientRep->findClientID($user);

    //     if($formclient->isSubmitted() && $formclient->isValid()){
    //         // $user->setClient($client);
    //         $manager= $this->getDoctrine()->getManager();
    //         $manager->persist($user);
    //         $manager->flush();
    //         #refresh la page 
    //         $this->addFlash('message', 'Profil mis à jour');
    //         return $this->redirectToRoute('account');
    //     }

    //     return $this->render('account/modifierclient.html.twig', [
    //         'controller_name' => 'AccountController',
    //         'formclient' => $formclient->createView()
    //     ]);
    // }

    /**
     * @Route("/account/modifierclient", name="account_modifierclient", methods={"GET","POST"})
     */
    public function editclient(Request $request, Client $client): Response
    {
        $client = $this->getUser()->getClient();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('account');
        }

        return $this->render('account/index.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account/adressefacturation", name="account_adressefacturation_ajout", methods={"GET","POST"})
     */
    public function newadressefacturation(Request $request): Response
    {
        $client = $this->getUser()->getClient();
        $adressefacturation = new Adressefacturation();
        $form = $this->createForm(AdressefacturationType::class, $adressefacturation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $client->addAdressefacturation($adressefacturation) ;
            $entityManager->persist($adressefacturation);
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('account');
        }

        return $this->render('account/newadressefacturation.html.twig', [
            'adressefacturation' => $adressefacturation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account/adressefacturation/show", name="account_adressefacturation_show", methods={"GET"})
     */
    public function showadressefacturation(Adressefacturation $adressefacturation): Response
    {
        return $this->render('account/indexadressefacturation.html.twig', [
            'adressefacturation' => $adressefacturation,
        ]);
    }

    /**
     * @Route("/account/adressefacturation/edit/{id}", name="account_adressefacturation_edit", methods={"GET","POST"})
     */
    public function editadressefacturation(Request $request, Adressefacturation $adressefacturation): Response
    {
        $form = $this->createForm(AdressefacturationType::class, $adressefacturation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('account');
        }

        return $this->render('account/editadressefacturation.html.twig', [
            'adressefacturation' => $adressefacturation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account/adressefacturation/delete/{id}", name="adressefacturation_delete", methods={"POST"})
     */
    public function deleteadressefacturation(Request $request, Adressefacturation $adressefacturation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adressefacturation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adressefacturation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('account');
    }

    /**
     * @Route("/account/adresselivraison", name="account_adresselivraison_ajout", methods={"GET","POST"})
     */
    public function newadresselivraison(Request $request): Response
    {
        $client = $this->getUser()->getClient();
        $adresselivraison = new Adresselivraison();
        $form = $this->createForm(AdresselivraisonType::class, $adresselivraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $client->addAdresselivraison($adresselivraison) ;
            $entityManager->persist($adresselivraison);
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('account');
        }

        return $this->render('account/newadresselivraison.html.twig', [
            'adresselivraison' => $adresselivraison,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account/adresselivraison/show", name="account_adresselivraison_show", methods={"GET"})
     */
    public function showadresselivraison(Adresselivraison $adresselivraison): Response
    {
        return $this->render('account/indexadresselivraison.html.twig', [
            'adresselivraison' => $adresselivraison,
        ]);
    }

    /**
     * @Route("/account/adresselivraison/edit/{id}", name="account_adresselivraison_edit", methods={"GET","POST"})
     */
    public function editadresselivraison(Request $request, Adresselivraison $adresselivraison): Response
    {
        $form = $this->createForm(AdresselivraisonType::class, $adresselivraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('account');
        }

        return $this->render('account/editadresselivraison.html.twig', [
            'adresselivraison' => $adresselivraison,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account/adresselivraison/delete/{id}", name="adresselivraison_delete", methods={"POST"})
     */
    public function deleteadresselivraison(Request $request, Adresselivraison $adresselivraison): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresselivraison->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adresselivraison);
            $entityManager->flush();
        }

        return $this->redirectToRoute('account');
    }


    // /**
    //  * @Route("/account/adressefacturation/new", name="adressefacturation_new", methods={"GET","POST"})
    //  */
    // public function newadressefacturation(Request $request): Response
    // {
    //     $adressefacturation = new Adressefacturation();
    //     $form = $this->createForm(AdressefacturationType::class, $adressefacturation);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($adressefacturation);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('account');
    //     }

    //     return $this->render('adressefacturation/new.html.twig', [
    //         'adressefacturation' => $adressefacturation,
    //         'form' => $form->createView(),
    //     ]);
    // }



    // /**
    //  * @Route("/account/adresselivraison", name="account_adresselivraison")
    //  */
    // public function ajoutadresselivraison(Request $request): Response
    // {
    //     $user = $this->getUser()->getClient();
    //     $formlivraison = $this->createForm(AdresselivraisonType::class, $user);
    //     dump($this->getUser()->getClient());
        
    //     $formlivraison->handleRequest($request);
    //     // $client = $clientRep->findClientID($user);

    //     if($formlivraison->isSubmitted() && $formlivraison->isValid()){
    //         // $user->setClient($client);
    //         $manager= $this->getDoctrine()->getManager();
    //         $manager->persist($user);
    //         $manager->flush();
    //         #refresh la page 
    //         $this->addFlash('message', 'Profil mis à jour');
    //         return $this->redirect($request->getUri());
    //     }

    //     return $this->render('account/addresselivraison.html.twig', [
    //         'controller_name' => 'AccountController',
    //         'formlivraison' => $formlivraison->createView()
    //     ]);
    // } 
}