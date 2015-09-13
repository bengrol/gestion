<?php

namespace Gestion\ArticlesBundle\Controller\Def;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GestionArticlesBundle:Default:partialTest.html.twig');
    }
}
