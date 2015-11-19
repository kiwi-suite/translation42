<?php

return [
    'navigation' => [
        'containers' => [
            'admin42' => [
                'setting' => [
                    'pages' => [
                        'translation' => [
                            'options' => [
                                'label' => 'label.translation',
                                'route' => 'admin/translation',
                                'icon'  => 'fa fa-globe fa-fw',
                                'order' => 9000,
                                'permission' => 'route/admin/translation'
                            ],
                        ],
                    ],
                ]
            ],
        ],
    ],
];
