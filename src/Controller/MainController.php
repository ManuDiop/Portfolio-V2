<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ProjectRepository $projectRepo): Response
    {

        $projectList = $projectRepo->findAll();

        return $this->render('main/main.html.twig', [
            'projectList' => $projectList,
        ]);
    }
}
