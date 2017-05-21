<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function indexAction()
    {
        return new Response('Hola newbie');
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
        return new Response('Hola detalles '.$id);
    }
    public function deleteAction($id)
    {
        return new Response('Hola eliminar  '.$id);
    }
}
