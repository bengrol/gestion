<?php

namespace Gestion\ArticlesBundle\Controller\Articles;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GetArticlesController extends Controller
{
    public function indexAction($idArticle )
    {
        
        $em = $this->getDoctrine()->getManager();
        
        
        if($idArticle == "all"){
            
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
        
        $req = 'SELECT c  '
                . 'FROM GestionArticlesBundle:Articles c '
                . 'where c.id = :id';
        
            $query = $em->createQuery($req )->setParameter('id', $idArticle);
            $article = $query->getSingleResult();
        

        
        
        return $this->render('GestionArticlesBundle:Articles:get.html.twig', 
                array('article' => $article));
    }
    
    public function homeAction( )
    {
        return $this->render('GestionArticlesBundle:Articles:home.html.twig');  
    }
}
