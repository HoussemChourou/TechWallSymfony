<?php

namespace App\DataFixtures;

use App\Entity\Hobby;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HobbyFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $hobbies = [
            "Lecture",
            "Écriture",
            "Peinture",
            "Dessin",
            "Photographie",
            "Cuisine",
            "Jardinage",
            "Randonnée",
            "Course à pied",
            "Cyclisme",
            "Natation",
            "Jeux vidéo",
            "Musique",
            "Chant",
            "Danse",
            "Pêche",
            "Voyages",
            "Bricolage",
            "Yoga",
            "Méditation",
            "Théâtre",
            "Cinéma",
            "Blogging",
            "Jeux de société",
            "Échecs",
            "Couture",
            "Maquettisme",
            "Plongée sous-marine",
            "Astronomie",
            "Informatique"
        ];

        for ($i = 0; $i < count($hobbies); $i++) {
            $hobby = new Hobby();
            $hobby->setDesignation($hobbies[$i]);
            $manager->persist($hobby);
        }

        $manager->flush();
    }
}
