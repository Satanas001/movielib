<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/movie', name: 'movie_')]
class MovieController extends AbstractController
{

    public function __construct(private MovieRepository $movieRepository)
    {
    }

    #[Route('', name: 'list')]
    public function list(): Response
    {
        $movies = $this->movieRepository->findBy([], [
            'title' => 'asc'
        ]);
        

        return $this->render('movie/list.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/add', name: 'add')]
    public function form(Request $request, SluggerInterface $slugger): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie) ;

        $form->handleRequest($request) ;

        if ($form->isSubmitted() && $form->isValid()) {
            $posterFile  = $form->get('poster')->getData();

            if ($posterFile) {
                $originalFilename = pathinfo($posterFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.$posterFile->guessExtension();
                
                $posterFile->move(
                    $this->getParameter('posters_directory'),
                    $newFilename
                );
                $movie->setPoster($newFilename);
            }
            
            $this->movieRepository->save($movie, true);
            $this->addFlash('success', '« '.$movie->getTitle().' » a été enregistré avec succès.') ;

            return $this->redirectToRoute('movie_list') ;
        }

        return $this->render('movie/form.html.twig', [
            'form' => $form->createView()
        ]) ;
    }
}
