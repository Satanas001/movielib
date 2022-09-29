<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/person', name: 'person_')]
class PersonController extends AbstractController
{
    public function __construct(private PersonRepository $personRepository)
    {
    }

    #[Route('/add', name: 'add')]
    public function form(Request $request): Response
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person) ;

        $form->handleRequest($request) ;

        if ($form->isSubmitted() && $form->isValid()) {
            $this->personRepository->save($person, true);
            $this->addFlash('success', $person->getFirstname().' '.$person->getLastname().' a été enregistré(e) avec succès.') ;

            return $this->redirectToRoute('person_add') ;
        }

        return $this->render('person/form.html.twig', [
            'form' => $form->createView()
            ]) ;
    }
}
