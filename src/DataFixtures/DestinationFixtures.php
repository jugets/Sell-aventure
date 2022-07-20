<?php

namespace App\DataFixtures;

use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DestinationFixtures extends Fixture
{
    const DESTINATIONS = [
        'France' => ['Hauts-de-France', 'Normandie', 'Ile-de-France', 'Grand-Est', 'Bretagne', 'Pays de la Loire',
                        'Centre- Val de Loire', 'Bourgogne-Franche-Comté', 'Nouvelle-Aquitaine', 'Auvergne-Rhône-Alpes',
                        'Occitanie', 'PACA'],
        'Irlande' => ['Ulster', 'Connacht', 'Munster', 'Leinster'],
        'Italie' => ['nord-occidentale', 'nord-orientale', 'centrale', 'méridionale', 'insulaire'],
        'Belgique' => ['Wallonie', 'Flandre']
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::DESTINATIONS as $country => $regions) {
            $destination = new Destination();
            $destination->setCountry($country);
            $destination->setRegions($regions);
            $manager->persist($destination);
            foreach ($regions as $region) {
                $this->addReference('destination_' . $region, $destination);
            }
        }

        $manager->flush();
    }
}
