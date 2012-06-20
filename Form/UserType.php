<?php

namespace Coregen\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username')
            //->add('usernameCanonical')
            ->add('email')
            //->add('emailCanonical')
            ->add('enabled',    'choice', array('choices' => array(0=>'No', 1=>'Yes')))
            ->add('superAdmin', 'choice', array('choices' => array(0=>'No', 1=>'Yes')))
            //->add('algorithm')
            //->add('salt')
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'invalid_message' => 'The password fields must match.',
//                'options' => array('label' => 'Password'),
                'first_name'      => 'first',
                'second_name'     => 'second',
                'required'        => false
                )
            )
            //->add('lastLogin')
            //->add('locked')
            //->add('expired')
            //->add('expiresAt')
            //->add('confirmationToken')
            //->add('passwordRequestedAt')
            //->add('roles')
            //->add('credentialsExpired')
            //->add('credentialsExpireAt')
            ->add('name', 'text', array('required'=>false))
        ;
    }

    public function getName()
    {
        return 'coregen_adminbundle_usertype';
    }
}
