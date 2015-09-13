<?php

namespace Gestion\ArticlesBundle\Controller\Paiements;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\ArticlesBundle\Form\PaiementsType;


class PaiementsController extends Controller // A FAIRE
{

    const REPO = "GestionArticlesBundle:Paiements";

    
    public function createAction($idCmd){
      
       $em = $this->getDoctrine()->getManager();
       $repo = $em->getRepository("GestionArticlesBundle:Commandes");
       $cmd = $repo->findOneBy(array('id' =>$idCmd));
       $form = $this->createForm(new PaiementsType($cmd) , null);
       
       
       $request = $this->getRequest(); 
       $form->handleRequest($request);
        
        
        if($form->isValid()){
            $paiement = $form->getData();
            
            $paiement->setSalarie($this->getUser());
            $em->persist($paiement);
            $em->flush();

            $cmd->setSoldeByAfterPaiement();  
            $em->flush();
            return $this->render('GestionArticlesBundle:Partials:sectionPayement.html.twig', array('cmd'=>$cmd));
        }
        
        return $this->render('GestionArticlesBundle:Partials:sectionPaiementsForm.html.twig',
                array('form'=>$form->createView(), 'cmd'=> $cmd));
    }
    
    
    public function getSectionPayementAction($cmd){ //no used
        
        return $this->render('GestionArticlesBundle:Partials:sectionPayement.html.twig', array('cmd'=>$cmd));
    }
    
    
    
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(self::REPO);
        $lignePaiement = $repo->find($id);
        $cmd = $lignePaiement->getCommande();
        
        
        $em->remove($lignePaiement);
        $em->flush();
        
        
        $cmd->setSoldeByAfterPaiement();

        $em->flush();
        return $this->render(
                'GestionArticlesBundle:Partials:sectionPayement.html.twig',
                array('cmd'=>$cmd));
    }

    
    

}
