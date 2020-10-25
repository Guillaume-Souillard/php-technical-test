<?php

namespace App\DataFixtures;

use App\Entity\RunType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RunTypeFixtures extends Fixture
{
    public const TYPES = [
        'Footing',
        'Running',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TYPES as $name) {
            $runType = new RunType();
            $runType->setName($name);
            $manager->persist($runType);
        }

        $manager->flush();
    }
}
