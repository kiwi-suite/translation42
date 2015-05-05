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
                            'text-domain' => [
                                'type'          => 'Zend\Mvc\Router\Http\Segment',
                                'options'       => [
                                    'route'    => ':text-domain/',
                                    'defaults' => [
                                        'action' => 'index',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes'  => [

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
        ],
    ],
];
