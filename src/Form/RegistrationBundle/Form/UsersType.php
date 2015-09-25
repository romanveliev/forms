<?php

namespace Form\RegistrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;

class UsersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null,['label' => 'form_name', 'attr'=>['class' => 'form-control']])
            ->add('email', null,['label' => 'form_email', 'attr'=>['class' => 'form-control']])
            ->add('password', 'repeated', [
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => array('class' => 'password-field')],
                'required' => true,
                'first_options'  => ['label' => 'form_password', 'attr'=>['class' => 'form-control']],
                'second_options' => ['label' => 'form_repeat_password','attr'=>['class' => 'form-control']],
            ])
            ->add('role', 'choice',['choices'=>
                [
                    'ROLE_ADMIN'=>'admin',
                    'ROLE_USER' =>'user',
                ],
                'label' => 'role', 'attr'=>['class' => 'form-control']])
            ->add('recaptcha', 'ewz_recaptcha', array(
                'attr'        => array(
                    'options' => array(
                        'theme' => 'dark',
                        'type'  => 'image'
                    )
                ),
                'mapped'      => false,
                'constraints' => array(
                    new RecaptchaTrue()
                )
            ))

//            ->add('roles', new RolesType())
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
