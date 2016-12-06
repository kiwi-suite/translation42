<?php

/*
 * translation42
 *
 * @package translation42
 * @link https://github.com/raum42/translation42
 * @copyright Copyright (c) 2010 - 2016 raum42 (https://www.raum42.at)
 * @license MIT License
 * @author raum42 <kiwi@raum42.at>
 */

namespace Translation42\I18n\Translator;

use Core42\Db\TableGateway\AbstractTableGateway;
use Translation42\Model\Translation;
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
            $message = $translation->getTranslation();
            if (empty($message)) {
                $message = $translation->getMessage();
            }
            $messages[$translation->getMessage()] = $message;
        }
        $domain = new TextDomain($messages);

        return $domain;
    }
}
