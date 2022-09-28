<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Professeur;


class ProfesseurFixtures extends Fixture
{
    private $faker;

    public function __construct(){
        $this->faker=Factory::create("fr_FR");
 }

 public function load(ObjectManager $manager): void
 {
     for($i=0;$i<150;$i++){
         $professeur = new Professeur();
         $professeur->setNomP($this->faker->lastName())
         ->setPrenomP($this->faker->firstName())
         ->setRueP($this->faker->sentence(1))
         ->setVilleP($this->faker->sentence(1))
         ->setCodePostal(mt_rand(10000,99999));
         $this->addReference('professeur'.$i, $professeur);
         $manager->persist($professeur);
     }

     $manager->flush();
 }
}