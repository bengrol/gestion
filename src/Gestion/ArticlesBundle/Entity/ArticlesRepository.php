<?php

namespace Gestion\ArticlesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ArticlesRepository extends EntityRepository
{
    
    function getArticleByTaxe($param) {
        
//      $taxe =   $this->getEntityManager()
//            ->createQuery('Select a FROM Gestion\ArticlesBundle\Entity\Taxes a   WHERE a.id = 1')
//                ->getSingleResult();

      // var_dump($taxe);
        
        
//        
//         $q =   $this->getEntityManager()
//            ->createQueryBuilder('a')
//            ->where('a.nom = :tx')
//            ->setParameter('tx', 'test');
//            
//    
//         
//
//         
//         return $q->getQuery()->getResult();
        
        
        
        $pr =2;
        
          $taxe =  $this->getEntityManager()
            ->createQuery('Select a FROM Gestion\ArticlesBundle\Entity\Taxes a   WHERE a.id = :pr')
                  ->setParameter("pr", $pr)
                ->getResult();
        
          
          var_dump($taxe);
        
        
            $rs = $this->getEntityManager()
            ->createQuery('Select a FROM Gestion\ArticlesBundle\Entity\Articles a JOIN a.taxe t  WHERE a.taxe = :pr')
                  ->setParameter("pr", $taxe)
                ->getResult();
         
         
         return $rs;
    }
    
    
    
    
    
    
}
