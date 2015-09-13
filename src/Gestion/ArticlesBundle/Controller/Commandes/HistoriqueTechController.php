<?php

namespace Gestion\ArticlesBundle\Controller\Commandes;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HistoriqueTechController extends Controller
{

    
    public function getAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repoLgn = $em->getRepository('GestionArticlesBundle:LignesCommande');
           
        $repoCl = $em->getRepository('GestionClientsBundle:Clients');
        $lebow = $repoCl->find($id);
       
                    
        $historique = $repoLgn->getLgnCmdTechByClient($lebow);
           
        
        return $this->render('GestionArticlesBundle:Commandes:getHistorique.html.twig' ,
                array('historique'=>$historique));
    }
    
    
    
    
    
    
}
