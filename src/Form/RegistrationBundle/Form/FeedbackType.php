<?php

namespace Form\RegistrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FeedbackType extends AbstractType
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
            ->add('comment', 'textarea', ['label' => 'form_comment', 'attr' =>['class' => 'form-control', 'raw' => 5]])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Form\RegistrationBundle\Entity\Feedback'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'form_registrationbundle_feedback';
    }
}
