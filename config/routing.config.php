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
                            'list' => [
                                'type'          => 'Zend\Mvc\Router\Http\Segment',
                                'options'       => [
                                    'route'    => 'list/',
                                    'defaults' => [
                                        'action' => 'index',
                                    ],
                                ],
                            ],
                            'edit'   => [
                                'type'    => 'Zend\Mvc\Router\Http\Segment',
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
