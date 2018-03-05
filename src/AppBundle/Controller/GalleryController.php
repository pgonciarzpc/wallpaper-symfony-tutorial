<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends Controller
{
    /**
     * @Route("/gallery", name="gallery")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $images = [
            'landscape-summer-001.jpg',
            'landscape-summer-002.jpg',
            'landscape-summer-003.jpg',
            'landscape-summer-004.jpg',
            'landscape-summer-005.jpg',
            'landscape-summer-006.jpg',
            'landscape-summer-007.jpg',
            'landscape-summer-008.jpg',
            'landscape-summer-009.jpg',
            'landscape-summer-010.jpg',
            'landscape-summer-011.jpg',
            'landscape-summer-012.jpg',
        ];
        
        $paginator  = $this->get('knp_paginator');
        
        $pagination = $paginator->paginate(
            //$query, /* query NOT result */ 
            $images,
            $request->query->getInt('different', 1)/* page number */, 
            4/* limit per page */
        );

        return $this->render('gallery/index.html.twig', [
            'images' => $pagination
        ]);
    }
}
