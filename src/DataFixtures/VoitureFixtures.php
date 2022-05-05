<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Voiture;
use Faker\Factory;

class VoitureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      /*  $faker=Factory::create();
       $marques = ["BMW","CITROEN","AUDI","OPEL","SUZUKI","TOYOTA","NISSAN","MERCEDES","AUDI","VOLVO","TESLA","ISUZI"];
       for( $i=0;$i<40;$i++) {
           $v=new Voiture();
           $v->setMarque($marques[$i%12]);
           $v->setMatricule($faker->numberBetween(10000000,99999999));
           $manager->persist($v);
           $manager->flush();
       }
      */
    }
}
