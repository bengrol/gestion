<?php

namespace Gestion\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\ArticlesBundle\Form\MoyensPaiementType ;

class MoyensPaiementController extends Controller
{
    public function createAction(){
        $form = $this->createForm(new MoyensPaiementType(), null);
        $request = $this->getRequest(); 
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $object = $form->getData();
            
            $em->persist($object);
            $em->flush();
            
            $flash = $this->get('session');
             $flash->getFlashBag()->add(
                        'notice',
                        'Le Moyen Paiement '.$object->getNom().' a bien ete créé'
                        );
             
             return $this->redirect($this->generateUrl('gestion_core_moyenspaiement_homepage'));
            
        }
    return $this->render(
                'GestionCoreBundle:MoyensPaiement:create.html.twig',
                array('form'=> $form->createView()));
    }
   
    public function getAllAction($temp = 'core'){
        
        switch ($temp) {
            case 'core': 
                $rd = 'GestionCoreBundle:MoyensPaiement:getAll.html.twig';
                break;
            case 'partial': 
                $rd = 'GestionArticlesBundle:Partials:sectionMPayement.html.twig';
                break;
            default:
                $rd = 'GestionCoreBundle:MoyensPaiement:getAll.html.twig';
                break;
        }
        
        
        
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:MoyensPaiement");
        $all = $repo->findAll();
        
        return $this->render($rd, array('all'=>$all));
    }
    
    public function updateAction($id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:MoyensPaiement");
        
        $moyenpaiement = $repo->find($id);
        $form = $this->createForm(new MoyensPaiementType(), $moyenpaiement);
        
        $request = $this->getRequest(); 
        $form->handleRequest($request);
        
        if($form->isValid()){
            $moyenpaiement = $form->getData();
            
            $em->persist($moyenpaiement);
            $em->flush();
            
            $flash = $this->get('session');
            $flash->getFlashBag()->add(
                        'notice',
                        'Le moyens de paiement '.$moyenpaiement->getNom().' a bien ete mis à jour'
                        );
            
            return $this->forward('GestionCoreBundle:MoyensPaiement:getAll');
            
        }
        return $this->render('GestionCoreBundle:MoyensPaiement:update.html.twig', 
                array('form'=>$form->createView(), 'categorie'=>$moyenpaiement));
    }
    
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:MoyensPaiement");
        $Categorie = $repo->find($id);
        
        $flash = $this->get('session');
            $flash->getFlashBag()->add(
                        'notice',
                        'Le Moyens de Paiement a bien ete supprimé'
                        );
            
      
        $em->remove($Categorie);
        $em->flush();
        
        return $this->redirect($this->generateUrl('gestion_core_moyenspaiement_homepage'));
    }
}
