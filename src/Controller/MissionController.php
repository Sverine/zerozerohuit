<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/mission")
 */
class MissionController extends AbstractController
{
    /**
     * @Route("/", name="mission_index", methods={"GET"})
     */
    public function index(MissionRepository $missionRepository): Response
    {
        return $this->render('mission/index.html.twig', [
            'missions' => $missionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouvelle-mission", name="mission_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($mission->isValid()){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($mission);
                $entityManager->flush();

                return $this->redirectToRoute('mission_index', [], Response::HTTP_SEE_OTHER);
            }else{
                return $this->renderForm('mission/new.html.twig', [
                    'errors' => $mission->getErrors(),
                    'mission' => $mission,
                    'form' => $form
                ]);
            }
        }

        return $this->renderForm('mission/new.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="mission_show", methods={"GET"})
     */
    public function show(Mission $mission): Response
    {
        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="mission_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mission $mission): Response
    {
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($mission->isValid()){
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('mission_index', [], Response::HTTP_SEE_OTHER);
            }else{
                return $this->renderForm('mission/edit.html.twig', [
                    'errors' => $mission->getErrors(),
                    'mission' => $mission,
                    'form' => $form
                ]);
            }
            #return $this->redirectToRoute('mission_edit');
        }

        return $this->renderForm('mission/edit.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="mission_delete", methods={"POST"})
     */
    public function delete(Request $request, Mission $mission): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mission->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mission);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mission_index', [], Response::HTTP_SEE_OTHER);
    }
}
