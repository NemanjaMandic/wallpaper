<?php

namespace App\DataFixtures\ORM;

use App\Entity\Wallpaper;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWallpaperData implements FixtureInterface{

    public function load(ObjectManager $manager){

        $wallpaper = (new Wallpaper())
            ->setFilename('abstract-background-pink.jpg')
            ->setSlug('abstract-background-pink')
            ->setHeight(1080)
            ->setWidth(1920)
            ;

        $manager->persist();
        $manager->flush();
    }
}