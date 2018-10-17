<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends Controller
{



    /**
     * @Route("/gallery", name="gallery")
     */
    public function index(Request $request)
    {

        $images = [

                'alien-profile.png',
                'asteroid.jpeg',
                'abstract-shards.jpeg',
                'landscape-summer-beach.jpg',
                'landscape-summer-flowers.jpg'

        ];

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $images,
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );

        // parameters to template
       // return $this->render('AcmeMainBundle:Article:list.html.twig', array('pagination' => $pagination));
        return $this->render('gallery/index.html.twig', [

            'images' => $pagination,
            'pagination' => $pagination
        ]);
    }
}
