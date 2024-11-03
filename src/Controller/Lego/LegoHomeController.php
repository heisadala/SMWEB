<?php

namespace App\Controller\Lego;

use App\Entity\LegoTable;
use App\Form\LegoAddFormType;
use App\Form\LegoDeleteFormType;
use App\Form\LegoEditFormType;
use App\Repository\DatabaseTableRepository;
use App\Repository\FormTableRepository;
use App\Repository\LegoTableRepository;
use App\Repository\LegoThemeRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\Debug;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Message;
use Symfony\Component\Validator\Validator\ValidatorInterface;


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
    public function index(string $viewFormat, int $rowNumbers,  
                        DatabaseTableRepository $databaseTableRepository, 
                        LegoTableRepository $legoTableRepository,
                        LegoThemeRepository $legoThemeRepository
                            ): Response
    {
        $app = 'LEGO';

        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUserIdentifier();
        }
 
        $db = $databaseTableRepository->findOneBy(array('name' => $app));
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
        // dd (count($lego_table_content));
        $lego_theme_content = $legoThemeRepository->findAll();

        $showTable = true;
        $showGallery = false;
        if ($viewFormat == 'table') {
            $showTable = true;
            $showGallery = false;
        } else {
            $showTable = false;
            $showGallery = true;
        }
        // dd($sort, $sort_order, $lego_table_content);
        // dd($table_header_fields);

        return $this->render('index.html.twig', [
            'controller_name' => 'LegoHomeController',
            'title' => 'Home ' . $app,
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => "",
            'header_image' => $db->getIcon(),
            'news' => '',
            'show_navbar' => true,
            'show_table' => $showTable,
            'show_gallery' => $showGallery,
            'db' => $db->getName(),
            'server_base' => $_SERVER['BASE'],
            'table_header_fields' => $table_header_fields,
            'lego_table_content' => $lego_table_content,
            'lego_theme_content' => $lego_theme_content,
            'primary_key_name' => $primary_key_name,
            'primary_key_column' => $primary_key_column,
            'show_row_number' => $rowNumbers,
            'asc_or_desc' => $asc_or_desc,
            'up_or_down' => $up_or_down,
            'username' => $username
        ]);
    }


    public function add(FormTableRepository $formTableRepository,
                        Request $request,
                        EntityManagerInterface $em,
                        ValidatorInterface $validator
                        ): Response
    {
        $app = 'LEGO';
        $form_title = 'ADD';
        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUserIdentifier();
        }
 
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));

        $lego_table = new LegoTable();
        $form = $this->createForm(LegoAddFormType::class, $lego_table);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // dd($lego_table);
             $em->persist($lego_table);
             $em->flush();
             return $this->redirectToRoute('lego_homepage');
        }

        return $this->render('index.html.twig',[
                             'controller_name' => 'LegoHomeController',
                             'title' => $form_title . ' ' . $app . ' ITEM',
                             'icon' => $form_db->getIcon(),
                             'background' => $form_db->getBackground(),
                             'header_title' => '',
                             'header_image' => "add-item.png",
                             'server_base' => $_SERVER['BASE'],
                             'db' => $app,
                             'news' => '',
                             'show_form' => $form_title,
                             'lego_form' => $form->createView(),
                             'username' => $username
                             ]
                            );

    }

    public function delete(string $pk_name, int $ref,
                            Request $request,
                            EntityManagerInterface $em,
                            FormTableRepository $formTableRepository,
                            LegoTableRepository $legoTableRepository
                            ): Response
    {

        $app = 'LEGO';
        $form_title = 'DELETE';
        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUserIdentifier();
        }
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));
        // dd($form_db);
        $lego_table = new LegoTable();
        $article = $legoTableRepository->findOneBy(array($pk_name => $ref));
        // dd($article);
        $form = $this->createForm(LegoDeleteFormType::class, $article);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // dd($lego_table);
             $legoTableRepository->remove($article, true);
             
             return $this->redirectToRoute('lego_homepage');
        }

        return $this->render('index.html.twig',[
            'controller_name' => 'LegoHomeController',
            'title' => $form_title . ' ' . $app . ' ITEM',
            'icon' => $form_db->getIcon(),
            'background' => $form_db->getBackground(),
            'header_title' => '',
            'header_image' => "delete-item.png",
            'server_base' => $_SERVER['BASE'],
            'db' => $app,
            'news' => '',
            'show_form' => $form_title,
            'lego_form' => $form->createView(),
            'username' => $username
            ]
           );
    }

    public function edit(string $pk_name, int $ref,
                        Request $request,
                        EntityManagerInterface $em,
                        FormTableRepository $formTableRepository,
                        LegoTableRepository $legoTableRepository
                        ): Response
    {

        $app = 'LEGO';
        $form_title = 'EDIT';
        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUserIdentifier();
        }
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));
        // dd($form_db);
        $lego_table = new LegoTable();
        $article = $legoTableRepository->findOneBy(array($pk_name => $ref));
        // dd($article);
        $form = $this->createForm(LegoEditFormType::class, $article);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        // dd($lego_table);
        $legoTableRepository->add($article, true);

        return $this->redirectToRoute('lego_homepage');
        }

        return $this->render('index.html.twig',[
        'controller_name' => 'LegoHomeController',
        'title' => $form_title . ' ' . $app . ' ITEM',
        'icon' => $form_db->getIcon(),
        'background' => $form_db->getBackground(),
        'header_title' => '',
        'header_image' => "edit-item.png",
        'server_base' => $_SERVER['BASE'],
        'db' => $app,
        'news' => '',
        'show_form' => $form_title,
        'lego_form' => $form->createView(),
        'username' => $username
        ]
        );
    }

}