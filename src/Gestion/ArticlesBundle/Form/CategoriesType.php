<?php

namespace Gestion\ArticlesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Gestion\ArticlesBundle\Entity\Categories ;

use Symfony\Component\Form\FormInterface;

class CategoriesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\ArticlesBundle\Entity\Categories',
            'empty_data' => function (FormInterface $form) {
                //$nom           
                return new Categories(
                        $form->get('nom')->getData()
                );
            }
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_articlesbundle_categories';
    }
}
