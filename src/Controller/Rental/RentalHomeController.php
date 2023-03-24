<?php

namespace App\Controller\Rental;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class RentalHomeController extends AbstractController
{

    public function index(): Response
    {
        $db = $this->getParameter('app.database_name');

        return $this->render('rental/index.html.twig', [
            'controller_name' => 'RentalHomeController',
            'title' => 'Rental',
            'loglevel' => $_SERVER['LOG_LEVEL'],
            'db' => $db,
            'icon' => 'Rental.png'
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
