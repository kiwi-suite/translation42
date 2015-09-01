<?php
namespace Translation42;

return [
    'translator'          => [
        'translation_file_patterns'    => [
            [
                'type'        => 'phparray',
                'base_dir'    => __DIR__ . '/../data/language/',
                'pattern'     => '%s.php',
                'text_domain' => 'admin',
            ],
        ],
        'remote_translation'           => [
            /**
             * add database remote translation text domains as follows:
             */
            //[
            //    'type'         => 'database',
            //    'text_domain'  => 'frontend',
            //    'display_name' => 'Frontend',
            //],
            //[
            //    'type'         => 'database',
            //    'text_domain'  => 'mobile',
            //    'display_name' => 'Mobile',
            //],
        ],
        'event_manager_enabled'        => true,
        'missing_translations_handler' => [
            'service' => 'Translation42/TranslationMissingListener',
            'action'  => 'autoGenerateMissingTranslation',
        ],

        'cache' => [
            'adapter' => [
                'name' => 'memory',
            ],
            'plugins' => [
                'Serializer'
            ],
        ],
    ],
    'translation_manager' => [
        'factories' => [
            'database' => 'Translation42\I18n\Translator\Service\DatabaseTranslationLoaderFactory',
        ]
    ],
    'form_elements'       => [
        'factories' => [
            'locale'      => 'Translation42\FormElements\Service\LocaleFactory',
            'text_domain' => 'Translation42\FormElements\Service\TextDomainFactory',
        ],
    ],
];
