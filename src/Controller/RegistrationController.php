<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\HomeTableRepository;

// #[IsGranted('ROLE_ADMIN)')]

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, 
                            UserPasswordHasherInterface $userPasswordHasher, 
                            EntityManagerInterface $entityManager,
                            HomeTableRepository $homeTableRepository): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        
        $table_name = $this->getParameter('app.database_home_table_name');
        $db = $homeTableRepository->findOneby(['name' => $table_name]);
        dd ($_SERVER['BASE']);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('homepage');
        }
        if ($_SERVER['HTTP_HOST'] == '') { $_SERVER['HTTP_HOST'] = '192.168.1.49';}
        return $this->render('index.html.twig', [
            'controller_name' => 'RegistrationController',
            'title' => 'Register EDT user',
            'show_register' => true,
            'icon' => $db->getIcon(),
            'background' => $db->getBackground(),
            'header_title' => $_SERVER['HTTP_HOST'],
            'news' => '',
            'db' => $db->getName(),
            'server_base' => $_SERVER['BASE'],
            'registrationForm' => $form->createView(),
        ]);
    }
}
