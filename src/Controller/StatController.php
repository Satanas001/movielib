<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Repository\PersonRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/stat', name: 'stat_')]
class StatController extends AbstractController
{
    public function __construct(private MovieRepository $movieRepository, private PersonRepository $personRepository)
    {
    }

    #[Route('', name: 'index')]
    public function index(): Response
    {
        $movieCount = $this->movieRepository->count([]) ;
        $personCount = $this->personRepository->count([]) ;
        $average = $this->movieRepository->averageDuration() ;
        $total = $this->movieRepository->totalDuration() ;
        $earlierMovie = $this->movieRepository->earlier() ;
        $olderMovie = $this->movieRepository->older() ;

        return $this->render('stat/index.html.twig', [
            'controller_name' => 'StatController',
            'movieCount' => $movieCount,
            'personCount' => $personCount,
            'averageDuration' => $average,
            'totalDuration' => $total,
            'earlierMovie' => $earlierMovie,
            'olderMovie' => $olderMovie,
        ]);
    }
}
