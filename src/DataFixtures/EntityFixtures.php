<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\PFE;
use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EntityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i=1;$i<=10;$i++) {
            $entreprise = new Entreprise();
            $entreprise->setDesignation("entreprise".$i);

            $pfe= new PFE();

            $pfe->setTitre("pfe" .$i);
            $pfe->setNomEtd($faker->name);
            $pfe->setEntreprise($entreprise);

            $manager->persist($pfe);
            $manager->persist($entreprise);

        }
        $manager->flush();

    }
}
