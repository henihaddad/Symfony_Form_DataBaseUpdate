<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SectionFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create();
        for ($i=0; $i < 5; $i++) {
            $section = new Section() ;
            $section->setDesignation($faker->company);

            $manager->persist($section);
        }
        $manager->flush();
    }
}
