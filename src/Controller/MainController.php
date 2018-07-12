<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 11/07/2018
 * Time: 21:00
 */

namespace App\Controller;


use App\Entity\Info;
use phpDocumentor\Reflection\DocBlock\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


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
     * @Route("/test", name="test_index", methods="GET")
     */
    public function test(Request $request, SerializerInterface $serializer){

        $commune = $this->getDoctrine()->getManager()
            ->getRepository(Info::class)->commune();

        $data = $commune->getArrayResult();

        foreach($data as $key => $value){
            foreach ($value as $test){
                $tableau[]=$test;
            }
        }



// get the q parameter from URL
        $q = $request->query->get('q');

        $hint = "";

// lookup all hints from array if $q is different from ""
        if ($q !== NULL) {
            $q = strtolower($q);
            $len=strlen($q);
            foreach($tableau as $name) {
                if (stristr($q, substr($name, 0, $len))) {
                    if ($hint === "") {
                        $hint = $name;
                    } else {
                        $hint .= ", $name";
                    }
                }
            }
            return new Response($hint);
        }

// Output "no suggestion" if no hint was found or output correct values
        return $this->render('test.html.twig',['tableau'=> $tableau]);
    }
}