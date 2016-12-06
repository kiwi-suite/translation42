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
        'remote_translation'           => [],
        'event_manager_enabled'        => true,
        'missing_translations_handler' => [
            'service' => TranslationMissingListener::class,
            'action'  => 'autoGenerateMissingTranslation',
        ],
    ],
    'translator_plugins' => [
        'factories' => [
            'database' => DatabaseTranslationLoaderFactory::class,
        ]
    ],
];
