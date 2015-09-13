<?php

namespace Gestion\ArticlesBundle\Controller\Articles;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\ArticlesBundle\Form\ArticlesType;



class CreateArticlesController extends Controller
{
    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $render = 'GestionArticlesBundle:Articles:create.html.twig';
        
        $form = $this->createForm(new ArticlesType(), null);
        $opt = array('form'=>$form->createView());
        
        $request = $this->getRequest(); 

        if ($form->handleRequest($request)->isValid()) {
            
            $article = $form->getData();
            
            $em->persist($article);
            $em->flush();
                

            $flash = $this->get('session');
            $flash->getFlashBag()->add(
                        'notice',
                        'L\'article '.$article->getNom().' a bien ete créé'
                        );
            
            $render = 'GestionArticlesBundle:Articles:get.html.twig';
        
            $opt =  array('article' => $article);
            
        }
        
        
        return $this->render($render, $opt);
    }
    

    
    
}
