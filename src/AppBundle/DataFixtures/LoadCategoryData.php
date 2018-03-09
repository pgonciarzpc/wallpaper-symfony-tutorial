<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    
    public function load(ObjectManager $manager)
    {
        $categoryNames = [
            'Winter',
            'Summer',
            'Abstract',
        ];

        foreach ($categoryNames as $categoryName) {
            switch ($categoryName) {
                case 'Winter':
                    $category = (new Category())
                        ->setName($categoryName)
                    ;
                    $this->addReference('category.winter', $category);
                    break;
                case 'Summer':
                    $category = (new Category())
                        ->setName($categoryName)
                    ;
                    $this->addReference('category.summer', $category);
                    break;
                case 'Abstract':
                    $category = (new Category())
                        ->setName($categoryName)
                    ;
                    $this->addReference('category.abstract', $category);
                    break;
                default:
                    break;
            }
            
            $manager->persist($category);
        }
        
        $manager->flush();      

    }

    public function getOrder()
    {
        return 100;
    }

}

