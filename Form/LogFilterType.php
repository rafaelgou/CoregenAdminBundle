<?php

namespace Coregen\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Doctrine\ORM\EntityRepository;

class LogFilterType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('created_at','date',
                    array(
                        'input'  => 'datetime',
                        'widget' => 'single_text',
                        'required'  => false,
                        'label' => 'Data',
                        'attr' => array('class' => 'date small'),
                     ))
            ->add('type', 'choice',
                    array(
                        'choices'   => array(
                            'LIST' => 'LIST',
                            'LOGIN' => 'LOGIN',
                            'LOGOUT' => 'LOGOUT'
                            ),
                        'required'  => false,
                        'label' => 'Tipo',
                    ))
            ->add('user', 'entity', array(
                        'class' => 'Coregen\AdminBundle\Entity\User',
                        'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('u')
                                            ->orderBy('u.name', 'ASC');
                        },
                        'property' => 'name',
                        'required'  => false,
                        'label' => 'Usuário',
                    ))
            ->add('sort', 'choice',
                    array(
                        'choices'   => array('ASC' => 'ASC', 'DESC' => 'DESC'),
                        'required'  => true,
                        'label' => 'Ordem',
                    ))
        ;
    }

    public function getName()
    {
        return 'filtertype';
    }
}
