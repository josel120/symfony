<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function indexAction()
    {
        $em = $this -> getDoctrine()->getManager();
        $users = $em->getRepository('UserBundle:User')->findAll();
        $res = 'Lista de usuarios: <br />';

        foreach($users as $user)
        {
            $res .= 'Usuario: '. $user->getUsername(). '- Email: '.$user->getEmail().'<br />';
        }
        return new Response($res);
    }
    public function addAction()
    {
        return new Response('Hola agregar ');
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
