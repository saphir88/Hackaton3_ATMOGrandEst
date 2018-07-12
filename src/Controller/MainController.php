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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Service\Mailer;



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
    public function AccueilAction(Request $request,Mailer $mailer){

        $user = new Users();

        $form = $this->createFormBuilder($user)
            ->add('email', TextType::class)
            ->add('ville', TextType::class)
            ->add('lieutravail', TextType::class)
            ->add('genre',  ChoiceType::class, array(
                'choices' => array(
                        'Homme' => 'Homme',
                        'Femme' => 'Femme',
                    )))
            ->add('trancheAge',  ChoiceType::class, array(
                'choices' => array(
                    '18/25' => '18/25',
                    '25/35' => '25/35',
                    '35/55' => '35/55',
                    '55/70' => '55/70',
                    '70+' => '70+',
                )))
            ->add('activite', ChoiceType::class, array(
                'choices' => array(
                    'Foot' => 'Foot',
                    'Course' => 'Course',
                    'Velo' => 'Velo',
                    'Equitation' => 'Equitation',
                    'Randonnée' => 'Randonnée',
                    'Autre'=> 'Autre',
                )))
            ->add('moyenTransport', ChoiceType::class, array(
                'choices' => array(
                    'Voiture' => 'Voiture',
                    'Covoiturage'=>'Covoiturage',
                    'Velo' => 'Velo',
                    'A pied' => 'A pied',
                    'Transport en commun' => 'Transport en commun',
                )))
            ->add('save', SubmitType::class, array('label' => 'S\'incrire'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $user = $form->getData();

            $mailer->sendEmail($_POST['form']['ville'],$_POST['form']['lieuTravail'],$_POST['form']['email']);

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($user);
             $entityManager->flush();

             $this->redirectToRoute('accueil');
        }
        /* METEO */

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

        if (isset($_POST['ville'])) {
            $ville = $_POST['ville'];

            $donnees = $this->getDoctrine()->getManager()
                ->getRepository(Info::class)->findOneBy(['commune'=>$ville]);


            $api = 'https://api.apixu.com/v1/forecast.json?key=ea49c70579214bf1b16204559181107&q=' . $ville . '&lang=fr';
            $response = file_get_contents($api);
            $jsonobj = json_decode($response);
        }else{
            $jsonobj = [];
            $donnees = [];
        }


        $hommes1825 = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['genre' => 'Homme', 'trancheAge'=>'18/25']
            );
        $nbhommes1825 = count($hommes1825);

        $hommes2535 = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['genre' => 'Homme', 'trancheAge'=>'25/35']
            );
        $nbhommes2535 = count($hommes2535);

        $hommes3555 = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['genre' => 'Homme', 'trancheAge'=>'35/55']
            );
        $nbhommes3555 = count($hommes3555);

        $hommes5570 = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['genre' => 'Homme', 'trancheAge'=>'55/70']
            );
        $nbhommes5570 = count($hommes5570);

        $hommes70 = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['genre' => 'Homme', 'trancheAge'=>'70+']
            );
        $nbhommes70 = count($hommes70);


        $femmes1825 = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['genre' => 'Femme', 'trancheAge'=>'18/25']
            );
        $nbfemmes1825 = count($femmes1825);

        $femmes2535 = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['genre' => 'Femme', 'trancheAge'=>'25/35']
            );
        $nbfemmes2535 = count($femmes2535);

        $femmes3555 = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['genre' => 'Femme', 'trancheAge'=>'35/55']
            );
        $nbfemmes3555 = count($femmes3555);

        $femmes5570 = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['genre' => 'Femme', 'trancheAge'=>'55/70']
            );
        $nbfemmes5570 = count($femmes5570);

        $femmes70 = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['genre' => 'Femme', 'trancheAge'=>'70+']
            );
        $nbfemmes70 = count($femmes70);

        $foot = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['activite' => 'Foot']
            );
        $nbFoot = count($foot);

        $course = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['activite' => 'Course']
            );
        $nbCourse = count($course);

        $velo = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['activite' => 'Velo']
            );
        $nbvelo = count($velo);

        $equitation = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['activite' => 'Equitation']
            );
        $nbEquitation = count($equitation);

        $randonnée = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['activite' => 'Randonnée']
            );
        $nbRandonnée = count($randonnée);

        $autre = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['activite' => 'Autre']
            );
        $nbAutre = count($autre);

        $velo = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['moyenTransport' => 'Velo']
            );
        $nbVelo = count($velo);

        $voiture = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['moyenTransport' => 'Voiture']
            );
        $nbvoiture = count($voiture);

        $Covoiturage = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['moyenTransport' => 'Covoiturage']
            );
        $nbCovoiturage = count($Covoiturage);

        $apied = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['moyenTransport' => 'A pied']
            );
        $nbapied = count($apied);

        $transport = $this->getDoctrine()->getManager()
            ->getRepository(Users::class)->findby(
                ['moyenTransport' => 'Transport en commun']
            );
        $nbtransport = count($transport);
        // Output "no suggestion" if no hint was found or output correct values
        return $this->render('accueil/accueil.html.twig',['tableau'=> $tableau,
            'open' => $jsonobj,
            'form' => $form->createView(),
            'nbhommes1825'=>$nbhommes1825,
            'nbhommes2535'=>$nbhommes2535,
            'nbhommes3555'=>$nbhommes3555,
            'nbhommes5570'=>$nbhommes5570,
            'nbhommes70'=>$nbhommes70,
            'nbfemmes1825'=>$nbfemmes1825,
            'nbfemmes2535'=>$nbfemmes2535,
            'nbfemmes3555'=>$nbfemmes3555,
            'nbfemmes5570'=>$nbfemmes5570,
            'nbfemmes70'=>$nbfemmes70,
            'nbVelo'=>$nbVelo,
            'nbvoiture'=>$nbvoiture,
            'nbCovoiturage'=>$nbCovoiturage,
            'nbapied'=>$nbapied,
            'nbtransport'=>$nbtransport,
            'nbFoot'=>$nbFoot,
            'nbCourse'=>$nbCourse,
            'nbvelo'=>$nbvelo,
            'nbEquitation'=>$nbEquitation,
            'nbRandonnee'=>$nbRandonnée,
            'nbAutre'=>$nbAutre,
            'donnees' => $donnees]);

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
            dump($_POST);die;
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