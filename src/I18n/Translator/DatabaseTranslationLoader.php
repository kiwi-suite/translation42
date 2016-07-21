<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\I18n\Translator;

use Core42\Db\TableGateway\AbstractTableGateway;
use Translation42\Model\Translation;
use Zend\Di\ServiceLocator;
use Zend\I18n\Translator\Loader\RemoteLoaderInterface;
use Zend\I18n\Translator\TextDomain;

class DatabaseTranslationLoader implements RemoteLoaderInterface
{
    /**
     * @var AbstractTableGateway
     */
    protected $tableGateway;

    /**
     * @param AbstractTableGateway $tableGateway
     */
    public function __construct(AbstractTableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @param string $locale
     * @param string $textDomain
     * @return \Zend\I18n\Translator\TextDomain|null
     */
    public function load($locale, $textDomain)
    {
        $resultSet = $this->tableGateway->select(['locale' => $locale, 'textDomain' => $textDomain]);
        $messages = [];
        /** @var Translation $translation */
        foreach ($resultSet as $translation) {
            $messages[$translation->getMessage()] = $translation->getTranslation();
        }
        $domain = new TextDomain($messages);
        return $domain;
    }
}
