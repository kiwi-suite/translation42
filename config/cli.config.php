<?php
return [
    'cli' => [
        'translation-export' => [
            'route'                => 'translation-export --textdomain= --format= ',
            'command-name'         => 'Translation42\Translation\Export',
            'description'          => 'Export translation messages by text-domain to different formats. Additionally by locale (optional). Output will be printed to CLI (use output redirect to file)',
            'short_description'    => 'Export translation messages',
            'options_descriptions' => [
                '--textdomain' => 'Text domain of messages to be exported',
                '--format'     => 'Format for messages (json, phparray)',
            ]
        ],
    ],
];
