<?php

namespace Gestion\ClientsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormInterface;
use Gestion\ClientsBundle\Entity\Clients ;

class ClientsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('portable')
            ->add('pointFidelite')
            ->add('mail')
            ->add('datenaissance',  'date', array(
                            'input'  => 'datetime',
                            'widget' => 'single_text' , 'required'  => false
                ))
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\ClientsBundle\Entity\Clients', 
            'empty_data' => function (FormInterface $form) {
                //$nom
                return new Clients(
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
        return 'gestion_Clientsbundle_Clients';
    }
}
