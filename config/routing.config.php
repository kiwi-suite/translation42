<?php
namespace Translation42;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'translation' => [
                        'type'          => 'Zend\Mvc\Router\Http\Literal',
                        'options'       => [
                            'route'    => 'translation/',
                            'defaults' => [
                                'action'     => 'dashboard',
                                'controller' => __NAMESPACE__ . '\Translation',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes'  => [
                            'list'   => [
                                'type'    => 'Zend\Mvc\Router\Http\Segment',
                                'options' => [
                                    'route'    => 'list/',
                                    'defaults' => [
                                        'action' => 'index',
                                    ],
                                ],
                            ],
                            'export'   => [
                                'type'    => 'Zend\Mvc\Router\Http\Segment',
                                'options' => [
                                    'route'    => 'export/',
                                    'defaults' => [
                                        'action' => 'export',
                                    ],
                                ],
                            ],
                            'edit'   => [
                                'type'    => 'Core42\Mvc\Router\Http\AngularSegment',
                                'options' => [
                                    'route'    => 'edit/:id/',
                                    'defaults' => [
                                        'action'     => 'detail',
                                        'isEditMode' => true,
                                    ],
                                ],
                            ],
                            'add'    => [
                                'type'    => 'Zend\Mvc\Router\Http\Literal',
                                'options' => [
                                    'route'    => 'add/',
                                    'defaults' => [
                                        'action'     => 'detail',
                                        'isEditMode' => false,
                                    ],
                                ],
                            ],
                            'delete' => [
                                'type'    => 'Zend\Mvc\Router\Http\Literal',
                                'options' => [
                                    'route'    => 'delete/',
                                    'defaults' => [
                                        'action' => 'delete',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
