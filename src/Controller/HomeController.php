<?php

namespace App\Controller;


use App\Entity\Mission;
use App\Repository\MissionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MissionRepository $missionRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $missions = $paginator->paginate(
            $missionRepository->findAllByPaginationQuery(),
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('home/index.html.twig',[
            'missions'=>$missions
        ]);
    }

    /**
     * @Route("/mission/{id}", name="home_show", methods={"GET"})
     */
    public function show(Mission $mission) :Response
    {
        return $this->render('home/mission.html.twig',[
             'mission'=>$mission
            ]);
    }

}
