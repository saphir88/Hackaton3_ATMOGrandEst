<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 12/07/2018
 * Time: 09:09
 */

namespace App\Service;

use App\Entity\Info;
use Doctrine\ORM\EntityManager;

class Mailer {

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Modèle du mail
     */
    private $templating;

    /**
     * Mailer constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $templating
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }
    /**
     * @Route("/email", name="email", methods="GET")
     */

    public function sendEmail($ville, $travail, $email,$donnees, $donneesTravail)
    {

        $apiTravail = 'https://api.apixu.com/v1/forecast.json?key=ea49c70579214bf1b16204559181107&q=' . $travail . '&lang=fr';
        $responseTravail = file_get_contents($apiTravail);
        $jsontravail = json_decode($responseTravail);

        $api = 'https://api.apixu.com/v1/forecast.json?key=ea49c70579214bf1b16204559181107&q=' . $ville . '&lang=fr';
        $response = file_get_contents($api);
        $jsonobj = json_decode($response);

        $body = $this->templating->render('email.html.twig',[
            'open' => $jsonobj,
            'donneesTravail' => $donneesTravail,
            'opentravail' => $jsontravail,
            'donnees' => $donnees
        ]);

        $message = (new\Swift_Message('Votre bulletin quotidien de qualité de l\'air'))
            ->setFrom('ATMO@grandest')
            ->setTo($email)
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
}

