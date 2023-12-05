<?php

namespace App\Controller;

use App\Repository\HomeTableRepository;
use App\Repository\SubdomainTableRepository;
use App\Repository\DatabaseTableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Debug;
use App\Entity\HomeTable;
use App\Entity\SubdomainTable;



class HomeController extends AbstractController
{
    /**
     * 
     */
    public function index(Debug $debug, HomeTableRepository $homeTableRepository, 
                            SubdomainTableRepository $subdomainTableRepository,
                            DatabaseTableRepository $databaseTableRepository
                        ): Response
    {
        $table_name = $this->getParameter('app.database_home_table_name');
        $db = $homeTableRepository->findOneby(['name' => $table_name]);
        $subdomains = $subdomainTableRepository->findAll();
        $databases = $databaseTableRepository->findAll();
        foreach ($subdomains as $subdomain) {
            $debug->debug ($subdomain->getName());
        }
        $debug->debug ($db->getIcon());
        //dd ($this->getUser());
        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUsername();
        }

        return $this->render('index.html.twig', [
            'controller_name' => 'HomeController',
            'title' => 'Home SMWEB',
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => $_SERVER['HTTP_HOST'],
            'news' => 'BREAKING NEWS',
            'show_navbar' => true,
            'show_gallery' => true,
            'db' => $db->getName(),
            'server_base' => $_SERVER['BASE'],
            'subdomains' => $subdomains,
            'databases' => $databases,
            'username' => $username,
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
