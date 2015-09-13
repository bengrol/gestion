<?php

namespace Gestion\ArticlesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Gestion\ArticlesBundle\Classes\CommandeToId ;

class LignesCommandeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        
        $builder
            ->add('article', 'entity', 
                   array(
                       'class'=>'GestionArticlesBundle:Articles',
                       'property'=>'nom',
                        )
                   )
           // ->add('detail')
        
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\ArticlesBundle\Entity\LignesCommande'
        ));
        
        
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_articlesbundle_lignescommande';
    }
}
