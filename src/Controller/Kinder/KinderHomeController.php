<?php

namespace App\Controller\Kinder;

use App\Repository\DatabaseTableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;



class KinderHomeController extends AbstractController
{
    /**
     * 
     */
    public function index( 
                            DatabaseTableRepository $databaseTableRepository
                        ): Response
    {
        $db = $databaseTableRepository->findOneBy(array('name' => 'KINDER'));


        return $this->render('index.html.twig', [
            'controller_name' => 'KinderHomeController',
            'title' => 'Home KINDER',
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