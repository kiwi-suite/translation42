<?php
namespace Translation42;

use Translation42\Listener\Service\TranslationMissingListenerFactory;
use Translation42\Listener\TranslationMissingListener;

return [
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
