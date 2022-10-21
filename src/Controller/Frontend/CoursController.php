<?php

namespace App\Controller\Frontend;
use App\Entity\Cours;
use App\Entity\Semestre;
use App\Form\SemestreType;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{
    #[Route('/cours/{id}', name: 'app_cours_detail')]
    public function detailCours(Request $request,Cours $cours,CoursRepository $coursRepository ): Response
    {
        return new  BinaryFileResponse('uploads/cours/'.$cours->getPdfName());

    }

    #[Route('/semestre/{id}', name: 'app_semestre')]
    public function coursBySemestre(Request $request,Semestre $semestre,CoursRepository $coursRepository ): Response
    {
        return $this->render('frontend/cours.html.twig',array('semestre'=>$semestre,'cours'=>$semestre->getCours()));
    }

}
