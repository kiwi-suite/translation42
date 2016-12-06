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

namespace Translation42\Listener;

use Exception;
use Translation42\Command\Translation\CreateCommand;
use Translation42\Model\Translation;
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
