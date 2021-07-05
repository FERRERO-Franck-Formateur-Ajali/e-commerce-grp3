<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $entityManager = $this->getDoctrine()->getManager();
        if ($form->isSubmitted()){
            $entityManager->persist($contact);
            $entityManager->flush();
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'formulaire' => $form->createView(),
        
        ]);
    } 
}
