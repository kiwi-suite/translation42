<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\I18n\Translator;

use Core42\Db\TableGateway\AbstractTableGateway;
use Exception;
use Translation42\Command\Translation\CreateCommand;
use Translation42\Model\Translation;
use Zend\Di\ServiceLocator;
use Zend\EventManager\Event;
use Zend\I18n\Translator\Loader\RemoteLoaderInterface;
use Zend\I18n\Translator\TextDomain;

class DatabaseTranslationLoader implements RemoteLoaderInterface
{
    /**
     * @var AbstractTableGateway
     */
    protected $tableGateway;

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

    /**
     * @param Event $event
     */
    public function handleMissingTranslation($event)
    {
        // handle missing translations (remote text domains in databases only)

        /** @var ServiceLocator $serviceLocator */
        $serviceLocator = $event->getTarget()->getPluginManager()->getServiceLocator();

        $config = $serviceLocator->get('Config');

        $eventParams = $event->getParams();
        $isRemoteTextDomain = false;

        // only handle translations that are in remote translation text domains
        foreach ($config['translator']['remote_translation'] as $remoteTextDomain) {
            if ($remoteTextDomain['type'] == 'database' && $remoteTextDomain['text_domain'] == $eventParams['text_domain']) {
                $isRemoteTextDomain = true;
            }
        }

        // call create translation command all available locales with key and status 'auto' (was generated through request)
        if ($isRemoteTextDomain) {
            try {
                /** @var CreateCommand $cmd */
                $cmd = $serviceLocator->get('Command')->get('Translation42\Translation\Create');
                $cmd->setTextDomain($eventParams['text_domain']);
                $cmd->setLocale($eventParams['locale']);
                $cmd->setMessage($eventParams['message']);
                $cmd->setStatus(Translation::STATUS_AUTO);
                $cmd->run();
            } catch (Exception $e) {
                // ok
                // translation with same message, local and textDomain was already inserted but translation is still empty
            }
        }
    }
}