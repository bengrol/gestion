<?php

namespace Gestion\ArticlesBundle\Controller\Categories;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\ArticlesBundle\Form\CategoriesType ;

class CategoriesController extends Controller
{
    public function createAction(){
        $form = $this->createForm(new CategoriesType(), null);
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
                        'La Categorie '.$object->getNom().' a bien ete créé'
                        );
             
             return $this->redirect($this->generateUrl('gestion_core_categories_homepage'));
            
        }
    return $this->render(
                'GestionCoreBundle:Categories:create.html.twig',
                array('form'=> $form->createView()));
    }
   
    public function getAllAction($temp){
        $rd = 'GestionCoreBundle:Categories:getAll.html.twig';
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:Categories");
        $allCategories = $repo->findAll();
        
        if($temp == 'menu'){
            $rd = 'GestionArticlesBundle:Articles:getAll.html.twig';
            
        }
        if($temp == 'parametrage'){
            $rd = 'GestionCoreBundle:Categories:getAll.html.twig';
            
        }
        
        
        
        return $this->render($rd, array('allCategories'=>$allCategories));
    }
    
    public function updateAction($id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:Categories");
        
        $Categorie = $repo->find($id);
        $form = $this->createForm(new CategoriesType(), $Categorie);
        
        $request = $this->getRequest(); 
        $form->handleRequest($request);
        
        if($form->isValid()){
            $Categorie = $form->getData();
            $Categorie->setSlug();
            $em->persist($Categorie);
            $em->flush();
            
            $flash = $this->get('session');
            $flash->getFlashBag()->add(
                        'notice',
                        'La Categorie '.$Categorie->getNom().' a bien ete mis à jour'
                        );
            
            return $this->forward('GestionArticlesBundle:Categories\Categories:getAll', array('temp'=>'parametrage'));
            
        }
        return $this->render('GestionCoreBundle:Categories:update.html.twig', 
                array('form'=>$form->createView(), 'categorie'=>$Categorie));
    }
    
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:Categories");
        $Categorie = $repo->find($id);
        
        $flash = $this->get('session');
            $flash->getFlashBag()->add(
                        'notice',
                        'La Categorie a bien ete supprimé'
                        );
            
      
        $em->remove($Categorie);
        $em->flush();
        
        return $this->redirect($this->generateUrl('gestion_core_categories_homepage'));
    }
}
