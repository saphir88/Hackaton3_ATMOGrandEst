<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 12/07/2018
 * Time: 09:09
 */

namespace App\Service;

class Mailer {

    public function sendEmail($name, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message(''))
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
        ;

        $mailer->send($message);

        return $this->render('');
    }

}

