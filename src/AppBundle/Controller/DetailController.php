<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of DetailController
 *
 * @author kasia
 */
class DetailController extends Controller
{
    /**
     * @Route("/view", name="view")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $image = 'landscape-summer-001.jpg';
        
        return $this->render('detail/index.html.twig', [
            'image' => $image,
            
        ]);
    }
}
