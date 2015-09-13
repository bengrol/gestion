<?php

namespace Gestion\ArticlesBundle\Controller\Commandes;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\ArticlesBundle\Form\LignesCommandeType ;
use Gestion\ArticlesBundle\Entity\Commandes ;

class CommandesController extends Controller
{
    public function getDetailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repoCommand = $em->getRepository("GestionArticlesBundle:Commandes");
        $cmd = $repoCommand->find($id);

        return $this->render('GestionArticlesBundle:Commandes:detailCmd.html.twig' , 
                array(
                    "cmd" => $cmd)
                );
    }
    
    public function getAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repoCommand = $em->getRepository("GestionArticlesBundle:Commandes");
        $cmd = $repoCommand->find($id);
        
        $form = $this->createForm(new LignesCommandeType(), null);
       
        
        return $this->render('GestionArticlesBundle:Commandes:get.html.twig' , 
                array(
                    "cmd" => $cmd,
                    "form"=> $form->createView())
                );
    }
    
    public function deleteAction($id)
 { 
        
        $em = $this->getDoctrine()->getManager();
        $repoCommand = $em->getRepository("GestionArticlesBundle:Commandes");
        $cmd = $repoCommand->findOneBy(array('id' => $id));
        $p = $cmd->getPaiement();

        
        try {
            
            $p = $cmd->getPaiement();
            
                $em->remove($cmd);
                $em->flush();

               $flash = $this->get('session');
               $flash->getFlashBag()->add('notice', 'La commande a bien ete supprimé');
               
                    return $this->redirect($this->generateUrl('gestion_articles_getCommande' , 
                            array(
                                "id" => $cmd->getId()

                            ))
                    );

            
            
            
        } catch (\Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException $exc) {
            $flash = $this->get('session');
            $flash->getFlashBag()->add('warning',
                    'SUPPRESSION IMPOSSIBLE : La commande que vous tentez '
                    . 'de supprimer contient des paiements '
            );
            return $this->redirect($this->generateUrl('gestion_articles_getCommande' , 
                array(
                    "id" => $cmd->getId()
                    
                ))
        );
            
        }





    }

    
    
    
    public function createAction($client){
        
        $em = $this->getDoctrine()->getManager();
        $repoClient = $em->getRepository("GestionClientsBundle:Clients");
        $cl = $repoClient->find($client);
        
        
        $commande = new Commandes($cl);
        
        
        $em->persist($commande);
        $em->flush($commande);
        
        
        return $this->redirect($this->generateUrl('gestion_articles_getCommande' , 
                array(
                    "id" => $commande->getId()
                    
                ))
        );
        
    }
}
