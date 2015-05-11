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

class CreateCommand extends AbstractCommand
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
        $this->setTextDomain(array_key_exists('textDomain', $values) ? $values['textDomain'] : null);
        $this->setLocale(array_key_exists('locale', $values) ? $values['locale'] : null);
        $this->setMessage(array_key_exists('message', $values) ? $values['message'] : null);
        $this->setTranslation(array_key_exists('translation', $values) ? $values['translation'] : null);
        $this->setStatus(array_key_exists('status', $values) ? $values['status'] : null);
    }


    /**
     * validate values
     */
    protected function preExecute()
    {
        //TODO: check unique
        $existingTranslationModel = null;
        //$existingTranslationModel = $this->getTableGateway('Translation42\Translation')->select(
        //    [
        //
        //    ]
        //);

        if (!empty($existingTranslationModel)) {
            $this->addError("translation", "translation with same key and locale already exists in this text domain");
        }

        if (empty($this->textDomain)) {
            $this->addError("textDomain", "textDomain can't be empty");
        }

        if (empty($this->locale)) {
            $this->addError("locale", "locale can't be empty");
        }

        if (empty($this->message)) {
            $this->addError("message", "message can't be empty");
        }

        $this->translation = (empty($this->translation)) ? null : $this->translation;

        if ($this->status === null) {
            $this->status = Translation::STATUS_MANUAL;
        } else {
            if (!in_array($this->status, [Translation::STATUS_MANUAL, Translation::STATUS_AUTO])) {
                $this->addError("status", "invalid status '{$this->status}'");
            }
        }
    }

    /**
     * @return Translation
     */
    protected
    function execute()
    {
        $datetime = new \DateTime();
        $translation = new Translation();
        $translation->setTextDomain($this->textDomain)
            ->setLocale($this->locale)
            ->setMessage($this->message)
            ->setTranslation($this->translation)
            ->setStatus($this->status)
            ->setCreated($datetime)
            ->setUpdated($datetime);

        $this->getTableGateway('Translation42\Translation')->insert($translation);

        return $translation;
    }
}
