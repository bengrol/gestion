<?php

namespace Gestion\ArticlesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PaiementsRepository extends EntityRepository
{
    
    public function setPayementCmd($montant, $commande)
    {
        
        
        
        
        $commande =  $this->getEntityManager()
            ->createQuery('Select a FROM Gestion\ArticlesBundle\Entity\Taxes a   WHERE a.id = :param')
                  ->setParameter("param", $pr)
                ->getResult();
        
        
        
        $this->montant = $montant;

        return $this;
    }    
    
}
