<?php

namespace App\Controller;

use App\Repository\AgentRepository;
use App\Repository\ContactRepository;
use App\Repository\MissionRepository;
use App\Repository\PlaceRepository;
use App\Repository\SkillRepository;
use App\Repository\TargetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(ContactRepository $contactRepository, AgentRepository $agentRepository, MissionRepository $missionRepository, PlaceRepository $placeRepository, SkillRepository $skillRepository, TargetRepository $targetRepository): Response
    {
        return $this->render('dashboard/index.html.twig',[
            'contacts'=>$contactRepository->findAll(),
            'agents'=>$agentRepository->findAll(),
            'missions'=>$missionRepository->findAll(),
            'places'=>$placeRepository->findAll(),
            'skills'=>$skillRepository->findAll(),
            'targets'=>$targetRepository->findAll()
        ]);
    }
}
