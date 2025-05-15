<?php

namespace App\DataFixtures;

use App\Entity\Job;
use App\Entity\Personne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PersonneFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 100; $i++) {
            $personne = new Personne();
            $personne->setFirstname($faker->firstName);
            $personne->setName($faker->lastName);
            $personne->setAge($faker->numberBetween($min = 18, $max = 65));
            $randomJobIndex = $faker->numberBetween(0, 29);
            $job = $this->getReference( 'job_' . $randomJobIndex,Job::class);
            $personne->setJob($job);
            $manager->persist($personne);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            JobFixture::class,
        ];
    }
}
