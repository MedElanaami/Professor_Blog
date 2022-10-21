<?php

namespace App\Controller\Frontend;
use App\Entity\Cours;
use App\Entity\Semestre;
use App\Form\SemestreType;
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

class APedaController extends AbstractController
{
    #[Route('/activite-pedagogique', name: 'app_actpeda')]

    public function ActPeda(Request $request,CoursRepository $coursRepository ): Response
    {

        $cours=$coursRepository->findAll();
        return $this->render('frontend/actpeda.html.twig');
    }

}
