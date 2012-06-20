<?php

namespace Coregen\AdminBundle\Generator;

use Coregen\AdminGeneratorBundle\Generator\Generator;

class Log extends Generator
{
    protected function configure()
    {
        $actions = array();

        $fields  = array(
            'id'         => array('label' => 'ID'),
            'type'       => array('label' => 'Tipo', 'trans' => true),
            'message'    => array('label' => 'Mensagem'),
            'user'       => array('label' => 'Usuário'),
            'created_at' => array('label' => 'Criado em', 'date_format' => 'd/m/Y H:i:s'),
        );

        $list = array(
            'title'           => 'Registro (Log)',
            'query_builder'   => null,
            'display'         => array(
                                'id',
                                'type',
                                'message',
                                'user',
                                'created_at',
                                ),
            # grid or stacked, default grid
            'layout'          => 'grid',
            'stackedTemplate' => '<h3>{{ record.name  }}</h3>' .
                                 '<p class="details_fixed">URI: <strong>{{ record.uri }}</strong></p>',
            'sort'            => array('createdAt' => 'DESC'),
            'max_per_page'    => 30,
            'object_actions'  => array(),
            'batch_actions'   => array(
                'delete' => array(
                    'label'  => 'Excluir',
                    'success_message' => '%s item(ns) foram excluídos com sucesso.'
                ),
            ),

        );

        $form = array(
            'type'   => "Coregen\AdminBundle\Form\LogType",
        );

        $edit = array(
            'title'   => "Editando Log",
            'display'         => array(
                                'type',
                                'message',
                                'user',
                                //'created_at',
                                ),
            'actions' => array(),
        );

        $new = array(
            'title'   => "Novo Log",
            'display'         => array(
                                'type',
                                'message',
                                'user',
                                'created_at',
                                ),
            'actions' => array(),
        );

        $show = array(
            'title'   => "Visualizar Log",
        );

        $filter = array(
            'title'   => "Filter",
            'fields' => array(
                'type' => array(
                    'type'    => 'choice',
                    'compare' => '=', // eq
                    'label'   => 'Type',
                    'options' => array('choices'=>array('CAPTURE'=>'CAPTURE','NEWS_CREATE'=>'NEWS_CREATE'))
                    ),
                'createdAt' => array(
                    'type'    => 'daterange',
                    //'compare' => 'between', // not used in date range
                    'label'   => 'Created At',
                    ),
                )
            );
        $this
            ->setClass('\Coregen\AdminBundle\Entity\Log')
            ->setModel('CoregenAdminBundle:Log')
            ->setCoreTheme('CoregenThemeBootstrapBundle')
            ->setLayoutTheme('CoregenAdminBundle')
            ->setRoute('log')
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
