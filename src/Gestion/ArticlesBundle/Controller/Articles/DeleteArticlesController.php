<?php

namespace Gestion\ArticlesBundle\Controller\Articles;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeleteArticlesController extends Controller
{
    public function indexAction($idArticle)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('GestionArticlesBundle:Articles');
        $article = $repo->find($idArticle);
        $em->remove($article);
        $em->flush();
        
        $flash = $this->get('session');
                $flash->getFlashBag()->add(
                            'notice',
                            'L\'article '.$article->getNom().' a bien été supprimé'
                            );
        
        return $this->forward('GestionArticlesBundle:GetArticles:index', 
                 array(
                      'idArticle' =>'all'
                  ));
        
        //return $this->forward('GestionCoreBundle:Default:index');
        
        
        
       // return $this->render('GestionArticlesBundle:Articles:delete.html.twig');
    }
}
