<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\Command\Translation;

use Core42\Command\AbstractCommand;
use Core42\Db\Transaction\TransactionManager;
use Translation42\Model\Translation;
use Translation42\TableGateway\TranslationTableGateway;
use Zend\I18n\Translator\TranslatorInterface;

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
                $this->getTableGateway(TranslationTableGateway::class)->selectByPrimary((int)$this->translationId);
        }

        if (!($this->translationModel instanceof Translation)) {
            $this->addError("translation", "invalid translation");
        }

        $this->translation = (empty($this->translation)) ? null : $this->translation;
    }

    /**
     * @return Translation
     */
    protected function execute()
    {
        $dateTime = new \DateTime();

        $this->translationModel
            ->setTranslation($this->translation)
            ->setStatus(Translation::STATUS_MANUAL)
            ->setUpdated($dateTime);

        $this->getServiceManager()->get('TableGateway')->get(TranslationTableGateway::class)->update(
            $this->translationModel
        );

        $cacheId = 'Zend_I18n_Translator_Messages_';
        $cacheId .= md5($this->translationModel->getTextDomain().$this->translationModel->getLocale());

        $translator = $this->getServiceManager()->get(TranslatorInterface::class);
        if (($cache = $translator->getCache()) !== null) {
            $cache->removeItem($cacheId);
        }

        return $this->translationModel;
    }
}
