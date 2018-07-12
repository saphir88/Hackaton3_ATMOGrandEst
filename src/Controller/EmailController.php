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
 * Class EmailController
 * @package App\Controller
 * @Route("/")
 */
class EmailController extends Controller
{
    /**
     * @Route("/email", name="email", methods="GET")
     */
    public function EmailAction(){
        return $this->render('email.html.twig');
    }
}