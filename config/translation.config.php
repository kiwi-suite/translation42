<?php
namespace Translation42;

return [
    'translator' => [
        'translation_file_patterns' => [
            [
                'type'        => 'phparray',
                'base_dir'    => __DIR__ . '/../data/language/',
                'pattern'     => '%s.php',
                'text_domain' => 'admin',
            ],
        ],
        'remote_translation' => [
            [
                'type'        => 'database',
                'text_domain' => 'frontend',
            ],
            [
                'type'        => 'database',
                'text_domain' => 'mobile',
            ],
        ],
        'event_manager_enabled' => true,
        'missing_translations_handler' => [
            'service' => 'Translation42/TranslationMissingListener',
            'action' => 'autoGenerateMissingTranslation',
        ],
    ],
    'translation_manager' => [
        'factories' => [
            'database' => 'Translation42\I18n\Translator\Service\DatabaseTranslationLoaderFactory',
        ]
    ],
];
