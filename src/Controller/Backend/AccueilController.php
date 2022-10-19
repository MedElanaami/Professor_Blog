<?php

namespace App\Controller\Backend;

use App\Entity\Client;
use App\Entity\Commande;
use App\Repository\CommandeRepository;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/admin', name: 'admin_accueil')]
    public function adminAccueil(Request $request,CoursRepository $coursRepository,EntityManagerInterface $em ): Response
    {
       $cours=$coursRepository->findAll();
        return $this->render('backend/cours/index.html.twig', array(
           'cours'=>$cours

        ));

    }
    #[Route('/admin/notification', name: 'notifications', options: ['expose' => true])]
    public function notifications(Request $request , CommandeRepository $commandeRepository): Response
    {
        if($request->isXmlHttpRequest()){
            $commandes=$commandeRepository->findBy(['vu'=>false]);
            $data=[];
            foreach ($commandes as $commande){
                $data[] = ['nom' => $commande->getClient()->getNom(), 'prenom' => $commande->getClient()->getPrenom(),
                    'id_client' => $commande->getClient()->getId(),
                    'id_cmd' => $commande->getId()
                ];
            }
            return new JsonResponse($data );
        }
        return $this->redirectToRoute("admin_accueil");
    }

}
