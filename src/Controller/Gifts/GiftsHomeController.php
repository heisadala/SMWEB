<?php

namespace App\Controller\Gifts;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Debug;
use App\Repository\GiftsTableRepository;
use App\Repository\FormTableRepository;
use App\Entity\GiftsTable;
use App\Repository\DatabaseTableRepository;
use App\Repository\GiftsUserRepository;
use App\Form\GiftsAddFormType;
use App\Form\GiftsDeleteFormType;
use App\Form\GiftsEditFormType;
use App\Form\GiftsArchiveFormType;
use App\Form\GiftsUnarchiveFormType;
class GiftsHomeController extends AbstractController
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

    public function index(string $viewFormat, int $rowNumbers, Debug $debug, 
                            DatabaseTableRepository $databaseTableRepository, 
                            GiftsTableRepository $giftsTableRepository,
                            GiftsUserRepository $giftsUserRepository
                        ): Response
    {
        $app = 'GIFTS';

        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUsername();
        }
 
        $giftsUsers = $giftsUserRepository->fetch_users_from_table(strtoupper($username));
        $db = $databaseTableRepository->findOneBy(array('name' => $app));
        $table_header_fields = $giftsTableRepository->fetch_header_fields_from_table($db->getTableName());

        $primary_key_name = $giftsTableRepository->get_pk_name($db->getTableName());
        // dd($table_header_fields);
        $primary_key_column = $this->get_pk_column($table_header_fields, $primary_key_name);

        $sort = isset($_GET['sort']) ? $_GET['sort'] : $primary_key_name;
        $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
        $up_or_down = $sort_order == 'ASC' ? 'down' : 'up';
        $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

        $gifts_table_content = $giftsTableRepository->fetch_class_from_table_all_ordered($db->getTableName(),
                                                                                   'NO', 'NO', $sort, $sort_order);

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
            'header_image' => $db->getIcon(),
            'news' => '',
            'show_navbar' => true,
            'show_navbar_home' => true,
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
            'username' => $username,
            'giftusers' => $giftsUsers

        ]);
    }


    public function archive_page(string $viewFormat, int $rowNumbers, Debug $debug, 
                            DatabaseTableRepository $databaseTableRepository, 
                            GiftsTableRepository $giftsTableRepository,
                            GiftsUserRepository $giftsUserRepository
                        ): Response
    {
        $app = 'GIFTS';

        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUsername();
        }
 
        $giftsUsers = $giftsUserRepository->fetch_users_from_table(strtoupper($username));
        $db = $databaseTableRepository->findOneBy(array('name' => $app));
        $table_header_fields = $giftsTableRepository->fetch_header_fields_from_table($db->getTableName());

        $primary_key_name = $giftsTableRepository->get_pk_name($db->getTableName());
        // dd($table_header_fields);
        $primary_key_column = $this->get_pk_column($table_header_fields, $primary_key_name);

        $sort = isset($_GET['sort']) ? $_GET['sort'] : $primary_key_name;
        $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
        $up_or_down = $sort_order == 'ASC' ? 'down' : 'up';
        $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

        $gifts_table_content = $giftsTableRepository->fetch_class_from_table_all_ordered($db->getTableName(),
                                                                                   'YES', 'NO',  $sort, $sort_order);

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
            'title' => 'ARCHIVE ' . $app,
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => "",
            'header_image' => 'Archive.png',
            'news' => '',
            'show_navbar' => true,
            'show_navbar_archive' => true,
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
            'username' => $username,
            'giftusers' => $giftsUsers
        ]);
    }


    public function add(FormTableRepository $formTableRepository,
                        Request $request,
                        EntityManagerInterface $em,
                        ValidatorInterface $validator
                        ): Response
    {
        $app = 'GIFTS';

        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUsername();
        }
 

        $form_title = 'ADD';
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));

        $gifts_table = new GiftsTable();
        $form = $this->createForm(GiftsAddFormType::class, $gifts_table);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // dd($lego_table);
             $gifts_table->setArchive('NO');
             $gifts_table->setUserlist('NO');
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
                             'header_image' => "add-item.png",
                             'server_base' => $_SERVER['BASE'],
                             'db' => $app,
                             'news' => '',
                             'show_form' => $form_title,
                             'gifts_form' => $form->createView(),
                             'username' => $username
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
                            'header_image' => "delete-item.png",
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
        $article = $giftsTableRepository->findOneBy(array($pk_name => $ref));
        $form = $this->createForm(GiftsEditFormType::class, $article);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($lego_table);
            $giftsTableRepository->add($article, true);

            $userlist = $article->getUserlist();
            $user = $article->getName();
            if ($userlist == 'YES') {
                return $this->redirectToRoute('gifts_userpage', array('viewFormat ' => 'table',
                'rowNumbers' => '10',
                'user' => $user
                ));

            } else {
                return $this->redirectToRoute('gifts_homepage');
            }
        }

        return $this->render('index.html.twig',[
                            'controller_name' => 'GiftsHomeController',
                            'title' => $form_title . ' ' . $app . ' ITEM',
                            'icon' => $form_db->getIcon(),
                            'background' => $form_db->getBackground(),
                            'header_title' => '',
                            'header_image' => "edit-item.png",
                            'server_base' => $_SERVER['BASE'],
                            'db' => $app,
                            'news' => '',
                            'show_form' => $form_title,
                            'gifts_form' => $form->createView(),
                            'username' => $username
                             ]
        );
    }


    public function archive(string $pk_name, int $ref,
                            Request $request,
                            EntityManagerInterface $em,
                            FormTableRepository $formTableRepository,
                            GiftsTableRepository $giftsTableRepository
                            ): Response
    {

        $app = 'GIFTS';
        $form_title = 'ARCHIVE';
        $username = "";
        if ($this->getUser()) {
        $username = $this->getUser()->getUsername();
        }
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));
        // dd($form_db);
        $gifts_table = new GiftsTable();
        $article = $giftsTableRepository->findOneBy(array($pk_name => $ref));
        // dd($article);
        $form = $this->createForm(GiftsArchiveFormType::class, $article);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setArchive('YES');
            // dd($article);
            $giftsTableRepository->archive($article, true);

            return $this->redirectToRoute('gifts_homepage');
        }

        return $this->render('index.html.twig',[
                            'controller_name' => 'GiftsHomeController',
                            'title' => $form_title . ' ' . $app . ' ITEM',
                            'icon' => $form_db->getIcon(),
                            'background' => $form_db->getBackground(),
                            'header_title' => '',
                            'header_image' => "archive-item.png",
                            'server_base' => $_SERVER['BASE'],
                            'db' => $app,
                            'news' => '',
                            'show_form' => $form_title,
                            'gifts_form' => $form->createView(),
                            'username' => $username
                            ]
        );
    }

    public function unarchive(string $pk_name, int $ref,
                            Request $request,
                            EntityManagerInterface $em,
                            FormTableRepository $formTableRepository,
                            GiftsTableRepository $giftsTableRepository
                            ): Response
    {

        $app = 'GIFTS';
        $form_title = 'UNARCHIVE';
        $username = "";
        if ($this->getUser()) {
        $username = $this->getUser()->getUsername();
        }
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));
        // dd($form_db);
        $gifts_table = new GiftsTable();
        $article = $giftsTableRepository->findOneBy(array($pk_name => $ref));
        // dd($article);
        $form = $this->createForm(GiftsUnarchiveFormType::class, $article);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setArchive('NO');
            $article->setUserlist('NO');
            // dd($article);
            $giftsTableRepository->archive($article, true);

            return $this->redirectToRoute('gifts_homepage');
        }

        return $this->render('index.html.twig',[
                            'controller_name' => 'GiftsHomeController',
                            'title' => $form_title . ' ' . $app . ' ITEM',
                            'icon' => $form_db->getIcon(),
                            'background' => $form_db->getBackground(),
                            'header_title' => '',
                            'header_image' => "unarchive-item.png",
                            'server_base' => $_SERVER['BASE'],
                            'db' => $app,
                            'news' => '',
                            'show_form' => $form_title,
                            'gifts_form' => $form->createView(),
                            'username' => $username
                            ]
        );
    }

    public function user(string $viewFormat, int $rowNumbers, string $user, Debug $debug, 
                            GiftsUserRepository $giftsUserRepository, 
                            GiftsTableRepository $giftsTableRepository
                        ): Response
    {
        $app = $user;
        // dd ($user);
        $username = "";
        if ($this->getUser()) {
            $username = $this->getUser()->getUsername();
        }
 
        $giftsUsers = $giftsUserRepository->fetch_users_from_table(strtoupper($username));
        $db = $giftsUserRepository->findOneBy(array('name' => $app));
        $table_header_fields = $giftsTableRepository->fetch_header_fields_from_table($db->getTableName());

        $primary_key_name = $giftsTableRepository->get_pk_name($db->getTableName());
        // dd($table_header_fields);
        $primary_key_column = $this->get_pk_column($table_header_fields, $primary_key_name);

        $sort = isset($_GET['sort']) ? $_GET['sort'] : $primary_key_name;
        $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
        $up_or_down = $sort_order == 'ASC' ? 'down' : 'up';
        $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

        $gifts_table_content = $giftsTableRepository->fetch_class_from_table_user_ordered($db->getTableName(),
                                                                        $user, 'NO', $sort, $sort_order);

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
            'title' => $app . ' GIFTS',
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => "",
            'header_image' => $db->getIcon(),
            'news' => '',
            'show_navbar' => true,
            'show_navbar_user' => true,
            'show_table' => $showTable,
            'show_gallery' => $showGallery,
            'db' => 'GIFTS',
            'server_base' => $_SERVER['BASE'],
            'table_header_fields' => $table_header_fields,
            'gifts_table_content' => $gifts_table_content,
            'primary_key_name' => $primary_key_name,
            'primary_key_column' => $primary_key_column,
            'show_row_number' => $rowNumbers,
            'asc_or_desc' => $asc_or_desc,
            'up_or_down' => $up_or_down,
            'username' => $username,
            'user' => $user,
            'giftusers' => $giftsUsers
        ]);

    }

    public function user_add(string $user, FormTableRepository $formTableRepository,
                        Request $request,
                        EntityManagerInterface $em,
                        ValidatorInterface $validator
                        ): Response
    {
        $app = 'GIFTS';
        $form_title = 'ADD';
        $form_db = $formTableRepository->findOneBy(array('name' => $app . '_' . $form_title));

        $gifts_table = new GiftsTable();
        $gifts_table->setName($user);
        $form = $this->createForm(GiftsAddFormType::class, $gifts_table);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // dd($lego_table);
             $gifts_table->setArchive('NO');
             $gifts_table->setUserlist('YES');
             $em->persist($gifts_table);
             $em->flush();
             return $this->redirectToRoute('gifts_userpage', array('viewFormat ' => 'table',
                                                'rowNumbers' => '10',
                                                'user' => $user
                                                ));
        }

        return $this->render('index.html.twig',[
                             'controller_name' => 'GiftsHomeController',
                             'title' => $form_title . ' ' . $app . ' ITEM',
                             'icon' => $form_db->getIcon(),
                             'background' => $form_db->getBackground(),
                             'header_title' => '',
                             'header_image' => "add-item.png",
                             'server_base' => $_SERVER['BASE'],
                             'db' => $app,
                             'news' => '',
                             'show_form' => $form_title,
                             'gifts_form' => $form->createView(),
                             ]
                            );

    }



}