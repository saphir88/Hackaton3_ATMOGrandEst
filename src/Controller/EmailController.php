<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 11/07/2018
 * Time: 21:00
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Entity\Info;


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

        $users=$this->getDoctrine()->getManager()->getRepository(Users::class)->findAll();
        $info=$this->getDoctrine()->getManager()->getRepository(Info::class)->findAll();

        // replace this example code with whatever you need
        return $this->render('email.html.twig', [
            'users' => $users,
            'info' => $info
        ]);
    }
}