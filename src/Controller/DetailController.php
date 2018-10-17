<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 8/22/18
 * Time: 4:19 PM
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DetailController extends AbstractController
{


    /**
     * @Route("/detail", name="detail")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(){

        $image = 'landscape-summer-beach.jpg';

        return $this->render('detail/index.html.twig', [
            'image' => $image
        ]);
    }
}