<?php
namespace Translation42\Selector\SmartTable;

use Admin42\Selector\SmartTable\AbstractSmartTableSelector;

class TranslationSelector extends AbstractSmartTableSelector
{
    protected $tableGateway = 'Translation42\Translation';

    /**
     * @var null|array
     */
    protected $columns = ['message', 'translation', 'locale', 'textDomain', 'status', 'updated', 'created'];

    /**
     * @var null|array
     */
    protected $searchAbleColumns = ['message', 'translation', 'locale', 'textDomain', 'status'];

    /**
     * @var array
     */
    protected $sortAbleColumns = ['message', 'translation', 'locale', 'textDomain', 'status'];
}
