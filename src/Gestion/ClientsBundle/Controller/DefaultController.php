<?php

namespace Gestion\ClientsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GestionClientsBundle:Default:index.html.twig');
    }
}
