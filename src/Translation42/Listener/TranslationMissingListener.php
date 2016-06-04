<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\Listener;

use Core42\I18n\Localization\Localization;
use Exception;
use Translation42\Command\Translation\CreateCommand;
use Translation42\Model\Translation;
use Zend\Di\ServiceLocator;
use Zend\EventManager\Event;

class TranslationMissingListener
{
    /**
     * @param Event $event
     */
    public function autoGenerateMissingTranslation($event)
    {
        // handle missing translations (remote text domains in databases only)

        /** @var ServiceLocator $serviceLocator */
        $serviceLocator = $event->getTarget()->getPluginManager()->getServiceLocator();


        $config = $serviceLocator->get('Config');

        $eventParams = $event->getParams();
        $isRemoteTextDomain = false;

        // only handle translations that are in remote translation text domains
        foreach ($config['translator']['remote_translation'] as $remoteTextDomain) {
            if ($remoteTextDomain['type'] == 'database'
                && $remoteTextDomain['text_domain'] == $eventParams['text_domain']
            ) {
                $isRemoteTextDomain = true;
            }
        }

        // call create translation command all available locales with key and status 'auto'
        // (was generated through request)
        if ($isRemoteTextDomain) {
            try {
                /** @var CreateCommand $cmd */
                $cmd = $serviceLocator->get('Command')->get(CreateCommand::class);
                $cmd->setTextDomain($eventParams['text_domain']);
                $cmd->setLocale($eventParams['locale']);
                $cmd->setMessage($eventParams['message']);
                $cmd->setStatus(Translation::STATUS_AUTO);
                $cmd->run();
            } catch (Exception $e) {

            }
        }
    }
}
