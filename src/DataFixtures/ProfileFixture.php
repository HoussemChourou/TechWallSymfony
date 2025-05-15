<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfileFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $profilesData = [
            ['rs' => 'Instagram', 'url' => 'https://www.instagram.com/cristiano/'],
            ['rs' => 'Twitter', 'url' => 'https://twitter.com/elonmusk'],
            ['rs' => 'YouTube', 'url' => 'https://www.youtube.com/@MrBeast'],
            ['rs' => 'TikTok', 'url' => 'https://www.tiktok.com/@khaby.lame'],
            ['rs' => 'Facebook', 'url' => 'https://www.facebook.com/zuck'],
        ];

        foreach ($profilesData as $index => $data) {
            $profile = new Profile();
            $profile->setRs($data['rs']);
            $profile->setUrl($data['url']);

            $manager->persist($profile);

        }

        $manager->flush();
    }
}
