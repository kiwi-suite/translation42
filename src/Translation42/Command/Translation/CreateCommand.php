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
use Core42\I18n\Localization\Localization;
use Translation42\Model\Translation;
use Translation42\TableGateway\TranslationTableGateway;

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
     * @return $this
     */
    public function setTextDomain($textDomain)
    {
        $this->textDomain = $textDomain;

        return $this;
    }

    /**
     * @param string $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param string $translation
     * @return $this
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
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
        }

        if (!in_array($this->status, [Translation::STATUS_MANUAL, Translation::STATUS_AUTO])) {
            $this->addError("status", "invalid status '{$this->status}'");
        }
    }

    /**
     * @return Translation
     */
    protected function execute()
    {
        $translation = new Translation();

        try {
            $this->getServiceManager()->get(TransactionManager::class)->transaction(function() use (&$translation){
                $datetime = new \DateTime();

                $translation->setTextDomain($this->textDomain)
                    ->setLocale($this->locale)
                    ->setMessage($this->message)
                    ->setTranslation($this->translation)
                    ->setStatus($this->status)
                    ->setCreated($datetime)
                    ->setUpdated($datetime);

                $this->getTableGateway(TranslationTableGateway::class)->insert($translation);

                /** @var Localization $localization */
                $localization = $this->getServiceManager()->get(Localization::class);

                foreach ($localization->getAvailableLocales() as $locale) {
                    if ($locale == $this->locale) {
                        continue;
                    }

                    $translationModel = new Translation();
                    $translationModel->setTextDomain($this->textDomain)
                        ->setLocale($locale)
                        ->setMessage($this->message)
                        ->setTranslation(null)
                        ->setStatus($this->status)
                        ->setCreated($datetime)
                        ->setUpdated($datetime);
                    $this->getTableGateway(TranslationTableGateway::class)->insert($translationModel);
                }

                $cacheId = 'Zend_I18n_Translator_Messages_'.md5($this->textDomain.$this->locale);
                $translator = $this->getServiceManager()->get('MvcTranslator');
                if (($cache = $translator->getCache()) !== null) {
                    $cache->removeItem($cacheId);
                }
            });
        } catch (\Exception $e) {
            $this->addError("system", $e->getMessage());
        }

        return $translation;
    }
}
