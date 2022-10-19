<?php

namespace App\Controller\Backend;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/cours')]
class CoursController extends AbstractController
{
    #[Route('/', name: 'admin_cours_index', methods: ['GET'])]
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('backend/cours/index.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_cours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CoursRepository $coursRepository): Response
    {
        $cours = new Cours();
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coursRepository->save($cours, true);

            return $this->redirectToRoute('admin_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backend/cours/new.html.twig', [
            'cours' => $cours,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_cours_show', methods: ['GET'])]
    public function show(Cours $cours): Response
    {
        return $this->render('cours/show.html.twig', [
            'cours' => $cours,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_cours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cours $cours, CoursRepository $coursRepository): Response
    {
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coursRepository->save($cours, true);

            return $this->redirectToRoute('admin_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backend/cours/edit.html.twig', [
            'cours' => $cours,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'admin_cours_delete', methods: ['GET'])]
    public function delete(Request $request, Cours $cours, CoursRepository $coursRepository): Response
    {$coursRepository->remove($cours,true);

        return $this->redirectToRoute('admin_cours_index', [], Response::HTTP_SEE_OTHER);
    }
}
