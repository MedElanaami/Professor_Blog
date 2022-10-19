<?php

namespace App\Controller\Backend;

use App\Entity\Semestre;
use App\Form\SemestreType;
use App\Repository\SemestreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/semestre')]
class SemestreController extends AbstractController
{
    #[Route('/', name: 'admin_semestre_index', methods: ['GET'])]
    public function index(SemestreRepository $semestreRepository): Response
    {
        return $this->render('backend/semestre/index.html.twig', [
            'semestres' => $semestreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_semestre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SemestreRepository $semestreRepository): Response
    {
        $semestre = new Semestre();
        $form = $this->createForm(SemestreType::class, $semestre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $semestreRepository->save($semestre, true);

            return $this->redirectToRoute('admin_semestre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backend/semestre/new.html.twig', [
            'semestre' => $semestre,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/edit', name: 'admin_semestre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Semestre $semestre, SemestreRepository $semestreRepository): Response
    {
        $form = $this->createForm(SemestreType::class, $semestre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $semestreRepository->save($semestre, true);

            return $this->redirectToRoute('admin_semestre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backend/semestre/edit.html.twig', [
            'semestre' => $semestre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'admin_semestre_delete', methods: ['GET'])]
    public function delete(Request $request, Semestre $semestre, SemestreRepository $semestreRepository): Response
    {$semestreRepository->remove($semestre,true);

        return $this->redirectToRoute('admin_semestre_index', [], Response::HTTP_SEE_OTHER);
    }
}
