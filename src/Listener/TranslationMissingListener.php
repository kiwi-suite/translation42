<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\Listener;

use Exception;
use Translation42\Command\Translation\CreateCommand;
use Translation42\Model\Translation;
use Zend\Di\ServiceLocator;
use Zend\EventManager\Event;

class TranslationMissingListener
{
    /**
     * @var CreateCommand
     */
    protected $createCommand;

    /**
     * @var array
     */
    protected $config;

    public function __construct(CreateCommand $createCommand, array $config)
    {
        $this->createCommand = $createCommand;

        $this->config = $config;
    }

    /**
     * @param Event $event
     */
    public function autoGenerateMissingTranslation($event)
    {
        $eventParams = $event->getParams();
        $isRemoteTextDomain = false;

        // only handle translations that are in remote translation text domains
        foreach ($this->config as $remoteTextDomain) {
            if ($remoteTextDomain['type'] == 'database'
                && $remoteTextDomain['text_domain'] == $eventParams['text_domain']
            ) {
                $isRemoteTextDomain = true;

                break;
            }
        }

        // call create translation command all available locales with key and status 'auto'
        // (was generated through request)
        if ($isRemoteTextDomain) {
            try {
                /** @var CreateCommand $cmd */
                $cmd = clone $this->createCommand;
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
