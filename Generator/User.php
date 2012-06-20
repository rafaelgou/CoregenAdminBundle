<?php

namespace Coregen\AdminBundle\Generator;

use Coregen\AdminGeneratorBundle\Generator\Generator;

class User extends Generator
{
    protected function configure()
    {
        $actions = array();

        $fields  = array(
            'id'                  => array('label' => 'ID'),
            'username'            => array('label' => 'Username'),
            'name'                => array('label' => 'Name'),
            'usernameCanonical'   => array('label' => 'Username Canonical'),
            'email'               => array('label' => 'Email'),
            'enabled'             => array('label' => 'Enabled', 'boolean_format' => array(0=>'NO', 1=>'YES'), 'trans' => true),
            'algorithm'           => array('label' => 'Algorithm'),
            'salt'                => array('label' => 'Salt'),
            'password'            => array('label' => 'Password'),
            'lastLogin'           => array('label' => 'Last Login', 'date_format' => 'd/m/Y H:i:s'),
            'locked'              => array('label' => 'Locked', 'boolean_format' => array(0=>'NO', 1=>'YES'), 'trans' => true),
            'expired'             => array('label' => 'Expired'),
            'expiresAt'           => array('label' => 'Expires At', 'date_format' => 'd/m/Y H:i:s'),
            'confirmationToken'   => array('label' => 'Confirmation Token'),
            'passwordRequestedAt' => array('label' => 'Password Requested At', 'date_format' => 'd/m/Y H:i:s'),
            'roles'               => array('label' => 'Roles'),
            'credentialsExpired'  => array('label' => 'Credential Expired'),
            'credentialsExpireAt' => array('label' => 'Credentail Expired At', 'date_format' => 'd/m/Y H:i:s'),
            'superAdmin'          => array('label' => 'SuperAdmin', 'boolean_format' => array(0=>'NO', 1=>'YES'), 'trans' => true),
        );

        $list = array(
            'title'           => 'Usuários',
            'query_builder'   => null,
            'display'         => array(
                                'id',
                                'username',
                                'name',
                                'email',
                                'superAdmin',
                                'enabled',

                                ),
            # grid or stacked, default grid
            'layout'          => 'grid',
            'stackedTemplate' => '<h3>{{ record.name  }}</h3>' .
                                 '<p class="details_fixed">URI: <strong>{{ record.uri }}</strong></p>',
            'sort'            => array('username' => 'ASC'),
            'max_per_page'    => 10,
            'object_actions'  => array(),
            'batch_actions'   => array(),
        );

        $form = array(
            'type'   => "Coregen\AdminBundle\Form\UserType",
        );

        $edit = array(
            'title'   => "Editando Usuário",
            'display' => array(
                'username',
                'name',
                'email',
                'enabled',
                'password',
                'superAdmin',
                ),
            'actions' => array(),
        );

        $new = array(
            'title'   => "Novo Usuário",
            'display' => array(
                'username',
                'name',
                'email',
                'enabled',
                'password',
                'superAdmin',
                ),
            'actions' => array(
                'save'         => true,
                'save_and_add' => false,
                'back_to_list' => true,
            ),
        );

        $show = array(
            'title'   => "Visualizar Usuário",
            'display' => array(
                'id',
                'username',
                'name',
                'usernameCanonical',
                'email',
                'enabled',
                'lastLogin',
                'locked',
                'expired',
                'roles',
            )
        );

        $filter = array(
            'display' => array(),
            'actions' => array(),
        );
        $this
            ->setClass('\Coregen\AdminBundle\Entity\User')
            ->setModel('CoregenAdminBundle:User')
            ->setCoreTheme('CoregenThemeBootstrapBundle')
            ->setLayoutTheme('CoregenAdminBundle')
            ->setRoute('user')
            ->setActions($actions)
            ->setList($list)
            ->setFields($fields)
            ->setForm($form)
            ->setEdit($edit)
            ->setNew($new)
            ->setShow($show)
            ->setFilter($filter)
            ;

    }
}
