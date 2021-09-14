<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use App\Repository\AgentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/agent")
 */
class AgentController extends AbstractController
{
    /**
     * @Route("/", name="agent_index", methods={"GET"})
     */
    public function index(AgentRepository $agentRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $agents = $paginator->paginate(
            $agentRepository->findAllByPaginationQuery(),
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('agent/index.html.twig', [
            'agents' => $agents
        ]);
    }

    /**
     * @Route("/nouveau-agent", name="agent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $agent = new Agent();
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($agent);
            $entityManager->flush();

            return $this->redirectToRoute('agent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agent/new.html.twig', [
            'agent' => $agent,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="agent_show", methods={"GET"})
     */
    public function show(Agent $agent): Response
    {
        return $this->render('agent/show.html.twig', [
            'agent' => $agent,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="agent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Agent $agent): Response
    {
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agent/edit.html.twig', [
            'agent' => $agent,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="agent_delete", methods={"POST"})
     */
    public function delete(Request $request, Agent $agent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($agent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('agent_index', [], Response::HTTP_SEE_OTHER);
    }
}
