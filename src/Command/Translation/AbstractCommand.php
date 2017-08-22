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

namespace Translation42\Command\Translation;

use Translation42\TableGateway\TranslationTableGateway;

abstract class AbstractCommand extends \Core42\Command\AbstractCommand
{
    /**
     * @var array|null
     */
    private $translationConfig;

    /**
     * @return array|null
     */
    protected function getTranslationConfig()
    {
        if ($this->translationConfig === null) {
            $config = $this->getServiceManager()->get('config');
            $this->translationConfig = $config['translation'];
        }

        return $this->translationConfig;
    }

    /**
     * @param $textDomain
     * @return array
     */
    protected function getMessages($textDomain)
    {
        /** @var TranslationTableGateway $translationTableGateway */
        $translationTableGateway = $this->getTableGateway(TranslationTableGateway::class);
        $messagesResult = $translationTableGateway->select(['textDomain' => $textDomain]);

        $messages = [];

        foreach ($messagesResult as $message) {
            $locale = $message->getLocale();
            if (!isset($messages[$locale])) {
                $messages[$locale] = [];
            }
            $messages[$locale][$message->getMessage()] = $message->getTranslation();
        }

        return $messages;
    }
}
