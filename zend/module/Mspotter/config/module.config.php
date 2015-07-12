<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'Mspotter\Mapper\AdMapperInterface'   => 'Mspotter\Factory\ZendDbSqlMapperFactory',
            'Mspotter\Service\AdServiceInterface' => 'Mspotter\Factory\AdServiceFactory',
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Mspotter\Controller\List' => 'Mspotter\Factory\ListControllerFactory',
            'Mspotter\Controller\Write' => 'Mspotter\Factory\WriteControllerFactory',
            'Mspotter\Controller\Delete' => 'Mspotter\Factory\DeleteControllerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'Mspotter' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/ads',
                    'defaults' => array(
                        'controller' => 'Mspotter\Controller\List',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'detail' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/:id',
                            'defaults' => array(
                                'action' => 'detail'
                            ),
                            'constraints' => array(
                                'id' => '[1-9]\d*'
                            )
                        )
                    ),
                    'add' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'    => '/add',
                            'defaults' => array(
                                'controller' => 'Mspotter\Controller\Write',
                                'action'     => 'add'
                            )
                        )
                    ),
                    'edit' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/edit/:id',
                            'defaults' => array(
                                'controller' => 'Mspotter\Controller\Write',
                                'action'     => 'edit'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        )
                    ),
                    'delete' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/delete/:id',
                            'defaults' => array(
                                'controller' => 'Mspotter\Controller\Delete',
                                'action'     => 'delete'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        )
                    ),
                )
            )
        )
    )
);