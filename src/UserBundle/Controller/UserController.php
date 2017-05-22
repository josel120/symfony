<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

class UserController extends Controller
{
    public function indexAction()
    {
        $em = $this -> getDoctrine()->getManager();
        $users = $em->getRepository('UserBundle:User')->findAll();
        $res = 'Lista de usuarios: <br />';
        /*
        foreach($users as $user)
        {
            $res .= 'Usuario: '. $user->getUsername(). '- Email: '.$user->getEmail().'<br />';
        }
        return new Response($res);
        */

        return $this->render('UserBundle:User:index.html.twig',array('users' => $users));
    }
    public function addAction()
    {
        $user = new User();
        $form = $this->createCreateForm($user);

        return $this->render('UserBundle:User:add.html.twig',array('form' => $form->createView()));
    }
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserType(),$entity,array(
            'action' => $this->generateUrl('user_create'),
            'method' => 'POST'
        ));
        return $form;
    }
    public function createAction(Request $request)
    {   
        $user = new User();
        $form = $this->createCreateForm($user);
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $password = $form->get('password')->getData();
            
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $password);
            
            $user->setPassword($encoded);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            return $this->redirectToRoute('user_index');
        }
        
        return $this->render('UserBundle:User:add.html.twig', array('form' => $form->createView()));
    }
    public function editAction($id)
    {
        return new Response('Hola editar '.$id);
    }
    public function viewAction($id)
    {
        $em = $this -> getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:User');
        $user = $repository->find($id);

        return new Response('Usuario: '.$user->getUsername(). '- Email: '.$user->getEmail().'<br />');
    }
    public function deleteAction($id)
    {
        return new Response('Hola eliminar  '.$id);
    }
}
