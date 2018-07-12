<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 11/07/2018
 * Time: 21:00
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


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
    public function indexAction()
    {
        return $this->render('base.html.twig');
    }
}