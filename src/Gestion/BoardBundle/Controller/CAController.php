<?php
namespace Gestion\BoardBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;


/**
 * Description of CAController
 *
 * @author macboook
 */
class CAController extends Controller{

    function getWeekAction(){
        
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("GestionArticlesBundle:LignesCommande");
        $repoUsers = $em->getRepository("GestionClientsBundle:User");
        
        $request = $this->get('request')->request;
        $date = array();
        
        if($this->get('request')->isMethod('POST')){
            $date =  $request->get('date');
            
        }
        
        
        $allUser = $repoUsers->findAll();
        $allLignesPaiement = array();
        
        
        
        foreach ($allUser as  $value ) {
            $tableau = array();
            
            
            $tableau['vendeur'] = $value->getUsername();
            $tableau['lignes'] = $repo->getCaPeriode($value->getId(), $date);
            
            array_push($allLignesPaiement, $tableau);
            
        }
        
       
        $listeCmd = $repo->getCmdPeriode( $date);
        
        $CaMoyenPaiement = $repo->getCaMoyenPayement($date);
        
        return $this->render('GestionBoardBundle:Default:board.html.twig', 
                array( 
                    'lg' => $allLignesPaiement ,
                    'lg2'=> $CaMoyenPaiement ,
                    'd'=> $date, 
                    'listeCmd' =>$listeCmd
                )
                );
    }
    
    
    
    function getDayAction (){
        
    }
    function getMonthAction(){
        
    }
    
    
    
    
}
