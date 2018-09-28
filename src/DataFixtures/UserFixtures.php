<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 5; $i++) 
        {
            $user = new User(); 
            $user->setUsername("toto")
                 ->setEmail("toto@gmail.com")
                 ->setPassword("test")
                 ->setDescription("zmlkhqsdf zemlfkh qdfih")
                 ->setCreatedAt(new \DateTime()); 
            
            $manager->persist($user); 
        }

        $manager->flush(); 
    }
}
