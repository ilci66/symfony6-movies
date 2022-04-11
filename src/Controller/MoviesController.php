<?php

namespace App\Controller;


use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MoviesController extends AbstractController
{
    // using entity manageer like this is easier and faster
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
    {
        // $movie_repository = $this->em->getRepository(Movie::class);

        // $movies = $movie_repository->findAll();
        // $movie_found = $movie_repository->find(9);
        // $movies_descending = $movie_repository->findBy([], ['id' => 'DESC']);
        // $movie_found_descending = $movie_repository->findOneBy(['id'=>10, 'title' => 'Samurai going to work'], ['id' => 'DESC']);

        // $movies_count = $movie_repository->count([]);

        // count the rows WHERE something = somrthing
        // $movies_count = $repository->count(['id' => '10']);
        // dd($movies_count); // ok this is cool, gives a lot of info


        
        return $this->render('movies/index.html.twig');
    }
}
