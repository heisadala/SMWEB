<?php

namespace App\Controller\Database;

use App\Repository\HomeTableRepository;
use App\Repository\DatabaseTableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\HomeTable;
use App\Entity\SubdomainTable;



class DatabaseHomeController extends AbstractController
{
    /**
     * 
     */
    public function index(
                            DatabaseTableRepository $databaseTableRepository
                        ): Response
    {
        $db = $databaseTableRepository->findOneBy(array('name' => 'DB'));

        $databases = $databaseTableRepository->findAll();

        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUserIdentifier();
        }
        
        return $this->render('index.html.twig', [
            'controller_name' => 'DatabaseHomeController',
            'title' => 'Home',
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => "",
            'header_image' => $db->getIcon(),
            'news' => '',
            'show_navbar' => true,
            'show_gallery' => true,
            'db' => $db->getName(),
            'server_base' => $_SERVER['BASE'],
            'databases' => $databases,
            'username' => $username,
        ]);
    }


}
