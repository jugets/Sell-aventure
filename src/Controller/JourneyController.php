<?php

namespace App\Controller;

use App\Entity\Cyclist;
use App\Entity\Journey;
use App\Form\JourneyType;
use App\Repository\CountryRepository;
use App\Repository\JourneyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JourneyController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(JourneyRepository $journeyRepository, CountryRepository $countryRepository): Response
    {
        $journeys = $journeyRepository->findAll();
        $countries = $countryRepository->findAll();
        return $this->render('journeys/index.html.twig', [
            'journeys' => $journeys,
            'countries' => $countries
        ]);
    }

    #[Route('/user/myjourneys/{cyclist}', name: 'journeys_user')]
    public function journeysByUser(JourneyRepository $journeyRepository, Cyclist $cyclist): Response
    {
        $journeys = $journeyRepository->findBy(['cyclist' => $cyclist]);
        return $this->render('journeys/user_journeys.html.twig', [
            'journeys' => $journeys,
        ]);
    }

    #[Route('/user/myjourneys/{cyclist}/new', name: 'new_journey')]
    public function new(Request $request, JourneyRepository $journeyRepository): Response
    {
        $journey = new Journey();
        $form = $this->createForm(JourneyType::class, $journey);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $journeyRepository->add($journey, true);    
            return $this->redirectToRoute('index');
        }


        return $this->renderForm('journeys/new.html.twig', [
            'form' => $form,
        ]);
    }
}
