<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 11/07/2018
 * Time: 21:00
 */

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


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
    public function AccueilAction(Request $request){

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
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($user);
             $entityManager->flush();
        }
        return $this->render('accueil/accueil.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}