<?php

namespace App\Controller\Lego;

use App\Repository\DatabaseTableRepository;
use App\Repository\LegoTableRepository;
use App\Repository\LegoThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\Debug;



class LegoHomeController extends AbstractController
{

    function get_pk_column($table_header_fields, $table_primary_key_name)
    {
        $i = 0;
        $pk_column = 0;
        foreach ($table_header_fields as $header_field) {
            $i++;
            if (strcmp($header_field['Field'], $table_primary_key_name) == 0) {
                $pk_column = $i;
            }
        }
        return $pk_column;
    }
    /**
     * 
     */
    public function index(Debug $debug, 
                        DatabaseTableRepository $databaseTableRepository, 
                        LegoTableRepository $legoTableRepository,
                        LegoThemeRepository $legoThemeRepository
                            ): Response
    {
        $name = 'LEGO';


        $db = $databaseTableRepository->findOneBy(array('name' => $name));
        $table_header_fields = $legoTableRepository->fetch_header_fields_from_table($db->getTableName());

        $primary_key_name = $legoTableRepository->get_pk_name($db->getTableName());
        // dd($table_header_fields);
        $primary_key_column = $this->get_pk_column($table_header_fields, $primary_key_name);

        $sort = isset($_GET['sort']) ? $_GET['sort'] : $primary_key_name;
        $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
        $up_or_down = $sort_order == 'ASC' ? 'down' : 'up';
        $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

        $lego_table_content = $legoTableRepository->fetch_class_from_table_ordered($db->getTableName(),
                                                                                   $sort, $sort_order);
        $lego_theme_content = $legoThemeRepository->findAll();

        
        // dd($sort, $sort_order, $lego_table_content);
        // dd($table_header_fields);
        $debug->debug ($db->getName());

        return $this->render('index.html.twig', [
            'controller_name' => 'LegoHomeController',
            'title' => 'Home LEGO' . $name,
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => "LEGO INVENTORY",
            'news' => '',
            'show_navbar' => false,
            'show_table' => true,
            'db' => $db->getName(),
            'server_base' => $_SERVER['BASE'],
            'table_header_fields' => $table_header_fields,
            'lego_table_content' => $lego_table_content,
            'lego_theme_content' => $lego_theme_content,
            'primary_key_name' => $primary_key_name,
            'primary_key_column' => $primary_key_column,
            'asc_or_desc' => $asc_or_desc,
            'up_or_down' => $up_or_down


        ]);
    }
}