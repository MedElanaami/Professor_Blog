<?php

namespace App\Controller\Frontend;
use App\Repository\ActiviteScientifiqueRepository;
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

class AScientifiqueController extends AbstractController
{
    #[Route('/activite-scientifique', name: 'app_actscientifique')]
    public function ActScientifique(Request $request): Response
    {

        return $this->render('frontend/actscientifique.html.twig');
    }

}
