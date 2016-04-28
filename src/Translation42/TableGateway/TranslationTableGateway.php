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
        'id' => 'Integer',
        'textDomain' => 'String',
        'locale' => 'String',
        'message' => 'String',
        'translation' => 'String',
        'status' => 'String',
        'updated' => 'DateTime',
        'created' => 'DateTime',
    ];

    /**
     * @var boolean
     */
    protected $useMetaDataFeature = false;

    /**
     * @var string
     */
    protected $modelPrototype = 'Translation42\\Model\\Translation';


}
