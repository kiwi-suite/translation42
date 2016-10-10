<?php
namespace Translation42;

use Translation42\FormElements\Service\TextDomainFactory;
use Translation42\FormElements\Service\TranslationLocaleFactory;

return [
    'form_elements' => [
        'factories' => [
            'translationLocale' => TranslationLocaleFactory::class,
            'textDomain'        => TextDomainFactory::class,
        ],
    ],
];
