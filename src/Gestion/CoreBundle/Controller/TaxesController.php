<?php

namespace Gestion\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\ArticlesBundle\Form\TaxesType;

class TaxesController extends Controller
{
    public function createAction(){
        $form = $this->createForm(new TaxesType(), null);
        $request = $this->getRequest(); 
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $taxe = $form->getData();
            
            $em->persist($taxe);
            $em->flush();
            
            $flash = $this->get('session');
             $flash->getFlashBag()->add(
                        'notice',
                        'La taxe '.$taxe->getNom().' a bien ete créé'
                        );
             
             return $this->redirect($this->generateUrl('gestion_core_taxe_homepage'));
            
        }
    return $this->render(
                'GestionCoreBundle:Taxes:create.html.twig',
                array('form'=> $form->createView()));
    }
   
    public function getAllAction(){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:Taxes");
        $allTaxes = $repo->getAllValideTx();
        
        return $this->render('GestionCoreBundle:Taxes:index.html.twig', array('allTaxes'=>$allTaxes));
    }
    
    public function updateAction($id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:Taxes");
        
        $taxe = $repo->find($id);
        $form = $this->createForm(new TaxesType(), $taxe);
        
        $request = $this->getRequest(); 
        $form->handleRequest($request);
        
        if($form->isValid()){
            $taxe = $form->getData();
            
            $em->persist($taxe);
            $em->flush();
            
            $flash = $this->get('session');
            $flash->getFlashBag()->add(
                        'notice',
                        'La taxe '.$taxe->getNom().' a bien ete mis à jour'
                        );
        return $this->redirect($this->generateUrl('gestion_core_taxe_homepage'));
            
            
        }
        return $this->render('GestionCoreBundle:Taxes:update.html.twig', 
                array('form'=>$form->createView(), 'taxe'=>$taxe));
    }
    
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:Taxes");
        $taxe = $repo->find($id);
      
        $em->remove($taxe);
        $em->flush();
        
        
        $flash = $this->get('session');
        $flash->getFlashBag()->add(
                'notice',
                'La taxe '.$taxe->getNom().' a bien ete supprimé'
            );
        
        return $this->redirect($this->generateUrl('gestion_core_taxe_homepage'));
    }
    
}
