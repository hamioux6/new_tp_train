<?php

namespace App\DataFixtures;

use App\Entity\Gare;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GareFixtures extends Fixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //$managertest = new ManagerRegistry();
        //$villeR = new VilleRepository($manager);
        //$villes = $villeR->findAll();
        $villes = $manager->getRepository(Ville::class)->findAll();
        foreach ($villes as $ville) {

            $gare = new Gare();
            $gare->setNom("ma gare n°" . $ville->getId());
            $gare->setVille($ville);
            $manager->persist($gare);
        }

        $manager->flush();
    }

    public function getOrder() {
        return 2;
    }

}