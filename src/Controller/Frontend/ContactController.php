<?php

namespace App\Controller\Frontend;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function Contact(Request $request,EntityManagerInterface $em , MailerInterface $mailer): Response
    {
        $form=$this->createFormBuilder()
            ->add('nom',TextType::class,['required'=>true])
            ->add('prenom',TextType::class,['required'=>true])
            ->add('email',EmailType::class,['required'=>true])
            ->add('tel',TelType::class)
            ->add('message',TextareaType::class,['required'=>true])
            ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {

            $email=(new TemplatedEmail())
                ->from(" noreply@elanaami.com")
                ->to (new Address("elanaamimohamed@gmail.com"))
                ->subject("Email envoyé depuis votre site ")
                ->htmlTemplate('frontend/emails/contact.html.twig')
                ->context(['data'=>$form->getData()]);
            $mailer->send($email);
            $this->addFlash('success','Votre message a été envoyé avec succés!!!');
            return $this->redirectToRoute('app_accueil');

        }

        return $this->render('frontend/contact.html.twig',array('form'=>$form->createView()));

    }

}
