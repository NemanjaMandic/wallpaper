<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 10/17/18
 * Time: 9:25 AM
 */

namespace App\DataFixtures\ORM;


use App\Entity\Category;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategoryData implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Abstract');

        $manager->persist($category);
        $manager->flush();
    }
}