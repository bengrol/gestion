<?php

namespace Gestion\ArticlesBundle\Classes ;


use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;


class CommandeToId implements DataTransformerInterface{
    
    private $om;
    
    function __construct(ObjectManager $om) {
        $this->om = $om;
    }

    
    public function reverseTransform($value) {
        if (null === $value) {
            return "";
        }
        return $value->getId();
    }

    public function transform($value) {
        //$value = 46;
        $lignCmd = $this->om
            ->getRepository('GestionArticlesBundle:Commandes')
            ->findOneBy(array('id' => $value));
        
        if (null === $lignCmd) {
            throw new TransformationFailedException(sprintf(
                'Le problème avec l\'id "%s" ne peut pas être trouvé!',$value
            ));
        }
        
        return $lignCmd->getId();
    }

    
}
