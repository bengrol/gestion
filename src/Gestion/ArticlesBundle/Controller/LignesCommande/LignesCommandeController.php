<?php

namespace Gestion\ArticlesBundle\Controller\LignesCommande;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\ArticlesBundle\Form\LignesCommandeType ;
use Gestion\ArticlesBundle\Entity\LignesCommande ;
use Symfony\Component\HttpFoundation\JsonResponse;


class LignesCommandeController extends Controller
{
    public function getOptionFormAction($cmd)
    {
        
        //$lg = new \Gestion\ArticlesBundle\Entity\Articles();
        
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:Articles");
        $allLgCmd = $repo->findAll();
       
        
        $lgTr = "{ label: '%s' , value: '%s' },";
       
        
        // creation de l'objet pour jQuery autocomplete
        $objJson = "[";
        foreach($allLgCmd as $lg){
            $val = addslashes($lg->getNom());
            $lab = $lg->getId();
            $v = sprintf($lgTr, $val , $lab);
            $objJson .= $v;
            
           
          
        }
        
        $objJson .= ']';
        
        
        $form = $this->createForm(new LignesCommandeType(), null);
        return $this->render('GestionArticlesBundle:Partials:lgForm.html.twig',  array(
                    "form" => $form->createView(),
                    "cmd"=>$cmd,
                    "obj"=>$objJson));
    }
    
    
    public function deleteAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:LignesCommande");
        $lgCmd = $repo->findOneBy(array('id'=>$id));
        
        $cmd = $lgCmd->getCommande();
        
        $em->remove($lgCmd);
        $em->flush();
   
        
        return $this->forward('GestionArticlesBundle:LignesCommande/LignesCommande:get',  array('cmd'=>$cmd));
        
    }
    
    public function createAction($idArticle, $idCmd)
    {
        
        $salarie = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $repoArticle = $em->getRepository("GestionArticlesBundle:Articles");
        $repoCmd = $em->getRepository("GestionArticlesBundle:Commandes");
        $article = $repoArticle->findOneBy(array('id'=>$idArticle));
        $commande = $repoCmd->findOneBy(array('id'=>$idCmd));
        
        $lgCmd = new LignesCommande( $article,$commande, $salarie);
       
        $em->persist($lgCmd);
        $em->refresh($commande);
        $em->flush();
                
        return $this->forward('GestionArticlesBundle:LignesCommande/LignesCommande:get',  array('cmd'=>$commande));
        
        
    }
    
    public function getAction($cmd){
        
        return $this->render('GestionArticlesBundle:Partials:detailLignesCommande.html.twig',
                array('cmd'=>$cmd)
                );
        
    }
    
    /*
     * 
     */
    public function updateAction(){
        
        
        $em = $this->getDoctrine()->getManager();
        
        $repoLignesCmd = $em->getRepository("Gestion\ArticlesBundle\Entity\LignesCommande");
        
        
        $designation = $this->get('request')->request->get('designation'); // ok
        $prixTTC = $this->get('request')->request->get('prixTTC'); // ok
        $detail = $this->get('request')->request->get('detail'); // ok
        
        $idLigneCmd = $this->get('request')->request->get('idLgnCmd'); // ok
        
        
        
        $LigneCmd  = $repoLignesCmd->findOneById($idLigneCmd);
        
        if(  isset($designation)){
            
           $LigneCmd->setDesignation($designation);

        }
        elseif( isset($prixTTC)){
            
            $newHT = $prixTTC / (($LigneCmd->getTva()/100)+1);
            $LigneCmd->setPrixHt($newHT);
            
            
        }
        elseif( isset($detail)){
            
            $LigneCmd->setDetail($detail);
            
        }
        
        
         $em->persist($LigneCmd);
         $em->flush();
        
        
       
        
        $response = new JsonResponse();
        return $response->setData(array(
            'designation'=> $designation,
            'designation 2'=> $LigneCmd->getDesignation(),
            'prixTTC' => $prixTTC, 
            'idLgnCmd'=>$idLigneCmd,
            'detail'=>$detail
                ));
        
        
    }

    

}
