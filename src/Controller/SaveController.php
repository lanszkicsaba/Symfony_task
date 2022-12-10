<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use App\Entity\UserTest;
use App\Form\UserTestFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Routing\Annotation\Route;

class SaveController extends AbstractController
{
    /**
     * @Route("/user-test-form")
     */
    public function show(Environment $twig, Request $request, EntityManagerInterface $entityManagerInterface)
    {
        $userform = new UserTest();

        $form = $this->createForm(UserTestFormType::class, $userform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManagerInterface->persist($userform);
            $entityManagerInterface->flush();

            return new Response('Successful');

        }

        return new Response($twig->render('user/usertest.html.twig', ['usertest_form' => $form->createView()]));

    }

    /**
     * @Route("/user-test-datas")
     */
    public function showData(): Response
    {
        $repository = $this->getDoctrine()->getRepository(UserTest::class);
        $users = $repository->findAll();

        return $this->render('user/usersdata.html.twig', ['controller_name' => 'SaveController', 'users' => $users]);
    }

    /**
     * @Route("/user-test-form/{id}")
     * Method({"GET", "POST"})
     */
    public function Edit(Request $request, $id, EntityManagerInterface $entityManagerInterface)
    {
        $userform = new UserTest();
        $userform = $this->getDoctrine()->getRepository(UserTest::class)->find($id);

        $form = $this->createFormBuilder($userform)
            ->add('name', TextType::class)
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Man' => "1",
                    'Female' => "2",
                ],
                'expanded' => true,
            ])
            ->add('address', TextType::class)
            ->add('aboutMe', TextareaType::class, ['row_attr' => array('cols' => '5', 'rows' => '5')])
            ->add('isActive', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ],
                'expanded' => true,
            ])
            ->add('Save', SubmitType::class)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManagerInterface->persist($userform);
            $entityManagerInterface->flush();

            return new Response('Successful');
        }
        return $this->render(
            'user/edit.html.twig',
            array(
                'usertest_form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/user-test-datas/{id}", name="DELETE")
     */
    public function ajaxDeleteItemAction(Request $request, $id, EntityManagerInterface $entityManager)
    {
        //javascript delete function delete2.js   

        $userform = $this->getDoctrine()->getRepository(UserTest::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($userform);
        $entityManager->flush();

        $response = new Response();
        $response->send();

        // Ajax delete function delete.js
        /**         if ($request->isXmlHttpRequest()) {
         *            $id = $request->get('entityId');
         *           $em = $this->getDoctrine()->getManager();
         *          $evenement = $em->getRepository(UserTest::class)->find($id);
         *        
         *                   $em->remove($evenement);
         *                   $em->flush();
         *        
         *        
         *                 return new JsonResponse('good');
         *              }   
         * */
    }
}