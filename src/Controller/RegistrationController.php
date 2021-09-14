<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/inscription", name="registration")
     */
    public function index(Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $admin = new Admin();
        $form = $this->createForm(RegistrationType::class, $admin);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $admin = $form->getData();
            $password = $hasher->hashPassword($admin, $admin->getPassword());
            $admin->setPassword($password);

            dd($password);

            $this->entityManager->persist($admin);
            $this->entityManager->flush($admin);

        }

        return $this->render('registration/index.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
