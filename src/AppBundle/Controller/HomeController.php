<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $abstract = [
            "abstract-001.jpg", 
            "abstract-002.jpg", 
            "abstract-003.jpg", 
            "abstract-004.jpg", 
            "abstract-005.jpg", 
            "abstract-006.jpg", 
            "abstract-007.jpg", 
            "abstract-008.jpg",
        ];
        
        $summer = [
            "landscape-summer-001.jpg", 
            "landscape-summer-002.jpg", 
            "landscape-summer-003.jpg", 
            "landscape-summer-004.jpg", 
            "landscape-summer-005.jpg", 
            "landscape-summer-006.jpg", 
            "landscape-summer-007.jpg", 
            
        ];
        
        $winter = [
            "landscape-winter-001.jpg", 
            "landscape-winter-002.jpg", 
            "landscape-winter-003.jpg", 
            "landscape-winter-004.jpg", 
            "landscape-winter-005.jpg", 
            "landscape-winter-006.jpg", 
            "landscape-winter-007.jpg",
        ];
        
        $images = array_merge($abstract, $summer, $winter);
        
        shuffle($images);
        
        $randomizedImages = array_slice($images, 0, 8);
        
        return $this->render('home/index.html.twig', [
            'randomized_images' => $randomizedImages,
            'abstract'          => array_slice($abstract, 0, 2),
            'summer'          => array_slice($summer, 0, 2),
            'winter'          => array_slice($winter, 0, 2),
            
        ]);
    }
}
