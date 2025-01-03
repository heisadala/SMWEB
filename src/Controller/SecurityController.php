<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\HomeTableRepository;

class SecurityController extends AbstractController
{

    public function login(AuthenticationUtils $authenticationUtils,
                        HomeTableRepository $homeTableRepository): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        $table_name = $this->getParameter('app.database_home_table_name');
        $db = $homeTableRepository->findOneby(['name' => $table_name]);
        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUserIdentifier();
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        if ($_SERVER['HTTP_HOST'] == '') { $_SERVER['HTTP_HOST'] = '192.168.1.49';}
        return $this->render('index.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error,
            'controller_name' => 'SecurityController',
            'title' => 'Login SMWEB',
            'show_login' => true,
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => $_SERVER['HTTP_HOST'],
            'news' => '',
            'db' => $db->getName(),
            'server_base' => $_SERVER['BASE'],
            'username' => $username,
     
        ]);

    }
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
