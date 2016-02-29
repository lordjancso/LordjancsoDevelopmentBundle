<?php

namespace Lordjancso\DevelopmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LordjancsoDevelopmentBundle:Default:index.html.twig');
    }
}
