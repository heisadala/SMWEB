<?php

namespace App\Controller\Database;

use App\Repository\HomeTableRepository;
use App\Repository\DatabaseTableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Debug;
use App\Entity\HomeTable;
use App\Entity\SubdomainTable;



class DatabaseHomeController extends AbstractController
{
    /**
     * 
     */
    public function index(Debug $debug,  
                            DatabaseTableRepository $databaseTableRepository
                        ): Response
    {
        $db = $databaseTableRepository->findOneBy(array('name' => 'DB'));

        $databases = $databaseTableRepository->findAll();

        
        return $this->render('index.html.twig', [
            'controller_name' => 'DatabaseHomeController',
            'title' => 'Home DB',
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => "",
            'header_image' => "Database",
            'news' => '',
            'show_navbar' => true,
            'show_gallery' => true,
            'db' => $db->getName(),
            'server_base' => $_SERVER['BASE'],
            'databases' => $databases,
        ]);
    }


}
