<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Wallpaper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadWallpaperData extends AbstractFixture implements OrderedFixtureInterface
{
    
    public function load(ObjectManager $manager)
    {
        $wallpaperNames = [
            "abstract-001.jpg", 
            "abstract-002.jpg", 
            "abstract-003.jpg", 
            "abstract-004.jpg", 
            "abstract-005.jpg",
            "abstract-006.jpg", 
            "abstract-007.jpg", 
            "abstract-008.jpg", 
            
            "landscape-summer-001.jpg", 
            "landscape-summer-002.jpg", 
            "landscape-summer-003.jpg", 
            "landscape-summer-004.jpg", 
            "landscape-summer-005.jpg", 
            "landscape-summer-006.jpg", 
            "landscape-summer-007.jpg",
            
            "landscape-winter-001.jpg", 
            "landscape-winter-002.jpg", 
            "landscape-winter-003.jpg", 
            "landscape-winter-004.jpg", 
            "landscape-winter-005.jpg", 
            "landscape-winter-006.jpg", 
            "landscape-winter-007.jpg"
        ];
        
        foreach ($wallpaperNames as $key => $wallpaperName) {
            $slug = strrev(substr(strrev($wallpaperName), 4));
            $wallpaper = (new Wallpaper())
                ->setFilename($wallpaperName)
                ->setSlug($slug)
                ->setWidth(1920)
                ->setHeight(1080)
            ;
            
            
            if ($key < 8) {
                $wallpaper->setCategory(
                    $this->getReference('category.abstract')
                );
            } elseif ($key >= 8 && $key < 15) {
                $wallpaper->setCategory(
                    $this->getReference('category.summer')
                );
            } elseif ($key >= 15) {
                $wallpaper->setCategory(
                    $this->getReference('category.winter')
                );
            }
            
            $manager->persist($wallpaper);
        }
        
//        $wallpaper = (new Wallpaper())
//            ->setFilename('abstract-001.jpg')
//            ->setSlug('abstract-001')
//            ->setWidth(1920)
//            ->setHeight(1080)
//            ->setCategory(
//                $this->getReference('category.abstract')
//            )
//        ;
//        
//        $manager->persist($wallpaper);
//        
        $manager->flush();
    }

    public function getOrder()
    {
        return 200;
    }

}

