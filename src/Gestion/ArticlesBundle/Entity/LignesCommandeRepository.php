<?php

namespace Gestion\ArticlesBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * LignesCommandeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LignesCommandeRepository extends EntityRepository
{
    
        public function getLgnCmdTechByClient($client) {

    $reqJoin = 'SELECT lc.detail , c.id , c.dateCmd ' 
                .'FROM GestionArticlesBundle:LignesCommande lc '
                .'LEFT JOIN GestionArticlesBundle:Commandes c '
                . 'WITH lc.commande = c.id '
                . 'WHERE lc.detail IS NOT NULL '
                .'AND c.client = :idclient ';
            
            $listeLG  = $this->getEntityManager()
                        ->createQuery($reqJoin)
                        ->setParameter('idclient', $client)
                        ->getResult();
            
            
            
        return $listeLG;
    }

    
    public function getCaPeriode($user, $date) {
  
        
                if(!isset($date['debut']) | empty($date['debut'])){
            $date = array(
                'debut' => date('Y/m/d', strtotime('-7 days')), 
                'fin' => date('Y/m/d')
            );
            

        }
        

        
                $date = array(
                    'debut' => date('Y/m/d', strtotime($date['debut'])), 
                    'fin' => date('Y/m/d', strtotime($date['fin']))
                    //'debut' => '2013/12/01'
                );
        
        $reqJoin = 'SELECT lc.prixHt , lc.tva, c.id '
                .'FROM GestionArticlesBundle:LignesCommande lc '
                .'LEFT JOIN GestionArticlesBundle:Commandes c '
                . 'WITH lc.commande = c.id '
                .'LEFT JOIN GestionClientsBundle:Clients cl '
                .'WITH c.client = cl.id '
                .'inner JOIN GestionClientsBundle:User us '
                .'WITH lc.salarie = us.id '
                .'WHERE c.dateCmd > \''.$date['debut'].'\' '
                . 'and c.dateCmd < \''.$date['fin'].'\'   '
                .'and us.id = :idUser '
                . 'and c.solde = 1 '
                
                ;
            
            $listeLG  = $this->getEntityManager()
                        ->createQuery($reqJoin)
                        ->setParameter('idUser', $user)
                        ->getResult();
            
            
            
        return $listeLG;
    }
    public function getCaMoyenPayement($date) {
  
        /**
         * SELECT *, sum(p.montant) as total 
         * FROM `LignesCommande` 
         * left join Paiements p 
         *      on p.commande_id = LignesCommande.commande_id 
         * inner join MoyensPaiement 
         *      on MoyensPaiement.id = p.moyenPaiement_id 
         * group by MoyensPaiement.nom
         * where date > '2015-01-01'
         * and where date < '2016-01-01'
         */
        if(!isset($date['debut']) | empty($date['debut'])){
            $date = array(
                'debut' => date('Y/m/d', strtotime('-7 days')), 
                'fin' => date('Y/m/d')
            );
            

        }
        

        
                $date = array(
                    'debut' => date('Y/m/d', strtotime($date['debut'])), 
                    'fin' => date('Y/m/d', strtotime($date['fin']))
                    //'debut' => '2013/12/01'
                );
        
        
        $reqJoin = 'SELECT sum(p.montant) as montant , mp.nom '
                .'FROM GestionArticlesBundle:LignesCommande lc '
                .'LEFT JOIN GestionArticlesBundle:Paiements p '
                . 'WITH p.commande = lc.commande '
                .'inner JOIN GestionArticlesBundle:MoyensPaiement mp '
                . 'WITH mp.id = p.moyenPaiement '
                . 'WHERE p.datePaiement > \''.$date['debut'].'\' '
                . 'and p.datePaiement < \''.$date['fin'].'\'   '
                . 'GROUP BY mp.nom '
                ;
            
            $listeLG  = $this->getEntityManager()
                        ->createQuery($reqJoin)
                      //  ->setParameter('debut', $date['debut'])
                        ->getResult();
            
            
            
        return $listeLG;
    }
    
      public function getCmdPeriode( $date) {
  
        
                if(!isset($date['debut']) | empty($date['debut'])){
            $date = array(
                'debut' => date('Y/m/d', strtotime('-7 days')), 
                'fin' => date('Y/m/d')
            );
            

        }
        

        
                $date = array(
                    'debut' => date('Y/m/d', strtotime($date['debut'])), 
                    'fin' => date('Y/m/d', strtotime($date['fin']))
                    //'debut' => '2013/12/01'
                );
        
        $reqJoin = 'SELECT c '
                .'FROM GestionArticlesBundle:Commandes c '
                .'WHERE c.dateCmd > \''.$date['debut'].'\'   '
                .'and c.dateCmd < \''.$date['fin'].'\'   '
                ;
            
            $listeLG  = $this->getEntityManager()
                        ->createQuery($reqJoin)
                       
                        ->getResult();
            
            
            
        return $listeLG;
    }
    
    
}
