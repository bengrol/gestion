<?php

namespace Gestion\ArticlesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Gestion\ArticlesBundle\Entity\Taxes ;

use Symfony\Component\Form\FormInterface;

class TaxesType extends AbstractType
{
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text')
            ->add('id', 'hidden', array('mapped'=>false))
            ->add('taux', 'number');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\ArticlesBundle\Entity\Taxes',
            'empty_data' => function (FormInterface $form) {
                //$nom           
                 $taxe = new Taxes($form->get('nom')->getData(),$form->get('taux')->getData());
                 $taxe->setDefault(false);
                 
                 return $taxe;
            }
            
            
            
            ));

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_articlesbundle_taxes';
    }
}
