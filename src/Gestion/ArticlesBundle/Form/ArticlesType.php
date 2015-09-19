<?php

namespace Gestion\ArticlesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Gestion\ArticlesBundle\Entity\Articles ;

use Symfony\Component\Form\FormInterface;

class ArticlesType extends AbstractType
{
    
   
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
        
    
        
        $builder
            ->add('nom')
            ->add('designation')
            ->add('prixHt')
            ->add('technique', 'choice', array(
                 'choices'   => array(true => 'Oui', false => 'Non'),
                'label'  => 'Produit technique ?',
                'data' => false
            ))
            ->add('public', 'choice', array(
                 'choices'   => array(true => 'Oui', false => 'Non'),
                'label'  => 'Produit affiché sur page web ?',
                'data' => true
            ))
            ->add('editable', 'choice', array(
                 'choices'   => array(true => 'Oui', false => 'Non'),
                'label'  => 'Produit éditable ?',
                'data' => false
            ))
           ->add('taxe', 'entity', 
                   array(
                       'class'=>'GestionArticlesBundle:Taxes',
                       'property'=>'nom',
                        )
                   )
           ->add('categorie', 'entity', 
                   array(
                       'class'=>'GestionArticlesBundle:Categories',
                       'property'=>'nom',
                        )
                   );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
                array(
                    'data_class' => 'Gestion\ArticlesBundle\Entity\Articles',
                    'empty_data' => function (FormInterface $form) {
                //$nom, $prixHt, $taxe, $categorie            
                return new Articles(
                        $form->get('nom')->getData(),
                        $form->get('prixHt')->getData(),
                        $form->get('taxe')->getData(),
                        $form->get('categorie')->getData()
                );
            }
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_articlesbundle_articles';
    }
}
