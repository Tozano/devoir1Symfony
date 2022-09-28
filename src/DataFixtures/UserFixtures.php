<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class UserFixtures extends Fixture
{
    private $faker;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
        $this->passwordHasher= $passwordHasher;
 }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<10;$i++){
            $user = new User();
            $prenom=$this->faker->firstName();
            $user->setRoles(array('ROLE_ADMIN'))
            ->setEmail(strtolower($prenom).'.'.strtolower($this->faker->lastName()).'@'.$this->faker->freeEmailDomain())
            ->setPassword($this->passwordHasher->hashPassword($user, strtolower($prenom)));
            $this->addReference('user'.$i, $user);
            $manager->persist($user);
        }
        $manager->flush();
    }
}