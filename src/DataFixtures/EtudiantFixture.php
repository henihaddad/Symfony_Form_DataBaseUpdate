<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\Etudiant;
use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudiantFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();
        $repo=$manager->getRepository(Section::class);
        $sections=$repo->findAll();
        for ($i=0; $i < 15; $i++) {
            $etudiant = new Etudiant() ;
            $etudiant->setPrenom($faker->firstName);
            $etudiant->setNom($faker->lastName);
            $etudiant->setSection($sections[$faker->numberBetween(0,sizeof($sections)-1)]);
            $manager->persist($etudiant);
        }
        for ($i=0; $i < 10; $i++) {
            $etudiant = new Etudiant() ;

            $etudiant->setPrenom($faker->firstName);
            $etudiant->setNom($faker->lastName);
            //$etudiant->setSection($sections[$faker->numberBetween(0,sizeof($sections)-1)]);
            $manager->persist($etudiant);
        }
        $manager->flush();

    }
}
