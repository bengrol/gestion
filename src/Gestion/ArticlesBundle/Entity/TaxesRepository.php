<?php

namespace Gestion\ArticlesBundle\Entity;

use Doctrine\ORM\EntityRepository;


class TaxesRepository extends EntityRepository
{
    
    public function getAllValideTx() {
        
     return   $this->getEntityManager()
            ->createQuery('Select t FROM Gestion\ArticlesBundle\Entity\Taxes t WHERE t.default = 0')
             ->getResult();
        
        
    }

    public function resetDefault() {// no used
        
     return   $this->getEntityManager()
            ->createQuery('UPDATE Gestion\ArticlesBundle\Entity\Taxes t SET t.default = 0')
             ->getResult();
     }
    
    
    public function setDefaultTaxe($taxe) {// no used
        
        $this->resetDefault();
        
     return    $this->getEntityManager()
            ->createQuery('UPDATE Gestion\ArticlesBundle\Entity\Taxes t SET t.default = 1 WHERE t.id = :id')
                ->setParameter('id', $taxe->getId())
             ->getResult();
        
     
     
    }
    
    
    
    
    
}
