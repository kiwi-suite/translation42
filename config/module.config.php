<?php
namespace Translation42;

use Translation42\Listener\Service\TranslationMissingListenerFactory;
use Translation42\Listener\TranslationMissingListener;

return [
    'view_manager'    => [
        'template_path_stack' => [
            __NAMESPACE__ => __DIR__ . '/../view',
        ],
    ],

    'service_manager' => [
        'factories' => [
            TranslationMissingListener::class => TranslationMissingListenerFactory::class
        ],
    ],

    'migration'       => [
        'directory' => [
            __NAMESPACE__ => __DIR__ . '/../data/migrations'
        ],
    ],
];
