<?php

namespace App\Controller;

use App\Repository\CategoriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategoriaRepository $categoriaRepository): Response
    {
        $categorias = $categoriaRepository->findAll();

        return $this->render('home/home.html.twig', [
            'categorias' => $categorias,
        ]);
    }

    #[Route('/error', name: 'app_error')]
    public function error(): Response
    {
        return $this->render('error/error.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


}
