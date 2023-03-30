<?php

namespace App\Controller\Rental;

use App\Repository\DatabaseTableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Debug;



class RentalHomeController extends AbstractController
{
    /**
     * 
     */
    public function index(Debug $debug, 
                            DatabaseTableRepository $databaseTableRepository
                        ): Response
    {
        $db = $databaseTableRepository->findOneBy(array('name' => 'RENTAL'));

        $debug->debug ($db->getName());

        return $this->render('index.html.twig', [
            'controller_name' => 'RentalHomeController',
            'title' => 'Home RENTAL',
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => $_SERVER['HOST'],
            'news' => '',
            'show_navbar' => false,
            'db' => $db->getName(),
            'server_base' => $_SERVER['BASE'],

        ]);
    }
}