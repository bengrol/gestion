<?php

namespace Gestion\BoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        
        return $this->render('GestionBoardBundle:Default:index.html.twig');
    }
}
