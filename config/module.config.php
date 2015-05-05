<?php
namespace Translation42;

return [
    'view_manager' => [
        'template_path_stack' => [
            __NAMESPACE__ => __DIR__ . '/../view',
        ],
    ],

    'service_manager' => [
        'factories' => [
            'translator' => 'Translation42\I18n\Translator\Service\DatabaseTranslationLoaderFactory',
        ],
    ],

    'migration' => [
        'directory' => [
            __NAMESPACE__ => __DIR__ . '/../data/migrations'
        ],
    ],
];
