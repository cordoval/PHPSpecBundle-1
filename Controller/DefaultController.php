<?php

namespace PHPSpec\PHPSpecBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('PHPSpecBundle:Default:index.html.twig', array('name' => $name));
    }
}
