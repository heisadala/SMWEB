<?php

namespace App\Controller\Promo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DatabaseTableRepository;
use App\Repository\PromoTableRepository;
use App\Entity\PromoTable;
use App\Form\PromoAddFormType;
use App\Form\PromoDeleteFormType;
use App\Form\PromoEditFormType;
use App\Repository\FormTableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PromoController extends AbstractController
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
                        PromoTableRepository $promoTableRepository
                            ): Response
    {
        $app = 'PROMO';

        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUserIdentifier();
        }
 
        $db = $databaseTableRepository->findOneBy(array('name' => $app));
        $table_header_fields = $promoTableRepository->fetch_header_fields_from_table($db->getTableName());

        $primary_key_name = $promoTableRepository->get_pk_name($db->getTableName());
        // dd($table_header_fields);
        $primary_key_column = $this->get_pk_column($table_header_fields, $primary_key_name);

        $sort = isset($_GET['sort']) ? $_GET['sort'] : $primary_key_name;
        $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
        $up_or_down = $sort_order == 'ASC' ? 'down' : 'up';
        $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

        $promo_table_content = $promoTableRepository->fetch_class_from_table_ordered($db->getTableName(),
                                                                                   $sort, $sort_order);
        // dd (count($promo_table_content));

        $showTable = true;
        $showGallery = false;
        if ($viewFormat == 'table') {
            $showTable = true;
            $showGallery = false;
        } else {
            $showTable = false;
            $showGallery = true;
        }
        // dd($sort, $sort_order, $promo_table_content);
        // dd($table_header_fields);

        return $this->render('index.html.twig', [
            'controller_name' => 'PromoHomeController',
            'title' => 'Home ' . $app,
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => "",
            'header_image' => $db->getIcon(),
            'news' => '',
            'show_navbar' => true,
            'show_table' => $showTable,
            'db' => $db->getName(),
            'server_base' => $_SERVER['BASE'],
            'table_header_fields' => $table_header_fields,
            'promo_table_content' => $promo_table_content,
            'primary_key_name' => $primary_key_name,
            'primary_key_column' => $primary_key_column,
            'show_row_number' => $rowNumbers,
            'asc_or_desc' => $asc_or_desc,
            'up_or_down' => $up_or_down,
            'username' => $username,
            'show_navbar_home' => true
        ]);
    }

    public function add(FormTableRepository $formTableRepository,
                        Request $request,
                        EntityManagerInterface $em,
                        ValidatorInterface $validator
                        ): Response
    {
        $app = 'PROMO';

        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUserIdentifier();
        }
 

        $form_title = 'ADD';
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));

        $promo_table = new PromoTable();
        $form = $this->createForm(PromoAddFormType::class, $promo_table);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // dd($promo_table);
             $em->persist($promo_table);
             $em->flush();
             return $this->redirectToRoute('promo_homepage');
        }

        return $this->render('index.html.twig',[
                             'controller_name' => 'PromoController',
                             'title' => $form_title . ' ' . $app . ' ITEM',
                             'icon' => $form_db->getIcon(),
                             'background' => $form_db->getBackground(),
                             'header_title' => '',
                             'header_image' => "add-item.png",
                             'server_base' => $_SERVER['BASE'],
                             'db' => $app,
                             'news' => '',
                             'show_form' => $form_title,
                             'promo_form' => $form->createView(),
                             'username' => $username
                             ]
                            );

    }


    public function delete(string $pk_name, int $ref,
                            Request $request,
                            EntityManagerInterface $em,
                            FormTableRepository $formTableRepository,
                            PromoTableRepository $promoTableRepository
                            ): Response
    {

        $app = 'PROMO';
        $form_title = 'DELETE';
        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUserIdentifier();
        }
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));
        // dd($form_db);
        $promo_table = new PromoTable();
        $article = $promoTableRepository->findOneBy(array($pk_name => $ref));
        // dd($article);
        $form = $this->createForm(PromoDeleteFormType::class, $article);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // dd($promo_table);
             $promoTableRepository->remove($article, true);
             
             return $this->redirectToRoute('promo_homepage');
        }

        return $this->render('index.html.twig',[
            'controller_name' => 'PromoController',
            'title' => $form_title . ' ' . $app . ' ITEM',
            'icon' => $form_db->getIcon(),
            'background' => $form_db->getBackground(),
            'header_title' => '',
            'header_image' => "delete-item.png",
            'server_base' => $_SERVER['BASE'],
            'db' => $app,
            'news' => '',
            'show_form' => $form_title,
            'promo_form' => $form->createView(),
            'username' => $username
            ]
           );
    }

    public function edit(string $pk_name, int $ref,
                        Request $request,
                        EntityManagerInterface $em,
                        FormTableRepository $formTableRepository,
                        PromoTableRepository $promoTableRepository
                        ): Response
    {

        $app = 'PROMO';
        $form_title = 'EDIT';
        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUserIdentifier();
        }
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));
        // dd($form_db);
        $promo_table = new PromoTable();
        $article = $promoTableRepository->findOneBy(array($pk_name => $ref));
        // dd($article);
        $form = $this->createForm(PromoEditFormType::class, $article);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        // dd($promo_table);
        $promoTableRepository->add($article, true);

        return $this->redirectToRoute('promo_homepage');
        }

        return $this->render('index.html.twig',[
        'controller_name' => 'PromoController',
        'title' => $form_title . ' ' . $app . ' ITEM',
        'icon' => $form_db->getIcon(),
        'background' => $form_db->getBackground(),
        'header_title' => '',
        'header_image' => "edit-item.png",
        'server_base' => $_SERVER['BASE'],
        'db' => $app,
        'news' => '',
        'show_form' => $form_title,
        'promo_form' => $form->createView(),
        'username' => $username
        ]
        );
    }


}
