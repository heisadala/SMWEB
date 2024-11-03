<?php

namespace App\Controller\Cars;

use App\Repository\DatabaseTableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarsTableRepository;
use App\Repository\CarsFactureTableRepository;
use App\Repository\CarsCtTableRepository;
use App\Repository\CarsAssuranceTableRepository;



class CarsHomeController extends AbstractController
{
    /**
     * 
     */
    public function index(
                            DatabaseTableRepository $databaseTableRepository,
                            CarsTableRepository $carsTableRepository
                        ): Response
    {
        $db = $databaseTableRepository->findOneBy(array('name' => 'CARS'));

        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUserIdentifier();
        }
        $databases = $carsTableRepository->fetch_class_from_table_ordered('cars_table','registration', 'DESC');


        return $this->render('index.html.twig', [
            'controller_name' => 'CarsHomeController',
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
            'username' => $username,
            'databases' => $databases,
            'show_navbar_home' => true,

        ]);
    }

    public function plate(string $plate, 
                            DatabaseTableRepository $databaseTableRepository,
                            CarsTableRepository $carsTableRepository,
                            CarsFactureTableRepository $carsFactureTableRepository,
                            CarsCtTableRepository $carsCtTableRepository,
                            CarsAssuranceTableRepository $carsAssuranceTableRepository
                            ): Response
    {
        $db = $databaseTableRepository->findOneBy(array('name' => 'CARS'));

        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUserIdentifier();
        }
        // $databases = $carsFactureTableRepository->findAll();
        $cars_table = $carsTableRepository->findOneBy(array('plate' => $plate));
        $facture_table_header_fields = $carsFactureTableRepository->fetch_header_fields_from_table('cars_facture_table');
        $facture_table_content = $carsFactureTableRepository->findBy(array('plate' => $plate));

        $ct_table_header_fields = $carsCtTableRepository->fetch_header_fields_from_table('cars_ct_table');
        $ct_table_content = $carsCtTableRepository->findBy(array('plate' => $plate),array('date' => 'DESC'));

        $ass_table_header_fields = $carsAssuranceTableRepository->fetch_header_fields_from_table('cars_assurance_table');
        $ass_table_content = $carsAssuranceTableRepository->findBy(array('plate' => $plate),array('insurance' => 'DESC'));


        return $this->render('index.html.twig', [
                'controller_name' => 'CarsHomeController',
                'title' => 'Home',
                'icon' => $db->getIcon(),
                'background' => $db->getBackground(),
                'header_title' => "",
                'header_image' => $cars_table->getLogo(),
                'news' => '',
                'show_navbar' => true,
                'show_table' => true,
                'db' => $db->getName(),
                'server_base' => $_SERVER['BASE'],
                'username' => $username,
                'model' => $cars_table->getModel(),
                'plate' => $plate,
                'facture_table_content' => $facture_table_content,
                'facture_table_header_fields' => $facture_table_header_fields,
                'ct_table_content' => $ct_table_content,
                'ct_table_header_fields' => $ct_table_header_fields,
                'ass_table_content' => $ass_table_content,
                'ass_table_header_fields' => $ass_table_header_fields,
                'show_navbar_car' => true,

        ]);
    }
}