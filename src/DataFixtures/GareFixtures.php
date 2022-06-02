<?php

namespace App\DataFixtures;

use App\Entity\Gare;
use App\Repository\VilleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class GareFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $villeR = new VilleRepository();
        $villes = $villeR->findAll();
        foreach ($villes as $ville) {

            $gare = new Gare();
            $gare->setNom("ma gare n°" . $ville->getId());
            $gare->setVille($ville);
            $manager->persist($gare);
        }

        $manager->flush();
    }
}