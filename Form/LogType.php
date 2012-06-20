<?php

namespace Coregen\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class LogType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('created_at')
            ->add('type')
            ->add('message')
            ->add('user')
        ;
    }

    public function getName()
    {
        return 'coregen_adminbundle_logtype';
    }
}
