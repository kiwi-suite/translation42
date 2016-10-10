<?php
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
