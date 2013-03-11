<?php

namespace AltCloud\Instance3AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ACInst3AdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
