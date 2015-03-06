<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\I18n\Translator;

use Zend\Db\Adapter\Adapter;
use Zend\I18n\Translator\Loader\RemoteLoaderInterface;
use Zend\I18n\Translator\TextDomain;

class DatabaseTranslationLoader implements RemoteLoaderInterface
{
    protected $db;

    public function __construct(Adapter $db)
    {
        $this->db = $db;
    }

    public function load($locale, $textDomain)
    {
        // $data = $this->db->loadFromLocale($locale);

        // process $data into $messages
        // $messages array with key translation key

        $messages = array(
            'test' => 'Test',
        );

        $domain = new TextDomain($messages);
        return $domain;
    }
}