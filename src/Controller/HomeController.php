<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * 
     */
    public function index(): Response
    {
        $db = $this->getParameter('app.database_name');

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'title' => 'Meine Homepage',
            'loglevel' => $_SERVER['LOG_LEVEL'],
            'db' => $db,
            'icon' => 'Sm.png'
        ]);
    }

    /**
     * @Route("/", name="mailer")
     */
    // public function index(MailerInterface $mailer)
    // {
    //     $email = (new Email())
    //         ->from('contact@smweblou.fr')
    //         ->to('kremer22700@gmail.com')
    //         ->subject('This e-mail is for testing purpose')
    //         ->text('This is the text version')
    //         ->html('<p>This is the HTML version</p>')
    //     ;

    //     $mailer->send($email);

    //     return $this->render('home/index.html.twig', [
    //         'controller_name' => 'MailController',
    //     ]);
    // }
}
