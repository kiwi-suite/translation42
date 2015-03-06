<?php
namespace Translation42;

return array(
    'translator' => array(
        'remote_translation'  => array(
            array(
                'type' => 'database',
                'text_domain' => 'frontend',
            ),
        ),
    ),
    'translation_manager' => array(
        'factories' => array(
            'database' => 'Translation42\I18n\Translator\Service\DatabaseTranslationLoaderFactory',
        )
    ),
);
