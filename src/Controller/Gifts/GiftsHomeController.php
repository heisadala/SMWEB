<?php

namespace App\Controller\Gifts;

use App\Repository\DatabaseTableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Debug;
use App\Repository\GiftsTableRepository;
use App\Repository\FormTableRepository;
use App\Entity\GiftsTable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\GiftsAddFormType;
use App\Form\GiftsDeleteFormType;
use App\Form\GiftsEditFormType;

class GiftsHomeController extends AbstractController
{
    /**
     * 
     */
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

    public function index(string $viewFormat, int $rowNumbers, Debug $debug, 
                            DatabaseTableRepository $databaseTableRepository, 
                            GiftsTableRepository $giftsTableRepository
                        ): Response
    {
        $app = 'GIFTS';

        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUsername();
        }
 
        $db = $databaseTableRepository->findOneBy(array('name' => $app));
        $table_header_fields = $giftsTableRepository->fetch_header_fields_from_table($db->getTableName());

        $primary_key_name = $giftsTableRepository->get_pk_name($db->getTableName());
        // dd($table_header_fields);
        $primary_key_column = $this->get_pk_column($table_header_fields, $primary_key_name);

        $sort = isset($_GET['sort']) ? $_GET['sort'] : $primary_key_name;
        $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
        $up_or_down = $sort_order == 'ASC' ? 'down' : 'up';
        $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

        $gifts_table_content = $giftsTableRepository->fetch_class_from_table_ordered($db->getTableName(),
                                                                                   $sort, $sort_order);

        $showTable = true;
        $showGallery = false;
        if ($viewFormat == 'table') {
            $showTable = true;
            $showGallery = false;
        } else {
            $showTable = false;
            $showGallery = true;
        }

        $debug->debug ($db->getName());


        return $this->render('index.html.twig', [
            'controller_name' => 'GiftsHomeController',
            'title' => 'Home ' . $app,
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => "",
            'header_image' => "Gifts",
            'news' => '',
            'show_navbar' => true,
            'show_table' => $showTable,
            'show_gallery' => $showGallery,
            'db' => $db->getName(),
            'server_base' => $_SERVER['BASE'],
            'table_header_fields' => $table_header_fields,
            'gifts_table_content' => $gifts_table_content,
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
        $app = 'GIFTS';
        $form_title = 'ADD';
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));

        $gifts_table = new GiftsTable();
        $form = $this->createForm(GiftsAddFormType::class, $gifts_table);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // dd($lego_table);
             $em->persist($gifts_table);
             $em->flush();
             return $this->redirectToRoute('gifts_homepage');
        }

        return $this->render('index.html.twig',[
                             'controller_name' => 'GiftsHomeController',
                             'title' => $form_title . ' ' . $app . ' ITEM',
                             'icon' => $form_db->getIcon(),
                             'background' => $form_db->getBackground(),
                             'header_title' => '',
                             'header_image' => "add-item",
                             'server_base' => $_SERVER['BASE'],
                             'db' => $app,
                             'news' => '',
                             'show_form' => $form_title,
                             'gifts_form' => $form->createView(),
                             ]
                            );

    }


    public function delete(string $pk_name, int $ref,
    Request $request,
    EntityManagerInterface $em,
    FormTableRepository $formTableRepository,
    GiftsTableRepository $giftsTableRepository
    ): Response
    {

        $app = 'GIFTS';
        $form_title = 'DELETE';
        $username = "";
        if ($this->getUser()) {
        $username = $this->getUser()->getUsername();
        }
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));
        // dd($form_db);
        $gifts_table = new GiftsTable();
        $article = $giftsTableRepository->findOneBy(array($pk_name => $ref));
        // dd($article);
        $form = $this->createForm(GiftsDeleteFormType::class, $article);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        // dd($lego_table);
        $giftsTableRepository->remove($article, true);

        return $this->redirectToRoute('gifts_homepage');
        }

        return $this->render('index.html.twig',[
        'controller_name' => 'GiftsHomeController',
        'title' => $form_title . ' ' . $app . ' ITEM',
        'icon' => $form_db->getIcon(),
        'background' => $form_db->getBackground(),
        'header_title' => '',
        'header_image' => "delete-item",
        'server_base' => $_SERVER['BASE'],
        'db' => $app,
        'news' => '',
        'show_form' => $form_title,
        'gifts_form' => $form->createView(),
        'username' => $username
        ]
        );
    }

    public function edit(string $pk_name, int $ref,
                        Request $request,
                        EntityManagerInterface $em,
                        FormTableRepository $formTableRepository,
                        GiftsTableRepository $giftsTableRepository
                        ): Response
    {

        $app = 'GIFTS';
        $form_title = 'EDIT';
        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUsername();
        }
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));
        // dd($form_db);
        $gifts_table = new GiftsTable();
        $article = $giftsTableRepository->findOneBy(array($pk_name => $ref));
        // dd($article);
        $form = $this->createForm(GiftsEditFormType::class, $article);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        // dd($lego_table);
        $giftsTableRepository->add($article, true);

        return $this->redirectToRoute('gifts_homepage');
        }

        return $this->render('index.html.twig',[
        'controller_name' => 'GiftsHomeController',
        'title' => $form_title . ' ' . $app . ' ITEM',
        'icon' => $form_db->getIcon(),
        'background' => $form_db->getBackground(),
        'header_title' => '',
        'header_image' => "edit-item",
        'server_base' => $_SERVER['BASE'],
        'db' => $app,
        'news' => '',
        'show_form' => $form_title,
        'gifts_form' => $form->createView(),
        'username' => $username
        ]
        );
    }


}