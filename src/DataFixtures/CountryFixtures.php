<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    const COUNTRIES = ['France', 'Belgique', 'Irlande', 'Italie'];
    public function load(ObjectManager $manager): void
    {
        foreach (self::COUNTRIES as $countryName) {
            $country = new Country();
            $country->setName($countryName);
            $manager->persist($country);
            $this->addReference('country_' . $countryName, $country);
        }

        $manager->flush();
    }
}
