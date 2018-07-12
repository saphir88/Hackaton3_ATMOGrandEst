<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 11/07/2018
 * Time: 21:00
 */

namespace App\Controller;


use App\Entity\Info;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Users;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;




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
    public function indexAction(Request $request){

        $user = new Users();

        $form = $this->createFormBuilder($user)
            ->add('email', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
        }

            return $this->render('base.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/test", name="test_index", methods={"GET","POST"})
     */
    public function test(Request $request){

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

        if (!empty($_POST)) {
            $ville = $_POST['ville'];
            $api = 'https://api.apixu.com/v1/forecast.json?key=ea49c70579214bf1b16204559181107&q=' . $ville . '&lang=fr';
            $response = file_get_contents($api);
            $jsonobj = json_decode($response);
        }else{
            $jsonobj = [];
        }
        // Output "no suggestion" if no hint was found or output correct values
        return $this->render('test.html.twig',['tableau'=> $tableau,
            'open' => $jsonobj]);


    }
}