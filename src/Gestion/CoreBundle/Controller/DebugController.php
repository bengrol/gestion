<?php

namespace Gestion\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\ArticlesBundle\Form\CommandesType ;
use Gestion\ArticlesBundle\Entity\LignesCommande ;
use Gestion\ArticlesBundle\Form\LignesCommandeType ;

class DebugController extends Controller
{
       public function DefaulindexAction()
    {
                
        return $this->render('GestionArticlesBundle:Default:index.html.twig',
                array('var'=> "hello debug"));
    }
    
    
       public function indexAction()
    {
           $em = $this->getDoctrine()->getManager();
           $repoLgn = $em->getRepository('GestionArticlesBundle:LignesCommande');
           
           $repoCl = $em->getRepository('GestionClientsBundle:Clients');
           $lebow = $repoCl->find(219);
           
           $nom = $lebow->getNom();
                    
           $l = $repoLgn->getLgnCmdTechByClient($lebow);
           
           
           foreach ($l as $value) {
               echo '<pre>';
               //$id = $value->getId();
              //var_dump($id);
              var_dump($value);
               
               echo '</pre>'; 
           }
              
           
           
           
           
           die();
           
        return $this->render( 'GestionCoreBundle:Debug:index.html.twig',
                array(  )
                );
        
    }
    
    
    
       public function Test3indexAction()
    {
           
        $em = $this->getDoctrine()->getManager();
        $repoCmd = $em->getRepository("GestionArticlesBundle:Commandes");
        $cmd = $repoCmd->findOneBy(array("id" =>46));
        
        
        $repoArt = $em->getRepository("GestionArticlesBundle:Articles");
        $art = $repoArt->findOneBy(array("id" =>226));
        
        
        $form = $this->createForm(new CommandesType(), null);
        $request = $this->getRequest(); 
        
        
        $form->handleRequest($request);
        
        
        if($form->isValid()){
            
            die("ok");
            
            
        }
        
      //  die("no ok");
        
        
        
        return $this->render( 'GestionCoreBundle:Debug:index.html.twig',
                array( 'form'=> $form->createView() )
                );
    }
    
    
    public function Test2indexAction()
    {
        // test le form Commande
       // $form = $this->createForm(new CommandesType() , null);
        
        // test le form LignesCommande
        $em = $this->getDoctrine()->getManager();
        $repoCmd = $em->getRepository("GestionArticlesBundle:Commandes");
        $commande1 = $repoCmd->find(47);
        
        $repoArticle = $em->getRepository("GestionArticlesBundle:Articles");
        $article = $repoArticle->find(226);
        
        $lg = new LignesCommande($article, $commande1);
        
        $em->persist($lg);
                $em->flush();
        
        
        $form = $this->createForm(new LignesCommandeType(), $lg ,  array(
            'em' => $this->getDoctrine()->getManager()));
        
        //ini_set('html_errors', true);
      
        return $this->render( 'GestionCoreBundle:Debug:index.html.twig',
                array( 'form'=> $form->createView() )
                );
    }
    
    
    public function Old1Action()
    {
        
        $repoName = "GestionArticlesBundle:Articles";
        
        $params = array('pr'=>'DebugController');
        
        
        $em = $this->getDoctrine()->getManager();
        
      //  $repo = $em->getRepository($repoName);
        
//        $query = $em->createQuery(
//                'SELECT p  FROM GestionArticlesBundle:Taxes p '
//                . 'WHERE p.nom = :name'
//                )->setParameter('name', 'Taxe20');
//        
//        
        
        $entity = $em
            ->getRepository('GestionArticlesBundle:Articles')
            ->createQueryBuilder('a')
//            ->select('a, t')
            ->join('a.categorie', 'c')
            ->where("c.nom = 'Femme'")
            ->getQuery()
            ->getResult();
        
        $params['pr'] = $entity;
        
        //$rs = $repo->find(1);
        
        //var_dump($rs);
        
        ini_set('html_errors', true);
       //$params['pr'] = $repo->findOneByPrixHt(19);
        
        
        //$query = $repo->createQueryBuilder('pg')
        //       ->getQuery();
        
       // $params['pr'] =   $query->getResult();
        
        
        
        return $this->render($rt, $params);
    }
    


    
}
