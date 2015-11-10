<?php

namespace Rezo\Bundle\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('labelName')
            ->add('route')
            ->add('routeArgs', 'text')
            ->add('children')
            ->add('parent')
            ->add('icon')
            ->add('badge')
            ->add('badgeColor')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rezo\Bundle\AdminBundle\Entity\MenuItem',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rezo_bundle_adminbundle_menuitem';
    }
}
