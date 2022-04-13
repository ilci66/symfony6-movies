<?php

namespace App\Controller;


use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MoviesController extends AbstractController
{
    // using entity manageer like this is easier and faster
    private $em;

    public function __construct(EntityManagerInterface $em, MovieRepository $movieRepository)
    {
        $this->em = $em;
        $this->movieRepository = $movieRepository;
    }
    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
    {
        // $movie_repository = $this->em->getRepository(Movie::class);

        $movies = $this->movieRepository->findAll();

        return $this->render('movies/index.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/movies/create', name: 'create_movies')]
    public function create(Request $request): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieFormType::class, $movie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newMovie = $form->getData();
            $imagePath = $form->get('imagePath')->getData();
            if($imagePath) {
                $newFileName = uniqid() . "." . $imagePath->guessExtension();
                
                try {
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads',
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $this->em->persist($newMovie);
                $this->em->flush();

                return $this->redirectToRoute('app_movies');
            }


            // dd($newMovie);
            // exjjit;
        }


        return $this->render('movies/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    #[Route('/movies/edit/{id}', name: 'edit_movies')]
    public function edit($id): Response
    {
        dd($id);
    }

    #[Route('/movies/{id}', methods: ['GET'], name: 'show_movie')]
    public function show($id): Response
    {
        $movie = $this->movieRepository->find($id);
        
        return $this->render('movies/show.html.twig', [
            'movie' => $movie
        ]);
    }
}
