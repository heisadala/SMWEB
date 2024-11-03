<?php

namespace App\Controller\Shopping;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DatabaseTableRepository;

class ShoppingHomeController extends AbstractController
{
    /**
     */
    public function index(
                            DatabaseTableRepository $databaseTableRepository
                        ): Response
    {
        $db = $databaseTableRepository->findOneBy(array('name' => 'SHOPPING'));


        return $this->render('index.html.twig', [
            'controller_name' => 'ShoppingHomeController',
            'title' => 'Home SHOPPING',
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
