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
            'country' => 'Italie',
            'region' => 'nord-orientale',
            'duration' => 9,
            'cyclist' => 'Val',
            'difficulty' => 'facile',
            'picture' => 'photo1.jpg'
        ],
        [
            'name' => 'Tour d\'Irlande',
            'country' => 'Irlande',
            'region' => 'Ulster',
            'duration' => 22,
            'cyclist' => 'Juju',
            'difficulty' => 'moyen',
            'picture' => 'photo5.jpg'
        ],
        [
            'name' => 'Tour d\'Irlande',
            'country' => 'Irlande',
            'region' => 'Connacht',
            'duration' => 22,
            'cyclist' => 'Juju',
            'difficulty' => 'moyen',
            'picture' => 'photo9.jpg'
        ],
        [
            'name' => 'Tour des Alpes',
            'country' => 'France',
            'region' => 'Auvergne-Rhône-Alpes',
            'duration' => 4,
            'cyclist' => 'Francesco',
            'difficulty' => 'difficile',
            'picture' => 'photo3.jpg'
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::JOURNEYS as $key => $journeyItem) {
            $journey = new Journey();
            $journey->setName($journeyItem['name']);
            $journey->setDuration($journeyItem['duration']);
            $journey->setDifficulty($journeyItem['difficulty']);
            $journey->setPicture($journeyItem['picture']);
            $journey->setCountry($this->getReference('country_' . $journeyItem['country']));
            $journey->setCyclist($this->getReference('cyclist_' . $journeyItem['cyclist']));
            $journey->setRegion($journeyItem['region']);
            $manager->persist($journey);
            $this->addReference('journey_' . $key, $journey);
        }

        $manager->flush();
    }
}
