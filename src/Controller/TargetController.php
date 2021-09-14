<?php

namespace App\Controller;

use App\Entity\Target;
use App\Form\TargetType;
use App\Repository\TargetRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/target")
 */
class TargetController extends AbstractController
{
    /**
     * @Route("/", name="target_index", methods={"GET"})
     */
    public function index(TargetRepository $targetRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $targets = $paginator->paginate(
            $targetRepository->findAllByPaginationQuery(),
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('target/index.html.twig', [
            'targets' => $targets
        ]);
    }

    /**
     * @Route("/nouvelle-cible", name="target_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $target = new Target();
        $form = $this->createForm(TargetType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($target);
            $entityManager->flush();

            return $this->redirectToRoute('target_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('target/new.html.twig', [
            'target' => $target,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="target_show", methods={"GET"})
     */
    public function show(Target $target): Response
    {
        return $this->render('target/show.html.twig', [
            'target' => $target,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="target_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Target $target): Response
    {
        $form = $this->createForm(TargetType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('target_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('target/edit.html.twig', [
            'target' => $target,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="target_delete", methods={"POST"})
     */
    public function delete(Request $request, Target $target): Response
    {
        if ($this->isCsrfTokenValid('delete'.$target->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($target);
            $entityManager->flush();
        }

        return $this->redirectToRoute('target_index', [], Response::HTTP_SEE_OTHER);
    }
}
