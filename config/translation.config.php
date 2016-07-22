<?php
namespace Translation42;

use Translation42\FormElements\Service\LocaleFactory;
use Translation42\FormElements\Service\TextDomainFactory;
use Translation42\I18n\Translator\Service\DatabaseTranslationLoaderFactory;
use Translation42\Listener\TranslationMissingListener;

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
            'service' => TranslationMissingListener::class,
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
            'database' => DatabaseTranslationLoaderFactory::class,
        ]
    ],
];
