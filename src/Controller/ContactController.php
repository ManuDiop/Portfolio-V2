<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact', methods: ['GET', 'POST'])]
    public function contact(Request $request, MailerInterface $mailer): Response
    {

        // Création du formulaire
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            // Envoi du mail
            $email = (new Email())
                ->from($contactFormData['email'])
                ->to('emmanuel.diop@gmail.com')
                ->subject('Contact depuis mon portfolio')
                ->text(
                    'Prénom : ' . $contactFormData['firstname'] . "\n" .
                    'Nom : ' . $contactFormData['lastname'] . "\n" .
                    'Email : ' . $contactFormData['email'] . "\n" .
                    'Message : ' . $contactFormData['message']
                    );

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé !');

            return $this->redirectToRoute('app_main', ['_fragment' => 'contact']);
        }

        // En cas d'échec (pas de redirection directe, on peut renvoyer à la page principale aussi)
        return $this->redirectToRoute('app_main', ['_fragment' => 'contact']);
    }
}