<?php

namespace App\DataFixtures;

use App\Entity\Journey;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JourneyFixtures extends Fixture
{
    const JOURNEYS = [
        [
            'name' => 'Tour d\'Italie',
            'destination' => ['nord-orientale', 'centrale', 'méridionale'],
            'duration' => 9,
            'cyclist' => 'Val',
            'difficulty' => 'facile',
            'pictures' => [
                '/photo1.jpg', '/photo2.jpg',
                '/photo3.jpg', '/photo4.jpg'
            ]
        ],
        [
            'name' => 'Tour d\'Irlande',
            'destination' => ['Ulster', 'Connacht', 'Leinster'],
            'duration' => 22,
            'cyclist' => 'Juju',
            'difficulty' => 'moyen',
            'pictures' => [
                '/photo5.jpg', '/photo6.jpg',
                '/photo7.jpg', '/photo8.jpg'
            ]
        ],
        [
            'name' => 'Tour d\'Irlande',
            'destination' => ['Ulster', 'Connacht', 'Leinster'],
            'duration' => 22,
            'cyclist' => 'Juju',
            'difficulty' => 'moyen',
            'pictures' => [
                '/photo5.jpg', '/photo6.jpg',
                '/photo7.jpg', '/photo8.jpg'
            ]
        ],
        [
            'name' => 'Tour des Alpes',
            'destination' => ['Auvergne-Rhône-Alpes', 'PACA'],
            'duration' => 4,
            'cyclist' => 'Francesco',
            'difficulty' => 'difficile',
            'pictures' => [
                '/photo9.jpg', '/photo10.jpg',
                '/photo11.jpg', '/photo12.jpg'
            ]
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::JOURNEYS as $key => $journeyItem) {
            $journey = new Journey();
            $journey->setName($journeyItem['name']);
            $journey->setDuration($journeyItem['duration']);
            $journey->setDifficulty($journeyItem['difficulty']);
            $journey->setPictures($journeyItem['pictures']);
            $journey->setCyclist($this->getReference('cyclist_' . $journeyItem['cyclist']));
            foreach ($journeyItem['destination'] as $destination) {
                $journey->addDestination($this->getReference('destination_' . $destination));
            }
            $manager->persist($journey);
            $this->addReference('journey_' . $key, $journey);
        }

        $manager->flush();
    }
}
