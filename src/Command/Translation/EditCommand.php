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

namespace Translation42\Command\Translation;

use Core42\Command\AbstractCommand;
use Core42\Stdlib\DateTime;
use Translation42\Model\Translation;
use Translation42\TableGateway\TranslationTableGateway;

class EditCommand extends AbstractCommand
{
    /**
     * @var int
     */
    private $translationId;

    /**
     * @var Translation
     */
    private $translationModel;

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
     * @param int $translationId
     * @return $this
     */
    public function setTranslationId($translationId)
    {
        $this->translationId = $translationId;

        return $this;
    }

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
        $this->setTranslation(array_key_exists('translation', $values) ? $values['translation'] : null);
    }

    /**
     *
     */
    protected function preExecute()
    {
        if (!empty($this->translationId)) {
            $this->translationModel =
                $this->getTableGateway(TranslationTableGateway::class)->selectByPrimary((int) $this->translationId);
        }

        if (!($this->translationModel instanceof Translation)) {
            $this->addError('translation', 'invalid translation');
        }

        $this->translation = (empty($this->translation)) ? null : $this->translation;
    }

    /**
     * @return Translation
     */
    protected function execute()
    {
        $dateTime = new DateTime();

        $this->translationModel
            ->setTranslation($this->translation)
            ->setStatus(Translation::STATUS_MANUAL)
            ->setUpdated($dateTime);

        $this->getServiceManager()->get('TableGateway')->get(TranslationTableGateway::class)->update(
            $this->translationModel
        );

        return $this->translationModel;
    }
}
