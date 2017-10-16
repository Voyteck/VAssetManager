<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Vassetmanager\Controller\Index' => 'Vassetmanager\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(

            'asset' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/asset/:action/[:moduleName][/:controllerName][/:assetName]',
                    'defaults' => array(
                        'controller'    => \Vassetmanager\Controller\IndexController::class,
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'asset_type'         => '[js|css|img]',
                        'moduleName'        => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'controllerName'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'actionName'        => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'assetName'         => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                ),
                'may_terminate' => true,
            ),

        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Vassetmanager' => __DIR__ . '/../view',
        ),
    ),

    'asset_manager' => array(
        'asset_types' => array(
            'js'    => '.js',
            'css'   => '.css',
            'img'   => array('.png', '.jpg', '.jpeg'),
        )
    ),
);
