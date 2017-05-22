<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
    * @Route("/", name="homepage")
    *
    */
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
}
