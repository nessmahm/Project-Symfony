<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Personne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class PersonneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker=Factory::create();
     /*   for( $i=0; $i<100 ; $i++)
        {  $p= new Personne();
            $p->setAddress($faker->address);
            $p->setAge($faker->numberBetween(1,150));
            $p->setName($faker->name);
            $manager->persist($p);
            $manager->flush();
     }
     */

        }

}
