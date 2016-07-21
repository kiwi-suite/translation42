<?php
namespace Translation42;

use Translation42\Listener\TranslationMissingListener;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'view_manager'    => [
        'template_path_stack' => [
            __NAMESPACE__ => __DIR__ . '/../view',
        ],
    ],

    'service_manager' => [
        'factories' => [
            TranslationMissingListener::class => InvokableFactory::class
        ],
    ],

    'migration'       => [
        'directory' => [
            __NAMESPACE__ => __DIR__ . '/../data/migrations'
        ],
    ],
];
