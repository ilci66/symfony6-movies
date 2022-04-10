<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
    {
        $movies = ["pokemon: 1", "pokemon: 2", "pokemon: 17"];

        return $this->render('movies/index.html.twig', 
            array('movies' => $movies),
        );
    }
}
