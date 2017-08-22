<?php

/*
 * translation42
 *
 * @package translation42
 * @link https://github.com/kiwi-suite/translation42
 * @copyright Copyright (c) 2010 - 2017 kiwi suite (https://www.kiwi-suite.com)
 * @license MIT License
 * @author kiwi suite <dev@kiwi-suite.com>
 */

namespace Translation42\TableGateway;

use Core42\Db\TableGateway\AbstractTableGateway;

class TranslationTableGateway extends AbstractTableGateway
{
    /**
     * @var string
     */
    protected $table = 'translation42_translation';

    /**
     * @var array
     */
    protected $primaryKey = ['id'];

    /**
     * @var array
     */
    protected $databaseTypeMap = [
        'id' => 'integer',
        'textDomain' => 'string',
        'locale' => 'string',
        'message' => 'string',
        'translation' => 'string',
        'status' => 'string',
        'updated' => 'dateTime',
        'created' => 'dateTime',
    ];

    /**
     * @var string
     */
    protected $modelPrototype = 'Translation42\\Model\\Translation';
}
