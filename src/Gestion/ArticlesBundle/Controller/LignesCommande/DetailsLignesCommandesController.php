<?php

namespace Gestion\ArticlesBundle\Controller\LignesCommande;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Gestion\ArticlesBundle\Entity\LignesCommande ;
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Description of DetailsLignesCommandes
 *
 * @author macboook
 */
class DetailsLignesCommandesController extends Controller{
    
    public function EditAction(){
        
       $em = $this->getDoctrine()->getManager();
       $repoLg = $em->getRepository("GestionArticlesBundle:LignesCommande");
        
        
        $request = $this->get('request')->request;
        $id =  $request->get('idLgCmd');
        $detail =  $request->get('detail');
        
        $lgCmd = $repoLg->findOneById($id);
       
        $lgCmd->setDetail($detail);
        
        $em->persist($lgCmd);
        $em->flush();
        
         $response = new JsonResponse();
        return $response->setData(array(
            'lg'=> $lgCmd->getId()
                ));
        
    }
    
    
    
    
    
    
    
}
