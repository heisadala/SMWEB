<?php

namespace App\Controller\Lego;

use App\Entity\LegoTable;
use App\Form\LegoAddType;
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
            'title' => 'Home ' . $name,
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => "LEGO INVENTORY",
            'news' => '',
            'show_navbar' => true,
            'show_table' => true,
            'inc_java' => true,
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


    public function add(FormTableRepository $formTableRepository,
                        Request $request,
                        EntityManagerInterface $em,
                        ValidatorInterface $validator
                        ): Response
    {
        $name = 'LEGO';
        $errors = [];

        $form_db = $formTableRepository->findOneBy(array('name' => $name . '_ADD'));

        $lego_table = new LegoTable();
        $form = $this->createForm(LegoAddType::class, $lego_table);

        $form-> handlerequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // dd($lego_table);
             $em->persist($lego_table);
             $em->flush();
             return $this->redirectToRoute('lego_homepage');
        }

        elseif ($form->isSubmitted()) {
            // dd($form);
            $errors = $validator->validate($lego_table);
        }

        return $this->render('index.html.twig',[
                             'controller_name' => 'LegoHomeController',
                             'title' => 'ADD ' . $name,
                             'icon' => $form_db->getIcon(),
                             'background' => $form_db->getBackground(),
                             'header_title' => "ADD LEGO",
                             'server_base' => $_SERVER['BASE'],
                             'db' => 'LEGO',
                             'news' => '',
                             'show_form' => true,
                             'lego_form' => $form->createView(),
                             'error_ref_message' =>''
                             ]
                            );

    }

    public function delete(int $id,
                            LegoTableRepository $legoTableRepository
                            ): Response
    {

        $article = $legoTableRepository->getRepository(Article::class)->findBy(['id' => $id])[0];

        // L'article est supprimé
        $legoTableRepository->remove($article);

        return $this->redirectToRoute('lego_homepage');
    }

}