<?php

namespace App\Controller;

use App\Entity\Cyclist;
use App\Entity\Journey;
use App\Form\JourneyType;
use App\Repository\JourneyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JourneyController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(JourneyRepository $journeyRepository): Response
    {
        $journeys = $journeyRepository->findAll();
        return $this->render('journeys/index.html.twig', [
            'journeys' => $journeys,
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
    public function new(Cyclist $cyclist): Response
    {
        $journey = new Journey();
        $form = $this->createForm(JourneyType::class, $journey);

        return $this->renderForm('journeys/new.html.twig', [
            'form' => $form,
        ]);
    }
}
