<?php

namespace App\DataFixtures;

use App\Entity\Step;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class StepFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        
        for ($j = 0; $j < 4; $j++) {
            for ($s = 0; $s < 8; $s++) {
                $step = new Step();
                $step->setStart($faker->state());
                $step->setArrival($faker->state());
                $step->setDescription($faker->paragraphs(3, true));
                $step->setJourney($this->getReference('journey_' . rand(0, 3)));
                $manager->persist($step);
            }
        }
        $manager->flush();
    }
}
