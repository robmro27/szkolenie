<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $task = new \AppBundle\Entity\Task();

        $form = $this->createFormBuilder($task)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        
        $tasks = $em->getRepository('AppBundle:Task')->findAll();
        $user = $this->getUser();
        
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'tasks' => $tasks,
            'form' => $form->createView(),
            'user' => $user,
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}
