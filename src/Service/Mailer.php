<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 12/07/2018
 * Time: 09:09
 */

namespace App\Service;

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

    public function sendEmail($ville, $travail, $email)
    {
        $body = $this->templating->render('email.html.twig',[
            'ville' => $ville,
            'travail' => $travail,
        ]);

        $message = (new\Swift_Message('infocontact'))
            ->setFrom($email)
            ->setTo('axelfertinel@gmail.com')
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
}

