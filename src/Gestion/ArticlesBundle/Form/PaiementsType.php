<?php

namespace Gestion\ArticlesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Gestion\ArticlesBundle\Entity\Paiements;
use Doctrine\ORM\EntityRepository ;
use Symfony\Component\Form\FormInterface;

class PaiementsType extends AbstractType
{
    
    protected $commande;
    protected $salarie;
            
    
    function __construct($commande ) {
        $this->commande = $commande;
        
    }

        
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $pr = $this->commande;
        // $montant, Commandes , MoyensPaiement  , Salaries 
        $builder
            ->add('montant', 'text', array('required'=> true))
            ->add('commande', 'entity', 
                   array(
                       'class'=>'GestionArticlesBundle:Commandes',
                       'property'=>'id',
                      'read_only'=> true,
                       'query_builder' => function(EntityRepository $er) use($pr) {
                              return $er->createQueryBuilder('u')
                                        ->where('u.id = :id')
                                        ->setParameter('id', $pr)
                                ;
                        },
                        
                        )
                   )
            ->add('moyenPaiement', 'entity', 
                   array(
                       'class'=>'GestionArticlesBundle:MoyensPaiement',
                       'property'=>'nom',
                       'expanded'=> FALSE, 
                       'multiple'=> FALSE
                        )
                   )
//            ->add('salarie', 'entity', 
//                    array(
//                        'class'=>'GestionClientsBundle:User',
//                        'property' => 'nom'
//                        
//                        )
//                    )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\ArticlesBundle\Entity\Paiements',
            'empty_data' => function (FormInterface $form) {
                //  $montant, Commandes , MoyensPaiement  , Salaries         
                return new Paiements(
                        $form->get('montant')->getData(),
                        $form->get('commande')->getData(),
                        $form->get('moyenPaiement')->getData()
                        //$this->getUser()
                        //$form->get('salarie')->getData()
                );
            }
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_articlesbundle_paiements';
    }
}
