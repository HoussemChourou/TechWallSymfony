<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $jobs = [
            "Développeur Web",
            "Ingénieur Logiciel",
            "Chef de Projet",
            "Analyste de Données",
            "Technicien Réseau",
            "Comptable",
            "Chargé de Communication",
            "Responsable Marketing",
            "Graphiste",
            "Consultant RH",
            "Administrateur Systèmes",
            "Architecte Cloud",
            "Journaliste",
            "Professeur",
            "Pharmacien",
            "Médecin Généraliste",
            "Infirmier",
            "Avocat",
            "Secrétaire",
            "Agent Immobilier",
            "Vendeur",
            "Caissier",
            "Serveur",
            "Cuisinier",
            "Mécanicien",
            "Plombier",
            "Électricien",
            "Conducteur de Bus",
            "Assistant Administratif",
            "Chef de Produit"
        ];
        for ($i = 0; $i < count($jobs); $i++) {
            $job = new Job();
            $job->setDesignation($jobs[$i]);
            $this->addReference('job_' . $i, $job);
            $manager->persist($job);
        }

        $manager->flush();
    }
}
