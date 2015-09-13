<?php

namespace Gestion\ArticlesBundle\Controller\Categories;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GetArticlesController extends Controller
{
    public function indexAction($id )
    {
        
        $em = $this->getDoctrine()->getManager();
        
   
            $req = 'SELECT c  '
                . 'FROM GestionArticlesBundle:Categories c '
                . 'ORDER BY c.nom ASC ';
            $query = $em->createQuery($req );
            $listeArticle = $query->getResult();

            
          return $this->render('GestionArticlesBundle:Articles:getAll.html.twig', 
                  array(
                      'listeArticle' =>$listeArticle
                  ));  
        
        
    }
    
    public function homeAction( )
    {
        return $this->render('GestionArticlesBundle:Articles:home.html.twig');  
    }
}
