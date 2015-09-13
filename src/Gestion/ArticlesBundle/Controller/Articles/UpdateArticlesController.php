<?php

namespace Gestion\ArticlesBundle\Controller\Articles;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\ArticlesBundle\Form\ArticlesType;

class UpdateArticlesController extends Controller
{
    public function indexAction($idArticle)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:Articles");
        $repoTaxes = $em->getRepository("GestionArticlesBundle:Taxes");
        $repoCat = $em->getRepository("GestionArticlesBundle:Categories");
        
        
        $article = $repo->find($idArticle);
        
        
        $taxe = $repoTaxes->find($article->getTaxe()->getId());
        $cat = $repoCat->find($article->getCategorie()->getId());
        $article->setTaxe($taxe);
        $article->setCategorie($cat);
        
        
        $request = $this->getRequest(); 
        
        $form = $this->createForm(new ArticlesType(), $article);
       
        /*
         * si le formulaire est validé
         */
        if($request->isMethod("POST")){
            $form->bind($request);
            
            if($form->isValid()){
                
                $article = $form->getData();
                $em->persist($article);
                $em->flush();
                

                $flash = $this->get('session');
                $flash->getFlashBag()->add(
                            'notice',
                            'L\'article '.$article->getNom().' a bien été mis à jour'
                            );

            }
            
                       
        return $this->render('GestionArticlesBundle:Articles:get.html.twig', 
                array('article' => $article));
        
        }
     
        
        return $this->render('GestionArticlesBundle:Articles:Update.html.twig', 
                array(
                    'article' => $article,
                    'form'=>$form->createView()
       
                ));
    }
}
