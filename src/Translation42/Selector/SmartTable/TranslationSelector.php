<?php
namespace Translation42\Selector\SmartTable;

use Admin42\Selector\SmartTable\AbstractSmartTableSelector;
use Core42\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;

class TranslationSelector extends AbstractSmartTableSelector
{
    /**
     * @return Select|string|ResultSet
     */
    protected function getSelect()
    {
        $gateway = $this->getTableGateway('Translation42\Translation');

        $select = $gateway->getSql()->select();

        $where = $this->getWhere();
        if (!empty($where)) {
            $select->where($where);
        }

        $order = $this->getOrder();
        if (!empty($order)) {
            $select->order($order);
        }

        return $select;
    }

    /**
     * @return array
     */
    protected function getDatabaseTypeMap()
    {
        return [
            'id' => 'Mysql/Integer',
            'updated' => 'Mysql/Datetime',
            'created' => 'Mysql/Datetime',
        ];
    }

    /**
     * @return array
     */
    protected function getSearchAbleColumns()
    {
        return ['message', 'translation', 'locale', 'textDomain', 'status'];
    }

    /**
     * @return array
     */
    protected function getSortAbleColumns()
    {
        return ['message', 'translation', 'locale', 'textDomain', 'status'];
    }

    /**
     * @return array
     */
    protected function getDisplayColumns()
    {
        return ['message', 'translation', 'locale', 'textDomain', 'status', 'updated', 'created'];
    }
}
