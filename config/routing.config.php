<?php
namespace Translation42;

use Core42\Mvc\Router\Http\AngularSegment;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'translation' => [
                        'type'          => Literal::class,
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
                                'type'    => Segment::class,
                                'options' => [
                                    'route'    => 'list/',
                                    'defaults' => [
                                        'action' => 'index',
                                    ],
                                ],
                            ],
                            'export'   => [
                                'type'    => Segment::class,
                                'options' => [
                                    'route'    => 'export/:text-domain',
                                    'defaults' => [
                                        'action' => 'export',
                                    ],
                                ],
                            ],
                            'edit'   => [
                                'type'    => AngularSegment::class,
                                'options' => [
                                    'route'    => 'edit/:id/',
                                    'defaults' => [
                                        'action'     => 'detail',
                                        'isEditMode' => true,
                                    ],
                                ],
                            ],
                            'add'    => [
                                'type'    => Literal::class,
                                'options' => [
                                    'route'    => 'add/',
                                    'defaults' => [
                                        'action'     => 'detail',
                                        'isEditMode' => false,
                                    ],
                                ],
                            ],
                            'delete' => [
                                'type'    => Literal::class,
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
