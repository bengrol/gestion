<?php

namespace Gestion\ArticlesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommandesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $entityManager = $options['em'];
        
        
        
        
        $builder
            ->add('client', 'entity', 
                   array(
                       'class'=>'GestionClientsBundle:Clients',
                       'property'=>'nom',
                        )
                   )
            ->add('salarie', 'entity', 
                   array(
                       'class'=>'GestionClientsBundle:User',
                       'property'=>'nom',
                        )
                   )
            ->add('lignesCommandes', 'collection', 
                    array(
                        'type' => new LignesCommandeType(),
                        'allow_add' => true,
                        'by_reference' => false,
                         'allow_delete' => true,
                        )
                )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\ArticlesBundle\Entity\Commandes'
        ));
        
                $resolver->setRequired(array(
            'em',
        ));

        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
        
        
        
        
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_articlesbundle_commandes';
    }
}
