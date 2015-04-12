<?php
if(!isset($base_path)) {
    $base_path = dirname(dirname(__DIR__));
}

return [
    'autoloader' => [
        'classes' => [
            $base_path . '/src/Journal/Autoloader.php' => '\Journal\Autoloader',
        ],
        'class_path' => $base_path . '/src',
    ],
    'db' => [
        'db_path' => $base_path . '/data',
        'db_name' => 'journal',
    ],
    'template' => [
        'tpl_path' => $base_path . '/src/Journal/View/tpl',
        'base_tpl' => 'base.html',
    ],
    'router' => [
        'default' => '/entries/list',
        'errors' => '/error',
        'routes' => [
            '/entries(/:action(/:id))' => [
                'controller' => '\Journal\Controller\Entries',
                'action' => 'list',
            ],
            '/users(/:action(/:id))' => [
                    'controller' => '\Journal\Controller\Users',
            ],
            '/:controller(/:action)' => [
                'controller' => '\Journal\Controller\:controller',
                'action' => 'index',
            ],
        ],
    ],
];