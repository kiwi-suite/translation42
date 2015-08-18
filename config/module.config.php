<?php
namespace Translation42;

return [
    'view_manager'    => [
        'template_path_stack' => [
            __NAMESPACE__ => __DIR__ . '/../view',
        ],
    ],

    'service_manager' => [
        'invokables' => [
            'Translation42/TranslationMissingListener' => 'Translation42\Listener\TranslationMissingListener',
        ],
    ],

    'migration'       => [
        'directory' => [
            __NAMESPACE__ => __DIR__ . '/../data/migrations'
        ],
    ],
];
