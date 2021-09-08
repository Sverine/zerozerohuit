<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaceController extends AbstractController
{
    /**
     * @Route("/dashboard/planque", name="dashboard_place")
     */
    public function index(): Response
    {
        return $this->render('dashboard/place.html.twig');
    }
}
