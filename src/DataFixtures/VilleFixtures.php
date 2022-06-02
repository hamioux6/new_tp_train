<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VilleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 100; $i++) {
            $ville = new Ville();
            $ville->setName("my city n° $i");
            $ville->setCp(50000+$i);
            $manager->persist($ville);
        }

        $manager->flush();
    }
}