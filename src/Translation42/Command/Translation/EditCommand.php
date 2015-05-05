<?php
/**
 * admin42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2014 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\Command\Translation;

use Core42\Command\AbstractCommand;
use Translation42\Model\Translation;

class EditCommand extends AbstractCommand
{
    /**
     * @var string
     */
    private $textDomain;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $translation;

    /**
     * @var string
     */
    private $status;

    /**
     * @param string $textDomain
     */
    public function setTextDomain($textDomain)
    {
        $this->textDomain = $textDomain;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param string $translation
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param array $values
     */
    public function hydrate(array $values)
    {
        $this->setTextDomain(array_key_exists('text_domain', $values) ? $values['text_domain'] : null);
        $this->setLocale(array_key_exists('locale', $values) ? $values['locale'] : null);
        $this->setMessage(array_key_exists('message', $values) ? $values['message'] : null);
        $this->setTranslation(array_key_exists('translation', $values) ? $values['translation'] : null);
        $this->setStatus(array_key_exists('status', $values) ? $values['status'] : null);
    }

    /**
     *
     */
    protected function preExecute()
    {
    }

    /**
     * @return Translation
     */
    protected function execute()
    {
    }
}
