<?php

namespace Gestion\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    
    public $infos = array(
            'adresse' => '3 bis rue st pavin des champs',
            'code_postal'=> '72000',
            'ville'=> 'Le Mans',
            'telephones' => array( 'fix'=> '0243288418'),
            'social' => array(
                'facebook'=> 'https://www.facebook.com/armany.coiffure/'),
            
            
        );    
    
    
    
    public function indexAction()
    {
       
        $em = $this->getDoctrine()->getManager();
        
        $repo = $em->getRepository("GestionArticlesBundle:Categories");
        $allCategories = $repo->findAll();

        
        return $this->render('GestionCoreBundle:Default:index.html.twig', 
                array(
                    'infos'=>$this->infos , 
                    'allCategories' => $allCategories)
                );
    }
    
    
    
    public function prestationsAction()
    {
       
        
        
        
        $em = $this->getDoctrine()->getManager();
        
        $repo = $em->getRepository("GestionArticlesBundle:Categories");
        $allCategories = $repo->findAll();

        
        return $this->render('GestionCoreBundle:Default:prestations.html.twig', 
                array(
                    'infos'=>$this->infos )
                );
    }
    
    
    public function contactAction()
    {
       
        
        
        return $this->render('GestionCoreBundle:Default:contact.html.twig', 
                array(
                    'infos'=>$this->infos )
                );
    }
    
    
    
    


    
}
