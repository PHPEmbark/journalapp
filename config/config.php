<?php
return [
    'autoloader' => [
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
];