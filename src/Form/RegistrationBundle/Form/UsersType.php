<?php

namespace Form\RegistrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null,['label' => 'Your Name', 'attr'=>['class' => 'form-control']])
            ->add('email', null,['label' => 'Your email', 'attr'=>['class' => 'form-control']])
            ->add('password', 'repeated', [
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => array('class' => 'password-field')],
                'required' => true,
                'first_options'  => ['label' => 'Password', 'attr'=>['class' => 'form-control']],
                'second_options' => ['label' => 'Repeat Password','attr'=>['class' => 'form-control']],
            ])
            ->add('roles', new RolesType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Form\RegistrationBundle\Entity\Users',
            'cascade_validation' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'form_registrationbundle_users';
    }
}
