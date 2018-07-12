<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 11/07/2018
 * Time: 21:00
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class MainController
 * @package App\Controller
 * @Route("/")
 */
class MainController extends Controller
{
    /**
     * @Route("/", name="default_index", methods="GET")
     */
    public function indexAction(){
        return $this->render('base.html.twig');
    }
    /**
     * @Route("/accueil", name="accueil", methods={"GET", "POST"})
     */
    public function AccueilAction(){

        $test= 850;
        return $this->render('accueil/accueil.html.twig',array(
            'test' => $test,
    ));
    }
}