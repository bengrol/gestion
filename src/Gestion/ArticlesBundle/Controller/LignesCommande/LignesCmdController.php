<?php

namespace Gestion\ArticlesBundle\Controller\LignesCommande;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Gestion\ArticlesBundle\Entity\LignesCommande ;
use Symfony\Component\HttpFoundation\JsonResponse;



class LignesCmdController extends Controller{
    
    
    
    
    public function updateAction(){
        
        $em = $this->getDoctrine()->getManager();
        $repoLignesCmd = $em->getRepository("Gestion\ArticlesBundle\Entity\LignesCommande");
        
        $LigneCmd  = $repoLignesCmd->findOneById(65);
        
        $response = new JsonResponse();
        
        
        return $response->setData(array(
            'class'=> $LigneCmd->getDesignation(),
            ));
        
        
    
    }
    
}