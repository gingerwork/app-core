<?php
/*
 * This file is part of the Ginger Workflow Framework.
 * (c) Alexander Miertsch <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 06.12.14 - 22:26
 */
return array(
    'dashboard' => [
        'system_config_widget' => [
            'controller' => 'SystemConfig\Controller\DashboardWidget',
            'order' => 101 //100 - 200 config order range
        ]
    ],
    'router' => [
        'routes' => [
            'system_config' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/system-config',
                    'defaults' => array(
                        'controller' => 'SystemConfig\Controller\Overview',
                        'action'     => 'show',
                    ),
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'ginger_set_up' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/ginger-set-up',
                            'defaults' => [
                                'controller' => 'SystemConfig\Controller\GingerSetUp',
                                'action' => 'run'
                            ]
                        ],
                    ],
                    'change_node_name' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/change-node-name',
                            'defaults' => [
                                'controller' => 'SystemConfig\Controller\Configuration',
                                'action' => 'change-node-name'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'service_manager' => [
        'factories' => [

            //Projections
            'ginger_config_projection' => 'SystemConfig\Projection\Factory\GingerConfigFactory',

            //Command handlers
            'SystemConfig\Model\GingerConfig\CreateDefaultConfigFileHandler' => 'SystemConfig\Service\Factory\CreateDefaultConfigFileHandlerFactory',
            'SystemConfig\Model\GingerConfig\InitializeEventStoreHandler'    => 'SystemConfig\Service\Factory\InitializeEventStoreHandlerFactory',
            'SystemConfig\Model\GingerConfig\ChangeNodeNameHandler'          => 'SystemConfig\Service\Factory\ChangeNodeNameHandlerFactory',
            'SystemConfig\Model\GingerConfig\AddNewProcessToConfigHandler'   => 'SystemConfig\Service\Factory\AddNewProcessToConfigHandlerFactory',
            'SystemConfig\Model\GingerConfig\ChangeProcessConfigHandler'     => 'SystemConfig\Service\Factory\ChangeProcessConfigHandlerFactory',
            'SystemConfig\Model\GingerConfig\UndoSystemSetUpHandler'         => 'SystemConfig\Service\Factory\UndoSystemSetUpHandlerFactory',

        ]
    ],
    'controllers' => array(
        'invokables' => array(
            'SystemConfig\Controller\GingerSetUp'       => 'SystemConfig\Controller\GingerSetUpController',
            'SystemConfig\Controller\Configuration'     => 'SystemConfig\Controller\ConfigurationController',
            'SystemConfig\Controller\DashboardWidget'   => 'SystemConfig\Controller\DashboardWidgetController',
            'SystemConfig\Controller\Overview'          => 'SystemConfig\Controller\OverviewController',
        ),
    ),
    'prooph.psb' => [
        'command_router_map' => [
            'SystemConfig\Command\CreateDefaultGingerConfigFile' => 'SystemConfig\Model\GingerConfig\CreateDefaultConfigFileHandler',
            'SystemConfig\Command\InitializeEventStore'          => 'SystemConfig\Model\GingerConfig\InitializeEventStoreHandler',
            'SystemConfig\Command\ChangeNodeName'                => 'SystemConfig\Model\GingerConfig\ChangeNodeNameHandler',
            'SystemConfig\Command\AddNewProcessToConfig'         => 'SystemConfig\Model\GingerConfig\AddNewProcessToConfigHandler',
            'SystemConfig\Command\ChangeProcessConfig'           => 'SystemConfig\Model\GingerConfig\ChangeProcessConfigHandler',
            'SystemConfig\Command\UndoSystemSetUp'               => 'SystemConfig\Model\GingerConfig\UndoSystemSetUpHandler',
        ]
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'SystemConfig\Controller\Configuration' => 'Json',
        ],
        'accept_whitelist' => [
            'SystemConfig\Controller\Configuration' => ['application/json'],
        ],
        'content_type_whitelist' => [
            'SystemConfig\Controller\Configuration' => ['application/json'],
        ],
    ]
);