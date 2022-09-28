<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Professeur;
use App\Entity\Etablissement;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EtablissementFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;

    public function __construct(){
        $this->faker=Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<5;$i++){
            $etablissement = new Etablissement();
            $etablissement->setNomE($this->faker->lastName());
            $etablissement->setType($this->faker->sentence(2));
            for ($j=0; $j < mt_rand(10,50); $j++) { 
                $etablissement->addAppartenir($this->getReference('professeur'.mt_rand(0,149)));
            }
            $etablissement->setReferent($this->getReference('professeur'.mt_rand(0,149)));
            $manager->persist($etablissement);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProfesseurFixtures::class,
        ];
    }
}