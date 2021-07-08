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
        #$entityManager = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() and $form->isValid()){
            $to = "ylachqar@gmail.com"; // this is your Email address
            $from = $_POST['email']; // this is the sender's Email address
            $name = $_POST['nom'];
            $subject = $_POST['objet'];
            $subject2 = "Copie de votre message sur Cash Zone";
            $message = $name . " vous a écrit le message suivant:" . "\n\n" . $_POST['contenu'];
            $message2 = "Voici une copie de votre message" . $name . "\n\n" . $_POST['contenu'];
        
            $headers = "From:" . $from;
            $headers2 = "From:" . $to;
            mail($to,$subject,$message,$headers);
            mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
            echo "Email envoyé, merci " . $name . ", nous vous répondrons dans les plus brefs délais.";
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'formulaire' => $form->createView(),
        
        ]);
    } 
}
