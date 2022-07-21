<?php

namespace App\Controller;

use App\Entity\Cyclist;
use App\Entity\Journey;
use App\Form\JourneyType;
use App\Repository\CountryRepository;
use App\Repository\JourneyRepository;
use App\Repository\StepRepository;
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
    public function new(Request $request, JourneyRepository $journeyRepository, Cyclist $cyclist): Response
    {
        $journey = new Journey();
        $journey->setCyclist($cyclist);
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

    #[Route('/{journey}/show', name: 'app_journey_show', methods: ['GET'])]
    public function show(Journey $journey, StepRepository $stepRepository): Response
    {
        $steps = $stepRepository->findBy(['journey' => $journey]);
        return $this->render('journeys/show.html.twig', [
            'journey' => $journey,
            'steps' => $steps
        ]);
    }

    #[Route('/user/myjourneys/{cyclist}/{journey}/edit', name: 'app_journey_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cyclist $cyclist, Journey $journey, JourneyRepository $journeyRepository): Response
    {
        $journey->setCyclist($cyclist);
        $form = $this->createForm(JourneyType::class, $journey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $journeyRepository->add($journey, true);

            return $this->redirectToRoute('journeys_user', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('journeys/edit.html.twig', [
            'journey' => $journey,
            'form' => $form,
        ]);
    }

    #[Route('/user/myjourneys/{cyclist}/{id}', name: 'app_journey_delete', methods: ['POST'])]
    public function delete(Request $request, Journey $journey, JourneyRepository $JourneyRepository, Cyclist $cyclist): Response
    {
        if ($journey != null) {
            $JourneyRepository->remove($journey, true);
        }

        return $this->redirectToRoute('journeys_user', ['cyclist' => $cyclist->getId()], Response::HTTP_SEE_OTHER);
    }
}
