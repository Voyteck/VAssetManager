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
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/asset/[:action]/[:moduleName][/:controllerName][/:actionName]/[:assetName]',
                    'defaults' => array(
                        'controller'    => \Vassetmanager\Controller\IndexController::class,
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'action'        => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'moduleName'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'assetName'     => '[a-zA-Z][a-zA-Z0-9_-]*',
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
);
