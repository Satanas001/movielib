<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    #[Route('/add', name: 'add')]
    public function form(Request $request): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie) ;

        $form->handleRequest($request) ;

        if ($form->isSubmitted() && $form->isValid()) {
            $this->movieRepository->save($movie, true);
            $this->addFlash('success', '« '.$movie->getTitle().' » a été enregistré avec succès.') ;

            return $this->redirectToRoute('movie_list') ;
        }

        return $this->render('movie/form.html.twig', ['form' => $form->createView()]) ;
    }
}
