<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2015 raum42 OG (http://www.raum42.at)
 *
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
    protected $databaseTypeMap = [];

    /**
     * @var string
     */
    protected $modelPrototype = 'Translation42\\Model\\Translation';
}
