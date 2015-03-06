<?php
namespace Translation42;

return array(
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Translation42\I18n\Translator\Service\TranslatorFactory',
        ),
    ),
    'migration' => array(
        'directory'     => array(
            __NAMESPACE__ => __DIR__ . '/../data/migrations'
        ),
    ),
);
